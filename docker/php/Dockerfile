FROM php:7.4-fpm

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get clean
RUN apt-get update

RUN apt-get install -y \
        git \
        zip \
        unzip

RUN docker-php-ext-install pdo pdo_mysql mysqli
