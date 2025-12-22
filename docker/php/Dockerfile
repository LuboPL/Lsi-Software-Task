FROM composer:2 AS composer

FROM composer:2 AS vendor
WORKDIR /app
COPY app/composer.json app/composer.lock ./
RUN composer install --no-interaction --no-progress --no-scripts

FROM php:8.3-fpm

RUN apt-get update \
    && apt-get install -y --no-install-recommends unzip \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer /usr/bin/composer /usr/local/bin/composer
COPY --from=vendor /app/vendor /opt/vendor
COPY docker/php/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

WORKDIR /var/www/html
ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm"]
