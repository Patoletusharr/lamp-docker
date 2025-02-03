FROM php:8.2-fpm-alpine

# Install MySQL extension
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set working directory and copy PHP files
WORKDIR /var/www/html
COPY index.php /var/www/html/

EXPOSE 9000

CMD ["php-fpm"]

