FROM ibrunotome/php:7.3-fpm

ARG COMPOSER_FLAGS='--prefer-dist --optimize-autoloader'

WORKDIR /var/www

COPY . /var/www
COPY php.ini /usr/local/etc/php/php.ini

RUN composer install $COMPOSER_FLAGS

EXPOSE 9000
