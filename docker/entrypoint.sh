#!/bin/bash

# Wait for database readiness
wait_for_database() {
    echo "Waiting for the database to be ready..."
    until php -r "new PDO('mysql:host=${DB_HOST:-database};port=${DB_PORT:-3306};dbname=${DB_DATABASE:-test}', '${DB_USERNAME:-root}', '${DB_PASSWORD:-}');" 2>/dev/null; do
        sleep 1
        echo "Still waiting for the database connection..."
    done
    echo "Database is ready!"
}

# Wait for Redis readiness
wait_for_redis() {
    echo "Waiting for Redis to be ready..."
    until nc -z "${REDIS_HOST:-redis}" "${REDIS_PORT:-6379}"; do
        sleep 1
        echo "Still waiting for Redis..."
    done
    echo "Redis is ready!"
}

wait_for_database
#wait_for_redis

# Install Composer dependencies
if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction --optimize-autoloader --no-dev
fi

# Create .env file if not exists
if [ ! -f ".env" ]; then
    echo "Creating .env file for environment $APP_ENV"
    cp .env.example .env
fi

# Run Artisan commands
php artisan key:generate
php artisan migrate --force
php artisan optimize
php artisan cache:clear
php artisan config:clear
php artisan route:cache

# Start Apache
exec apache2-foreground
