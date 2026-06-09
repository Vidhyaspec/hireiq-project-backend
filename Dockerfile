FROM php:8.2-apache

# Enable required Apache modules
RUN a2enmod rewrite headers

# Copy project correctly
COPY . /var/www/html/

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html