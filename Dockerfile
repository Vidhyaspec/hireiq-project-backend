FROM php:8.2-apache

# Install git, zip, unzip (needed by Composer to fetch packages)
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install mysqli PHP extension
RUN docker-php-ext-install mysqli

# Disable conflicting MPM modules at build time
RUN a2dismod mpm_event mpm_worker || true
RUN a2enmod mpm_prefork || true

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy all source files
COPY . /var/www/html/

# Set working directory to backend where composer.json is located and run composer install
WORKDIR /var/www/html/backend
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Restore default workdir
WORKDIR /var/www/html

# Enforce disabling conflicting MPMs and apply port binding dynamically at container boot
ENV PORT=80
CMD ["sh", "-c", "a2dismod mpm_event mpm_worker || true && a2enmod mpm_prefork || true && sed -i \"s/Listen 80/Listen $PORT/g\" /etc/apache2/ports.conf && sed -i \"s/<VirtualHost \\*\\:80>/<VirtualHost *:$PORT>/g\" /etc/apache2/sites-available/000-default.conf && apache2-foreground"]