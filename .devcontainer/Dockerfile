FROM mcr.microsoft.com/devcontainers/php:8.2
RUN apt-get update \
    && apt-get install -y default-mysql-client libmariadb-dev \
    && mkdir -p /usr/local/etc/php/conf.d \
    && ln -sf /usr/local/etc/php/conf.d /conf.d \
    && docker-php-ext-install pdo_mysql \
    && apt-get clean