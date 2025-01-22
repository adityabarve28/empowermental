# Use the official PHP 8.2 Apache image
FROM php:8.2-apache

# Add the ServerName directive to suppress the warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Install necessary system packages
RUN apt-get update -y && apt-get install -y \
    unzip \
    libpq-dev \
    libcurl4-gnutls-dev \
    git \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql bcmath

# Install Redis PHP extension
RUN pecl install redis && docker-php-ext-enable redis

# Install Composer
COPY --from=composer:2.8.1 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . .

# Ensure proper permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Expose port
EXPOSE 8000

# Copy the entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
