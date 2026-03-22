FROM php:5.6-apache

# Переключаем репозитории на архивные, так как Debian Jessie больше не поддерживается
RUN sed -i 's/deb.debian.org/archive.debian.org/g' /etc/apt/sources.list \
    && sed -i 's|security.debian.org/debian-security|archive.debian.org/debian-security|g' /etc/apt/sources.list \
    && sed -i '/stretch-updates/d' /etc/apt/sources.list

# Устанавливаем расширения
RUN apt-get update && apt-get install -y \
        libzip-dev \
        zip \
    && docker-php-ext-install mysql mysqli pdo pdo_mysql

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80
