FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libpq-dev \
    libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        pgsql \
        gd \
        zip \
        bcmath \
        intl

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy seluruh project terlebih dahulu
COPY . .

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer install \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-interaction

RUN php artisan optimize:clear || true

EXPOSE 8080

CMD ["php","artisan","serve","--host=0.0.0.0","--port=8080"]