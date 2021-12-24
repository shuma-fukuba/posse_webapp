FROM php:7.2-fpm
COPY php.ini /user/local/etc/php/php.ini
RUN pecl install xdebug && docker-php-ext-enable xdebug && \
docker-php-ext-install pdo pdo_mysql mysqli mbstring

COPY ./php.ini /usr/local/etc/php/php.ini
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
