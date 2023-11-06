# FROM php:fpm-bullseye

# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# RUN set -ex \
#     	&& apk --no-cache add postgresql-dev\
#     	&& docker-php-ext-install pdo pdo_pgsql

# WORKDIR /var/www/html