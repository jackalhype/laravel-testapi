FROM dpage/pgadmin4

MAINTAINER kc <kcpi9000@yandex.ru>

USER root

RUN apk update --no-cache && apk add \
        busybox-extras \
        net-tools

# busybox-extras telnet db 5432

USER pgadmin
