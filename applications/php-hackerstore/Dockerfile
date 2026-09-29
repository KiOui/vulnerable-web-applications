# Use an official PHP image as the base image
FROM php:apache

# Enable PDO MySQL driver
RUN docker-php-ext-install pdo pdo_mysql
WORKDIR /var/www/html

# Copy the entire PHP project into the container
COPY website/ .
RUN chown -R www-data:www-data /var/www/html/*

COPY init-db.php /

# Copy the start script that initializes the database.
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Expose port 80 for the Apache web server
EXPOSE 80

ENTRYPOINT ["docker-entrypoint.sh"]

CMD ["apache2-foreground"]
