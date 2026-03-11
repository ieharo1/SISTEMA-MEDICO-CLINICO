FROM php:8.2-fpm

ARG USER_ID=1000
ARG GROUP_ID=1000

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    jpegoptim optipng pngquant gifsicle \
    libpq-dev

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN useradd -G www-data,root -u $USER_ID -d /home/developer developer
RUN mkdir -p /home/developer/.composer && \
    chown -R developer:developer /home/developer

RUN usermod -u 1000 www-data

EXPOSE 9000
CMD ["php-fpm"]