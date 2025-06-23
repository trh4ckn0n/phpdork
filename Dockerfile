FROM php:8.2-fpm

RUN apt-get update && apt-get install -y nginx supervisor

# Extensions PHP utiles
RUN docker-php-ext-install pdo pdo_mysql

# Copier nginx.conf
COPY nginx.conf /etc/nginx/sites-available/default

# Copier config supervisord
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copier code source
COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["/usr/bin/supervisord", "-n"]
