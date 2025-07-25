# Image PHP officielle avec Apache
FROM php:8.2-apache

# Mise à jour et installation des extensions PHP nécessaires à Symfony
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpq-dev \
    git \
    unzip \
    zip \
    && docker-php-ext-install intl pdo pdo_pgsql opcache

# Active le mod_rewrite (important pour Symfony)
RUN a2enmod rewrite

# Copie Composer depuis l'image officielle
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie tous les fichiers dans le dossier Apache
COPY . /var/www/html

# Définit le dossier de travail
WORKDIR /var/www/html

# Installation des dépendances Symfony sans les packages de dev
RUN composer install --no-dev --optimize-autoloader

# Déclare le port utilisé
EXPOSE 80

