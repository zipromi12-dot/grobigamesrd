FROM php:5.6-apache

# Отключаем проверку сертификатов для старых репозиториев, если они барахлят
RUN echo "Acquire::Check-Valid-Until \"false\";" > /etc/apt/apt.conf.d/99no-check-valid-until

# Устанавливаем только самое необходимое
RUN apt-get update && apt-get install -y \
        libzip-dev \
        zip \
    && docker-php-ext-install mysql mysqli pdo pdo_mysql

# Включаем модуль rewrite для Apache (часто нужен для игр)
RUN a2enmod rewrite

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80
