#!/bin/bash
set -e

cd /var/www/html

# Create .env file if not exists (Coolify injects env vars, but some artisan commands need the file)
if [ ! -f .env ]; then
    echo "Creating .env from .env.example..."
    cp .env.example .env 2>/dev/null || touch .env
fi

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "" ]; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force || true
fi

# Ensure storage directories exist
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/logs
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Wait for MySQL
echo "Waiting for database..."
max_retries=30
retry=0
until mysqladmin ping -h "$DB_HOST" -P "${DB_PORT:-3306}" -u "$DB_USERNAME" -p"$DB_PASSWORD" --silent 2>/dev/null; do
    retry=$((retry+1))
    if [ $retry -ge $max_retries ]; then
        echo "Database not available after $max_retries attempts, proceeding anyway..."
        break
    fi
    echo "Waiting for MySQL... ($retry/$max_retries)"
    sleep 2
done
echo "Database ready."

# Run migrations
php artisan migrate --force

# Seed if empty (first deploy)
php artisan db:seed --class=ContentSeeder --force 2>/dev/null || true

# Create admin user if ADMIN_PASSWORD env is set and no users exist
if [ -n "$ADMIN_PASSWORD" ]; then
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
    "
fi

# Cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Storage link
php artisan storage:link 2>/dev/null || true

# Fix permissions
chown -R www-data:www-data storage bootstrap/cache

echo "Starting application..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/app.conf
