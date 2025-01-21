#!/bin/bash

# Function to check database readiness
wait_for_database() {
    echo "Waiting for the database to be ready..."
    until php -r "new PDO('mysql:host=${DB_HOST:-database};dbname=${DB_DATABASE:-test}', '${DB_USERNAME:-root}', '${DB_PASSWORD:-}');" 2>/dev/null; do
        sleep 1
        echo "Waiting for the database connection..."
    done
    echo "Database is ready!"
}

# Wait for the database
wait_for_database

# Install Composer dependencies if vendor/autoload.php does not exist
if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

# If .env does not exist, create it from .env.example
if [ ! -f ".env" ]; then
    echo "Creating env file for env $APP_ENV"
    cp .env.example .env
else
    echo "Env file exists"
fi

# Run Laravel migrations and other Artisan commands
if php artisan migrate:fresh --seed; then
    echo "Migrations ran successfully."
else
    echo "Migrations failed. Exiting."
    exit 1
fi

php artisan key:generate
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Serve the application
php artisan serve --port=${PORT:-8000} --host=0.0.0.0 --env=.env

# Execute the default PHP entrypoint
exec docker-php-entrypoint "$@"
