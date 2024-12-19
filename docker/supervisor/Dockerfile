ARG PHP_IMAGE_TAG=8.2-cli

FROM php:${PHP_IMAGE_TAG} AS base

ARG WORKING_DIR="/var/www/app"
ARG USER=www-data
ARG GROUP=www-data


RUN usermod -u 1000 ${USER} && groupmod -g 1000 www-data

RUN apt-get update && apt-get install -y dos2unix inotify-tools supervisor

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions bcmath sockets opcache gd imagick pdo_mysql intl zip amqp

COPY docker/supervisor/supervisord.conf /etc/supervisor/supervisord.conf

WORKDIR ${WORKING_DIR}

CMD [ "/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/supervisord.conf" ]
