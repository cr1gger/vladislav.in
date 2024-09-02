FROM php:7.4-fpm-alpine

RUN apk update && apk add --no-cache \
    autoconf \
    freetype-dev \
    libjpeg-turbo-dev \
    icu-dev \
    zip \
    libzip-dev \
    wget \
    git \
    imagemagick-dev \
    gmp-dev \
    libreoffice \
    openjdk11-jre-headless

RUN apk --no-cache add msttcorefonts-installer fontconfig && \
    update-ms-fonts && \
    fc-cache -f

RUN apk add \
    build-base \
    imagemagick \
    libxml2-dev

RUN docker-php-ext-install \
    pdo_mysql \
    gd \
    zip \
    exif \
    intl \
    gmp \
    sockets \
    soap

RUN pecl install \
    imagick \
    xlswriter

RUN docker-php-ext-enable imagick


RUN docker-php-ext-enable xlswriter

RUN addgroup -S -g 777 develop \
    && adduser -S -D -u 777 -s /sbin/nologin -h /home/develop -G develop develop

COPY /docker/php/www.conf /usr/local/etc/php-fpm.d/

CMD ["php-fpm"]
