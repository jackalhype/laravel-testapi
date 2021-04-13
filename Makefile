# Please, Do not substitute tabs with spaces!

log-php:
	docker logs --tail 50 --follow --timestamps app

log-web:
	docker logs --tail 50 --follow --timestamps web

log-db:
	docker logs --tail 50 -f -t db

php:
	docker exec -ti app sh

web:
	docker exec -ti web bash

db:
	docker exec -ti db bash

up:
	docker-compose -f docker-compose.yml up -d

build:
	docker-compose -f docker-compose.yml build

down:
	docker-compose -f docker-compose.yml down
