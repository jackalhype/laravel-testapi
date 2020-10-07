FROM php:7.4-fpm-alpine

MAINTAINER kc <kcpi9000@yandex.ru>

ENV XDBG_BUILD_DEPS \
    autoconf \
    g++ \
    make

ENV PG_BUILD_DEPS \
    postgresql-dev

RUN apk update

# debuggin net:
RUN apk add \
    curl \
    busybox-extras \
    net-tools

# postgres pdo:
RUN apk add --virtual .pg-build-deps $PG_BUILD_DEPS
RUN docker-php-ext-install -j$(nproc) pdo_pgsql

# xdebug:
RUN apk add --virtual .xdbg-build-deps $XDBG_BUILD_DEPS
RUN pecl install -f xdebug && \
    docker-php-ext-enable xdebug

# cleaning up:
# RUN apk del .xdbg-build-deps && \
#    apk del .pg-build-deps

EXPOSE 9000

CMD ["php-fpm"]

RUN adduser -D -H -h /var/www/html app
USER app
