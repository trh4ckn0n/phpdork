# Utilise une image officielle PHP avec PHP-FPM
FROM php:8.2-fpm

# Installer les extensions utiles, par ex. curl, zip, etc. (optionnel)
RUN docker-php-ext-install pdo pdo_mysql

# Installer Nginx
RUN apt-get update && apt-get install -y nginx

# Copier la configuration Nginx custom
COPY nginx.conf /etc/nginx/sites-available/default

# Copier ton code source dans le container
COPY . /var/www/html

# Donner les droits nécessaires
RUN chown -R www-data:www-data /var/www/html

# Exposer le port 80
EXPOSE 80

# Commande de démarrage pour lancer php-fpm + nginx
CMD service php8.2-fpm start && nginx -g 'daemon off;'
