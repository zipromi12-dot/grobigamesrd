FROM php:7.4-apache

# Устанавливаем расширения для ZIP и MySQL (PDO и mysqli)
RUN apt-get update && apt-get install -y \
        libzip-dev \
        zip \
    && docker-php-ext-install zip mysqli pdo pdo_mysql

# Включаем модуль перенаправления (нужен для многих игр)
RUN a2enmod rewrite

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80
