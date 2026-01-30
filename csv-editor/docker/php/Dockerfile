FROM php:8.3-fpm
RUN docker-php-ext-install pdo pdo_mysql
WORKDIR /var/www/html

RUN mkdir -p uploads \
    && chown -R www-data:www-data uploads \
    && chmod -R 777 uploads

USER www-data
