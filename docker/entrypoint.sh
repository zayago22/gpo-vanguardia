#!/bin/bash
set -e

cd /var/www/html

# Wait for PostgreSQL
echo "Waiting for database..."
until php artisan db:monitor --databases=pgsql 2>/dev/null; do
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
