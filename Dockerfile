FROM php:7.4-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN cp /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/