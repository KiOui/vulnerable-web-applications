# Use an official PHP image as the base image
FROM php:apache

WORKDIR /var/www/html

# Copy the entire PHP project into the container
COPY website/ .
RUN chown -R www-data:www-data /var/www/html/*

# Copy the flag file into the container
COPY tmp/flag.txt /tmp/flag.txt

# Expose port 80 for the Apache web server
EXPOSE 80

CMD ["apache2-foreground"]
