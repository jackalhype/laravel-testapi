FROM php:7.4-fpm-alpine

MAINTAINER kc <kcpi9000@yandex.ru>

RUN apk update --no-cache && apk add curl \
        net-tools

RUN apk add autoconf g++ make && \
    pecl install -f xdebug && \
    docker-php-ext-enable xdebug && \
    apk del --purge autoconf g++ make

EXPOSE 9000

CMD ["php-fpm"]
