# Stage 1: Build Assets (Frontend)
FROM node:20-alpine as frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: Build App (Backend PHP)
FROM php:8.3-fpm-alpine

# Install dependencies sistem
RUN apk add --no-cache \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    oniguruma-dev

# Install PHP Extensions (Wajib pdo_pgsql untuk Neon)
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd opcache

# Copy Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy file Laravel
COPY . .

# Copy hasil build frontend dari Stage 1
COPY --from=frontend /app/public/build /var/www/public/build

# Install Vendor PHP (Tanpa dev dependencies)
RUN composer install --optimize-autoloader --no-dev

# Set Permission storage (Penting!)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]