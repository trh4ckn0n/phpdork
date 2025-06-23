FROM php:8.2-fpm

# Installer nginx et supervisor
RUN apt-get update && apt-get install -y nginx supervisor

# Copier la config nginx
COPY nginx.conf /etc/nginx/sites-available/default

# Copier la config supervisord
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copier le code source dans /var/www/html
COPY . /var/www/html

# Mettre les droits en root (car tu veux user=root)
RUN chown -R root:root /var/www/html

# Exposer le port 80
EXPOSE 80

# Lancer supervisord en premier plan (root)
CMD ["/usr/bin/supervisord", "-n"]
