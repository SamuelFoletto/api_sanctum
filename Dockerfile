FROM php:8.2-fpm

# Instala dependências
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copia projeto
COPY . .

# Instala dependências Laravel
RUN composer install --no-dev --optimize-autoloader

# Permissões importantes
RUN chown -R www-data:www-data storage bootstrap/cache

# Copia config do Nginx
COPY nginx.conf /etc/nginx/sites-available/default

# Limpa cache de config
RUN php artisan config:clear

EXPOSE 80

# Comando de inicialização
CMD php artisan migrate --force && \
    service nginx start && \
    php-fpm
