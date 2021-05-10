FROM php:8.0-fpm

RUN apt update && apt install -y \
    pkg-config \
    libssl-dev \
    libmcrypt-dev \
    sqlite3 \
    libsqlite3-dev \
    openssl \
    libcurl4-openssl-dev \
    git \
    zip \
    zlib1g-dev \
    libzip-dev \
    unzip \
    mailutils \
    mc \
    openssh-client \
    gnupg \
    gnupg2 \
    gnupg1 \
    nginx \
    supervisor \
    libicu-dev \
    gettext

# Install PECL extensions
RUN \
    pecl install xdebug
#    && docker-php-ext-enable xdebug

# Configure intl extension
RUN \
    docker-php-ext-configure intl

# install mysql support
RUN \
    docker-php-ext-install \
        mysqli \
        pdo \
        pdo_mysql \
        intl \
        pcntl

RUN \
     pecl install redis \
     && docker-php-ext-enable redis

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY supervisord.conf /etc/supervisor
COPY nginx.conf /etc/nginx

CMD ["/usr/bin/supervisord"]
