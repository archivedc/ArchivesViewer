FROM composer AS composer

COPY . /app

RUN composer install

FROM php:apache

COPY . /var/www/html
COPY --from=composer /app/vendor /var/www/html/vendor
