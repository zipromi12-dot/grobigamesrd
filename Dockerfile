FROM php:5.6-apache

# Устанавливаем расширение для работы с ZIP и MySQL
RUN apt-get update && apt-get install -y libzip-dev zip \
    && docker-php-ext-install zip mysql mysqli pdo pdo_mysql

# Копируем всё содержимое репозитория в папку сервера
COPY . /var/www/html/

# Даем права на запись, чтобы скрипт мог распаковать архив
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80
