FROM php:8.2-fpm

# Update system
RUN apt-get update

# Install basic tools
RUN apt-get install -y git curl zip unzip netcat-openbsd

# Install PHP dependencies
RUN apt-get install -y libpng-dev libonig-dev libxml2-dev libzip-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer 2.9.5
COPY --from=composer:2.9.5 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install Laravel dependencies
RUN composer install --optimize-autoloader

# Set permissions (important for Laravel)
RUN chown -R www-data:www-data /var/www && chmod -R 775 storage bootstrap/cache

# Run PHP-FPM
CMD ["php-fpm"]
