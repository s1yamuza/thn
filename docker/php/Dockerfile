FROM php:8.0-fpm

# Install composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get clean
RUN apt-get update

RUN apt-get install -y \
        git \
        zip \
        unzip
