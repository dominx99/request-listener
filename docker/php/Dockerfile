FROM php:8.1.1-fpm-alpine

WORKDIR /application

RUN set -eux; \
	mkdir -p var/log; \
    chmod 777 var/log

VOLUME /application/var
