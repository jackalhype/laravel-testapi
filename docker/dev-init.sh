#!/bin/bash

# host pgadmin volumes:
sudo mkdir -p /private/var/lib/pgadmin && sudo chmod -R 0777 /private/var/lib/pgadmin

# host postgres volumes:
sudo mkdir -p /private/var/lib/postgresql/data && chmod -R 0777 /private/var/lib/postgresql/data
