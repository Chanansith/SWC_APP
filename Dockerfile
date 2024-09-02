# syntax=docker/dockerfile:1.7-labs

# Use the official PHP image as the base image.
FROM php:8.0-fpm

# Install NGINX and any necessary dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-install mysqli

# Use the default production configuration for PHP runtime arguments, see
# https://github.com/docker-library/docs/tree/master/php#configuration
# RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"    

# Copy application code to /var/www/html
COPY --chown=www-data:www-data --chmod=755 --exclude=proxy . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Remove default server definition
RUN unlink /etc/nginx/sites-enabled/default

# Copy virtual host configuration file
COPY proxy/virtual-host.conf /etc/nginx/sites-available/virtual-host.conf

# Enable virtual host
RUN ln -s /etc/nginx/sites-available/virtual-host.conf /etc/nginx/sites-enabled/

# Start NGINX and PHP-FPM
CMD service nginx start && php-fpm
