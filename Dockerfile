FROM php:8.2-cli

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    unzip \
    libaio1 \
    wget \
    git \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    curl \
    gnupg2 \
    libicu-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip intl xml bcmath

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instala Node.js (versión estable recomendada: 18.x)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g npm

# Configura variables para Oracle (antes de instalar OCI8)
ENV LD_LIBRARY_PATH=/opt/oracle/instantclient

# OCI8 se instalará después de iniciar el contenedor (manual)
