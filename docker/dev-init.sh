#!/bin/bash

source ../.env

if [ -z $HOST_DB_STORAGE_ROOT ]; then
    echo "HOST_DB_STORAGE_ROOT not set in .env"
    exit 1
fi

# host pgadmin volumes:
sudo mkdir -p "${HOST_DB_STORAGE_ROOT}"/var/lib/pgadmin && sudo chmod -R 0777 "${HOST_DB_STORAGE_ROOT}"/var/lib/pgadmin

# host postgres volumes:
sudo mkdir -p "${HOST_DB_STORAGE_ROOT}"/var/lib/postgresql/data && chmod -R 0777 "${HOST_DB_STORAGE_ROOT}"/var/lib/postgresql/data
