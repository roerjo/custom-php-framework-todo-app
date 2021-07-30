FROM php:7.4-fpm

WORKDIR /var/www/app

# Install additional libraries for Laravel && Composer
RUN apt-get update \
    && apt-get install -y \
        # Needed for Composer
        zip \
        unzip \
        git \
        # Needed for PHP zip extension
        libzip-dev \
    && docker-php-ext-install \
        # Needed for MySQL database connections
        pdo_mysql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./ ./

RUN composer install --no-scripts --no-autoloader \
    && composer dump-autoload --optimize

CMD php-fpm
