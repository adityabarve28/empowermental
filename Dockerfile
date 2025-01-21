FROM php:8.2-apache as php

# Add the ServerName directive to suppress the warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Install necessary packages
RUN apt-get update -y && apt-get install -y unzip libpq-dev libcurl4-gnutls-dev

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql bcmath

# Install Redis PHP extension
RUN pecl install redis && docker-php-ext-enable redis

WORKDIR /var/www

# Copy application files
COPY . .

# Copy Composer from official image
COPY --from=composer:2.8.1 /usr/bin/composer /usr/bin/composer

# Set environment variable for port
ENV PORT=8000

# Set entrypoint for the application
ENTRYPOINT [ "docker/entrypoint.sh" ]
