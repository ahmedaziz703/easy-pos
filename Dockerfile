# =====================================================
# 🐘 Laravel Easy-POS - Dockerfile (PHP 8.2-FPM + PostgreSQL + Storage Link)
# =====================================================

FROM php:8.2-fpm

# 1️⃣ تثبيت المتطلبات الأساسية + دعم PostgreSQL
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libonig-dev \
    libpq-dev \
    libxml2-dev \
    libssl-dev \
    libicu-dev \
    zlib1g-dev \
    g++ \
    make \
    pkg-config \
    libcurl4-openssl-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip bcmath opcache intl

# 2️⃣ إعداد مجلد العمل
WORKDIR /var/www/html

# 3️⃣ نسخ ملفات المشروع
COPY . .

# 4️⃣ إعداد الصلاحيات للمجلدات المهمة
RUN chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# 5️⃣ إنشاء مجلدات التخزين للصور وتفعيل الرابط
RUN mkdir -p storage/app/public && \
    mkdir -p public/storage && \
    php artisan storage:link || true

# 6️⃣ تثبيت Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 7️⃣ تثبيت تبعيات Laravel
RUN composer install --no-interaction --ignore-platform-reqs --optimize-autoloader

# 8️⃣ توليد مفتاح التطبيق
RUN php artisan key:generate --force || true

# 9️⃣ فتح المنفذ
EXPOSE 8000

# تشغيل migrations + seed قبل تشغيل السيرفر
CMD sh -c "\
    php artisan migrate --force --seed && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8000} \
"
