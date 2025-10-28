# Dockerfile
FROM php:8.2-cli

# تثبيت الحزم المطلوبة
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring xml opcache

# تثبيت Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# تحديد مجلد العمل
WORKDIR /var/www/html

# نسخ ملفات composer
COPY composer.json composer.lock ./

# تثبيت التبعيات
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader

# نسخ باقي ملفات المشروع
COPY . .

# صلاحيات المجلدات المهمة
RUN chmod -R 775 storage bootstrap/cache || true

# إعداد متغيرات بيئية أساسية
ENV APP_ENV=production
ENV APP_DEBUG=false

# أمر التشغيل (سيبدأ السيرفر تلقائياً)
CMD [ "sh", "-c", "php artisan key:generate --force 2>/dev/null || true && php artisan migrate --force 2>/dev/null || true && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}" ]
