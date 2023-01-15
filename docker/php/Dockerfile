ARG PHP_VERSION

FROM php:${PHP_VERSION}-alpine

WORKDIR /app

ADD . /app

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install
