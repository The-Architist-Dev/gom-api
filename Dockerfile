FROM php:8.2-cli-alpine

RUN apk add --no-cache \
    bash \
    curl \
    git \
    unzip \
    libzip-dev \
    icu-dev \
    oniguruma-dev \
    && docker-php-ext-install pdo_mysql mbstring bcmath intl zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-interaction \
    --no-progress \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

COPY docker/start-api.sh /usr/local/bin/start-api
RUN chmod +x /usr/local/bin/start-api

EXPOSE 8080

CMD ["start-api"]
