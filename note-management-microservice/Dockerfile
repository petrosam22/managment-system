# Base image
   FROM php:8.0-apache

   # Set working directory
   WORKDIR /var/www/html

   # Copy project files
   COPY . /var/www/html

   # Install dependencies
   RUN apt-get update && apt-get install -y \
       libpng-dev \
       libonig-dev \
       libxml2-dev \
       zip \
       unzip \
       && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

   # Set up Apache
   RUN a2enmod rewrite

   # Install Composer
   RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

   # Install project dependencies
   RUN composer install --no-interaction --optimize-autoloader --no-scripts

   # Generate application key
   RUN php artisan key:generate

   # Expose port
   EXPOSE 80

   # Start Apache
   CMD ["apache2-foreground"]