# Sử dụng image cơ bản với PHP 8 và Composer
FROM php:8.0-fpm

# Thiết lập thư mục làm việc trong container
WORKDIR /var/www/html

# Cài đặt các gói cần thiết
RUN apt-get update \
    && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    unzip \
    git \
    && docker-php-ext-install -j$(nproc) \
    bcmath \
    exif \
    gd \
    intl \
    mbstring \
    opcache \
    pdo_mysql \
    pdo_pgsql \
    soap \
    zip \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*


# Cài đặt Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Sao chép mã nguồn Laravel vào thư mục làm việc
COPY . .

# Cài đặt các gói PHP bằng Composer
RUN composer install --no-interaction --optimize-autoloader

# Thiết lập quyền cho các tệp tin và thư mục trong Laravel
RUN chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache

# Tạo file .env từ file .env.example (nếu cần)
RUN cp .env.dev .env

# Tạo key ứng dụng Laravel
RUN php artisan key:generate

# Expose cổng 9000 để PHP-FPM chạy
EXPOSE 9000

# Chạy lệnh "php-fpm" để khởi động PHP-FPM
USER root
