ARG PHP_IMAGE_TAG=8.2-cli

FROM php:${PHP_IMAGE_TAG} AS base

ARG USER=www-data
ARG GROUP=www-data

RUN apt-get update && apt-get install wait-for-it && apt-get install -y unzip

RUN usermod -u 1001 ${USER} && groupmod -g 1001 www-data

WORKDIR /var/www/app

COPY custom.ini /usr/local/etc/php/conf.d/custom.ini
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

RUN install-php-extensions bcmath sockets opcache gd imagick pdo_mysql intl zip


FROM base AS dev
COPY --chown=${USER}:${GROUP} . /var/www/app/
RUN  ln -s /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

# ---- production image
FROM base AS prod
COPY --chown=${USER}:${GROUP} . /var/www/app/
RUN  ln -s /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
