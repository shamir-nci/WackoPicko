FROM php:7.4-apache

# Enable short open tags
RUN docker-php-ext-install mysqli

# Copy application files
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Set permissions
RUN chmod -R 755 /var/www/html/website/upload

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

CMD ["apache2-foreground"]
