# .docker/php/Dockerfile

# Gunakan image dasar PHP 8.3 FPM versi Alpine
FROM php:8.3-fpm-alpine

# Argumen untuk User ID dan Group ID, default 1000 jika tidak diset
ARG UID=1000
ARG GID=1000

# Set working directory
WORKDIR /var/literasi

# Instalasi dependensi sistem
# Termasuk Node.js, NPM, dan library untuk ekstensi PHP
RUN apk add --no-cache \
    build-base \
    nginx \
    nodejs \
    npm \
    git \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    libxml2-dev

# Instalasi ekstensi PHP
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    xml

# Instalasi Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# BARIS YANG MENYEBABKAN ERROR SUDAH DIHAPUS DARI SINI

# Buat group baru dengan GID dari host
RUN addgroup -g ${GID} devgroup

# Buat user baru dengan UID & GID dari host
RUN adduser -D -u ${UID} -G devgroup devuser

# Ganti user ke user baru yang sudah kita buat
USER devuser

# Expose port untuk FPM
EXPOSE 10000

# Perintah default untuk menjalankan PHP-FPM
CMD ["php-fpm"]
