FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git unzip zip curl libpng-dev libjpeg62-turbo-dev \
    libfreetype6-dev libzip-dev libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
       pdo \
       pdo_pgsql \
       pgsql \
       gd \
       zip \
       bcmath

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN php artisan config:clear

RUN php artisan route:clear

RUN php artisan view:clear

EXPOSE 8080

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080