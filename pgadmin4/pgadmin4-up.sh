#!/bin/bash
# if not running pgadmin4 with docker-compose, could run it separately

docker run -p 5050:80 \
    -e PGADMIN_DEFAULT_EMAIL="postgres@localhost" \
    -e PGADMIN_DEFAULT_PASSWORD="1234" \
    --network host \
    -d --name pgadmin4_hostnet \
    dpage/pgadmin4

# pgadmin should seen here:
# http://localhost:5050

# could busybox-extras telnet localhost:54322
