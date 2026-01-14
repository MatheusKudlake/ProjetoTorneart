FROM php:8.2-apache

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_mysql mysqli

# Ativa mod_rewrite (Laravel, WordPress, etc)
RUN a2enmod rewrite

# Define diretório da aplicação
WORKDIR /var/www/html

# Copia seu código para dentro do container
COPY . /var/www/html

# Ajusta permissões (muito importante)
RUN chown -R www-data:www-data /var/www/html
