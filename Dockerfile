# Utilise l'image PHP 8.2 avec Apache et Composer intégrés
FROM composer:2.7 AS build

WORKDIR /app

# Copie les fichiers du projet dans l'image
COPY . .

# Installe les dépendances sans les packages de dev
RUN composer install --no-dev --optimize-autoloader


# Étape finale : PHP avec Apache
FROM php:8.2-apache

# Active mod_rewrite (nécessaire pour Symfony)
RUN a2enmod rewrite

# Copie les fichiers depuis l'étape précédente
COPY --from=build /app /var/www/html

# Change le dossier de travail
WORKDIR /var/www/html

# Configure Apache pour pointer vers /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Expose le port 80
EXPOSE 80
