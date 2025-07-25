# Utilise l’image PHP officielle avec Apache
FROM php:8.2-apache

# Installe les extensions nécessaires à Symfony
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpq-dev \
    unzip \
    git \
    zip \
    && docker-php-ext-install intl pdo pdo_pgsql opcache

# Active mod_rewrite pour Apache (nécessaire pour Symfony)
RUN a2enmod rewrite

# ✅ Télécharge et installe Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copie les fichiers de ton projet dans le conteneur
COPY . /var/www/html

# Définit le répertoire de travail
WORKDIR /var/www/html

# Installe les dépendances PHP avec Composer
RUN composer install --no-dev --optimize-autoloader

# Expose le port 80 (Apache)
EXPOSE 80
