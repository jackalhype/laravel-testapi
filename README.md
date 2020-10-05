# LARAVEL BOOTSTRAP
## PHP7.4, nginx, postgres db, postgres test db

### start:
docker-compose up -d

### stop:
docker-compose down

### Enter db
psql -h localhost -p 54322 -U user -d pizza -W secret

### Enter test db
psql -h localhost -p 54323 -U user -d pizza -W secret

### List dockers:
docker ps

docker ps -a

### Enter docker
docker exec -ti pizza_app_1 sh

### Log Nginx access and errors
docker logs --tail 50 --follow --timestamps pizza_web_1

