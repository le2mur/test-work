FROM php:7.4-apache

WORKDIR /var/www/html

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo pdo_mysql
RUN apt-get update && apt-get upgrade -y \
&& a2enmod rewrite \
&& apt-get install -y curl git wget npm \
&& rm -rf /var/lib/apt/lists/* \
&& find /etc/apache2/ -type f | xargs sed -i  's/AllowOverride None/AllowOverride All/g' \
&& service apache2 restart \
&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer