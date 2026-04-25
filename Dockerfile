FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

CMD php artisan serve --host=0.0.0.0 --port=$PORT