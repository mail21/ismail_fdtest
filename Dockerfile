# Use the official PHP 8.2 image with Apache
FROM php:8.2-apache

# Install system dependencies and PostgreSQL client libraries
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

RUN git config --global --add safe.directory /var/www/html

# Copy the Laravel project into the container
COPY . /var/www/html

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Create Laravel storage and cache directories if they don't exist
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache

# Set proper permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Generate Laravel application key
RUN php artisan key:generate

# Copy custom Apache configuration
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Restart Apache to apply changes
RUN service apache2 restart

# Expose port 80
EXPOSE 80