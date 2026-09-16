FROM php:8.4-fpm

WORKDIR /var/www

# System dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libpq-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install \
    pdo_pgsql \
    pgsql \
    bcmath \
    zip \
    && rm -rf /var/lib/apt/lists/*

RUN mkdir -p /tmp/php \
    && chmod 1777 /tmp/php

RUN echo "sys_temp_dir=/tmp/php" > /usr/local/etc/php/conf.d/temp.ini \
    && echo "upload_tmp_dir=/tmp/php" >> /usr/local/etc/php/conf.d/temp.ini

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# PHP configuration
COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/app.ini

EXPOSE 9000

CMD ["php-fpm"]
