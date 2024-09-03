FROM nginx:alpine

ARG DOMAIN_NAME

WORKDIR /app

COPY ./docker/nginx/conf/*.conf /etc/nginx/conf.d/

RUN sed -i -e "s/\${DOMAIN_NAME}/${DOMAIN_NAME}/g" /etc/nginx/conf.d/vhost.conf


