FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip unzip git \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN a2enmod rewrite

WORKDIR /var/www

COPY . .

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

EXPOSE 9000

CMD ["sh", "-c", "php artisan migrate --force && apache2-foreground"]


