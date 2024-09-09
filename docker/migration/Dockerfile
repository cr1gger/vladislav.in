FROM php:7.4-cli

RUN curl -sSLf \
        -o /usr/local/bin/install-php-extensions \
        https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions && \
    chmod +x /usr/local/bin/install-php-extensions

RUN apt-get update && apt-get install -y unzip locales wait-for-it && \
    install-php-extensions bcmath sockets pdo pdo_mysql zip ldap
RUN chmod +x /app/docker/migration/migrate.sh
ENTRYPOINT ["/app/docker/migration/migrate.sh"]
