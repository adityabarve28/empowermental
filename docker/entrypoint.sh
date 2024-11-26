#!/bin/bash

# Install Composer dependencies if vendor/autoload.php does not exist
if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

# If .env does not exist, create it from .env.example
if [ ! -f ".env" ]; then
    echo "creating env file for env $APP_ENV"
    cp .env.example .env
else
    echo "Env file exists"
fi

# Run Laravel migrations and other Artisan commands
php artisan migrate
php artisan key:generate
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Serve the application
php artisan serve --port=$PORT --host=0.0.0.0 --env=.env

# Execute the default PHP entrypoint
exec docker-php-entrypoint "$@"
