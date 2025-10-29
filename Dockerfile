# =====================================================
# 🐘 Laravel Easy-POS - Dockerfile (PHP 8.2 + PostgreSQL + Vite)
# =====================================================

FROM php:8.2-fpm

# 1️⃣ تثبيت المتطلبات الأساسية + دعم PostgreSQL + Node.js
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
    nodejs \
    npm \
    libcurl4-openssl-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip bcmath opcache intl

# 2️⃣ مجلد العمل
WORKDIR /var/www/html

# 3️⃣ نسخ ملفات المشروع
COPY . .

# 4️⃣ صلاحيات المجلدات المهمة
RUN chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# 5️⃣ تثبيت Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 6️⃣ تثبيت تبعيات Laravel
RUN composer install --no-interaction --ignore-platform-reqs --optimize-autoloader

# 7️⃣ تثبيت حزم Node.js وبناء ملفات Vite
RUN npm install && npm run build

# 8️⃣ إنشاء رابط التخزين (Storage Link)
RUN php artisan storage:link || true

# 9️⃣ فتح المنفذ (Render يستخدم متغير PORT تلقائيًا)
EXPOSE 8000

# 🔟 تشغيل سيرفر Laravel فقط
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
