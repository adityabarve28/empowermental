# Use Ubuntu as the base image
FROM ubuntu:focal

# Update package manager
RUN apt-get update -y

# Set non-interactive mode to avoid prompts during installation
ARG DEBIAN_FRONTEND=noninteractive

# Install Apache web server
RUN apt-get install apache2 -y

# Install PHP 8.2 and necessary extensions
RUN apt-get -y install software-properties-common && \
    add-apt-repository ppa:ondrej/php && \
    apt-get update && \
    apt-get -y install php8.2 && \
    apt-get install -y php8.2-bcmath php8.2-fpm php8.2-xml php8.2-mysql php8.2-zip \
    php8.2-intl php8.2-ldap php8.2-gd php8.2-cli php8.2-bz2 php8.2-curl php8.2-mbstring \
    php8.2-pgsql php8.2-opcache php8.2-soap php8.2-cgi

# Install Vim (optional for debugging)
RUN apt install vim -y

# Install MySQL Server
RUN apt-get update -qq && apt-get install -y mysql-server

# Configure Apache to serve Laravel's public directory
RUN sed -i 's#/var/www/html#/var/www/html/EmpowerMental/public#g' /etc/apache2/sites-available/000-default.conf

# Add the SQL dump file for the database (update this path to match your project structure)
ADD empowermental.sql /

# Create the Laravel project directory and add project files
RUN mkdir -p /var/www/html/EmpowerMental
ADD . /var/www/html/EmpowerMental/

# Set Apache configuration (if you have a custom apache2.conf)
ADD apache2.conf /etc/apache2/

# Set permissions for Laravel's storage and bootstrap/cache directories
RUN chmod -R 777 /var/www/html/EmpowerMental/storage /var/www/html/EmpowerMental/bootstrap/cache

# Expose necessary ports
EXPOSE 80 3306

# Add and configure the start script (to start Apache and MySQL together)
ADD start.sh /
RUN chmod +x /start.sh

# Set the entry point to the start script
CMD ["/usr/bin/bash", "/start.sh"]
