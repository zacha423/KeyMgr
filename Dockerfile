FROM php:fpm-bullseye

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PostgreSQL extension and other dependencies
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/include/postgresql/ \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Optionally, you can install other PHP extensions or dependencies as needed.
# For example, if you need more extensions like gd, mbstring, etc., you can add them here.

# Copy your PHP application code to the container (replace '/app' with your app path)
COPY ./BasicDemo/public var/www/html

# Set your working directory
WORKDIR /var/www/html


