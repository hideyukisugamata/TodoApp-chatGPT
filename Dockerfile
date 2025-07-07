# ベースイメージ
FROM php:8.2-fpm

# 必要パッケージ
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

# 作業ディレクトリ
WORKDIR /var/www

# ここでアプリ全体を先にコピー
COPY . .

# Composer install
RUN composer install --no-dev --optimize-autoloader

# 権限
RUN chown -R www-data:www-data /var/www

# Laravel キャッシュ
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# 公開ポート
EXPOSE 8000

# 起動コマンド
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
