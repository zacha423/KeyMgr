FROM php:fpm-bullseye

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PostgreSQL extension and other dependencies
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/include/postgresql/ \
    && docker-php-ext-install pdo_pgsql pgsql ctype curl dom fileinfo filter hash mbstring openssl pcre pdo session tokenizer xml

# Optionally, you can install other PHP extensions or dependencies as needed.
# For example, if you need more extensions like gd, mbstring, etc., you can add them here.

# Set your working directory
WORKDIR /var/www/html


