FROM php:7.4-apache

# Устанавливаем расширения для ZIP и MySQL
RUN apt-get update && apt-get install -y \
        libzip-dev \
        zip \
    && docker-php-ext-install zip mysqli pdo pdo_mysql

# Включаем модуль перенаправления
RUN a2enmod rewrite

# Копируем файлы
COPY . /var/www/html/

# ИСПРАВЛЕНО: Команда в одну строку без лишних переносов
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
