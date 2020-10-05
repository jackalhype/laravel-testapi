FROM php:7.4-fpm-alpine

MAINTAINER kc <kcpi9000@yandex.ru>

RUN apk update && apk add curl \
        net-tools

EXPOSE 9000

CMD ["php-fpm"]
