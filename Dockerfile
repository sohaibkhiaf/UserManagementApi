FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    git curl zip unzip \
    libpng-dev libxml2-dev libzip-dev oniguruma-dev \
    bash

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install opcache (important for performance)
RUN docker-php-ext-install opcache

# Install Composer
COPY --from=composer:2.9.5 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy composer files first (for better cache)
COPY composer.json composer.lock ./

ARG APP_ENV=production

# Install dependencies WITHOUT scripts
RUN if [ "$APP_ENV" = "production" ]; then \
    composer install --no-dev --optimize-autoloader --no-scripts; \
    else \
    composer install --no-scripts; \
    fi

# Copy project files
COPY . .

# Remove cache
RUN rm -rf bootstrap/cache/*.php

RUN if [ "$APP_ENV" = "production" ]; then \
    php artisan config:cache && \
    php artisan route:cache; \
    fi

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# Switch user (security)
USER www-data

CMD ["php-fpm"]

