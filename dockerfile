# ----------------------------
# Stage 1: PHP / Laravel (Base)
# ----------------------------
FROM php:8.2-fpm AS php_base

WORKDIR /var/www

# Dependências PHP necessárias
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia código Laravel
COPY . .

# Instala dependências PHP
RUN composer install --no-dev --optimize-autoloader

# Copia o .env.production ou .env correto antes de gerar Ziggy
COPY .env.production .env

# Gera Ziggy
RUN php artisan ziggy:generate resources/js/ziggy.js

# ----------------------------
# Stage 2: Node / Vite Build
# ----------------------------
FROM node:20-alpine AS node_builder

WORKDIR /var/www

COPY package*.json ./
RUN npm install

# Copia resources e vendor do Laravel, incluindo ziggy.js
COPY --from=php_base /var/www/resources ./resources
COPY --from=php_base /var/www/vendor ./vendor
COPY vite.config.js ./

# Build dos assets
RUN npm run build

# ----------------------------
# Stage 3: Final (Nginx + PHP-FPM)
# ----------------------------
FROM php:8.2-fpm AS final

WORKDIR /var/www

# 1️⃣ Instala PHP extensions + dependências necessárias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    nginx \
    supervisor \
    zip \
    unzip \
    curl \
    git \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2️⃣ Copia Laravel + vendor
COPY --from=php_base /var/www ./

# 3️⃣ Copia assets
COPY --from=node_builder /var/www/public/build ./public/build

# 4️⃣ Copia configs
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY docker/supervisord.conf /etc/supervisord.conf

# 5️⃣ Ajusta permissões
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

EXPOSE 8000

# 6️⃣ Inicia supervisord
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]

# Ajusta permissões do Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

