# ベースイメージ
FROM php:8.2-fpm

# 必要なパッケージインストール
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Composer インストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 作業ディレクトリ
WORKDIR /var/www

# 依存関係インストール
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# アプリコードコピー
COPY . .

# パーミッション調整
RUN chown -R www-data:www-data /var/www

# Laravel キャッシュなど
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# 公開ポート
EXPOSE 8000

# 起動コマンド
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
