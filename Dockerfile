# Use the official PHP 8.2 FPM image
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif bcmath \
    && docker-php-ext-enable exif \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy Composer from the official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy composer files first (for better caching)
COPY composer.json composer.lock ./

# Install PHP dependencies (optimized for production)
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Copy the rest of the application
COPY . .

# Ensure correct permissions for Laravel storage and cache folders
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose the port PHP-FPM listens on
EXPOSE 9000


# Laravel setup
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan storage:link

# Start PHP-FPM
CMD ["php-fpm"]
