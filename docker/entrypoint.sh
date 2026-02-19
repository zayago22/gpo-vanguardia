#!/bin/bash
# Do NOT use set -e — we want the app to start even if setup steps fail
cd /var/www/html

# Create .env file from environment variables (Coolify injects env vars, artisan needs .env file)
if [ ! -f .env ]; then
    echo "Creating .env from environment..."
    # Quote all values to handle spaces (e.g. APP_NAME="GPO Vanguardia")
    env | grep -E '^(APP_|DB_|ADMIN_|SESSION_|CACHE_|QUEUE_|MAIL_|FILESYSTEM_|LOG_|BCRYPT_|BROADCAST_|REDIS_|VITE_)' | sort | sed 's/=\(.*\)/="\1"/' > .env
fi

# APP_KEY check
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "" ]; then
    echo "WARNING: APP_KEY not set! Add it to Coolify Environment Variables."
fi

# Ensure storage directories exist
mkdir -p storage/framework/{sessions,views,cache} storage/logs 2>/dev/null
chmod -R 775 storage bootstrap/cache 2>/dev/null
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null

# Wait for MySQL (max 60s) — try php connection if mysqladmin fails
echo "Waiting for database..."
max_retries=15
retry=0
db_ready=false
while [ "$db_ready" = "false" ] && [ $retry -lt $max_retries ]; do
    retry=$((retry+1))
    # Try PHP PDO connection (more reliable than mysqladmin in Docker networks)
    if php -r "try { new PDO('mysql:host='.\$_SERVER['DB_HOST'].';port='.(\$_SERVER['DB_PORT']??3306).';dbname='.\$_SERVER['DB_DATABASE'], \$_SERVER['DB_USERNAME'], \$_SERVER['DB_PASSWORD']); echo 'OK'; } catch(Exception \$e) { exit(1); }" 2>/dev/null; then
        db_ready=true
    else
        echo "Waiting for MySQL... ($retry/$max_retries)"
        sleep 3
    fi
done
if [ "$db_ready" = "true" ]; then
    echo "Database connected."
else
    echo "Database not available after $max_retries attempts, proceeding anyway..."
fi

# Run migrations
echo "Running migrations..."
php artisan migrate --force 2>&1 || echo "Migration warning (may be OK if already migrated)"

# Seed if empty (first deploy only — errors OK if data exists)
echo "Seeding database..."
php artisan db:seed --class=ContentSeeder --force 2>&1 || echo "Seeder skipped (data may already exist)"

# Create admin user if ADMIN_PASSWORD env is set and no users exist
if [ -n "$ADMIN_PASSWORD" ]; then
    echo "Checking admin user..."
    php artisan tinker --execute="
        if(App\Models\User::count() === 0) {
            App\Models\User::create([
                'name' => 'Admin',
                'email' => env('ADMIN_EMAIL', 'admin@gpovanguardia.com'),
                'password' => bcrypt(env('ADMIN_PASSWORD')),
            ]);
            echo 'Admin user created.';
        } else {
            echo 'Users exist, skipping.';
        }
    " 2>&1 || echo "Admin user check skipped"
fi

# Cache config (critical for performance)
echo "Caching configuration..."
php artisan config:cache 2>&1 || echo "Config cache failed"
php artisan route:cache 2>&1 || echo "Route cache failed"
php artisan view:cache 2>&1 || echo "View cache failed"

# Storage link
php artisan storage:link 2>&1 || true

# Fix permissions
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null

# ALWAYS start the application regardless of above results
echo "Starting application..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/app.conf
