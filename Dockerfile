FROM php:8.1.6-fpm

RUN apt-get update && apt-get install -y \
    curl \ 
    zip \
    unzip \
    vim

#Install composer (accesed from docker container)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#Install PDO extension
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www

#Change owner of the container document root
RUN chown -R www-data:www-data /var/www

COPY ./mvc .