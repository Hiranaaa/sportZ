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
    nodejs \
    npm

RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    pgsql \
    gd \
    zip \
    bcmath \
    intl

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN mkdir -p storage/framework/cache/data \
    storage/framework/views \
    storage/framework/sessions \
    storage/framework/testing \
    storage/logs \
    bootstrap/cache

RUN chmod -R 777 storage bootstrap/cache

RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --optimize-autoloader \
    --no-scripts

RUN npm install

RUN npm run build

EXPOSE 8080

CMD ["sh","-c","php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080"]