FROM php:7.2-cli
ENV DEBIAN_FRONTEND noninteractive

COPY . /www/data/tiki-home-test
WORKDIR /www/data/tiki-home-test

# PHP Extension
RUN apt-get update && apt-get install -y dialog
RUN apt-get update && apt-get install --assume-yes apt-utils
RUN apt-get update && apt-get install -y apt-transport-https
RUN apt-get install -y libicu-dev
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql intl zip


RUN apt-get update && apt-get install -y git

# Composer & PHPUnit installation
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80
ENTRYPOINT [ "docker-entrypoint.sh" ]