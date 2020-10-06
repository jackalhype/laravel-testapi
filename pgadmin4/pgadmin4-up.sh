#!/bin/bash
docker run -p 5050:80 \
    -e PGADMIN_DEFAULT_EMAIL="postgres@localhost" \
    -e PGADMIN_DEFAULT_PASSWORD="1234" \
    -d --name pgadmin4 dpage/pgadmin4 

# http://localhost:5050

