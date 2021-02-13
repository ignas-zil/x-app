# Docker containers for symfony

Docker containers to run symfony project

### Setup Instructions

1\. Clone docker repository
```
git clone https://github.com/ignas-zil/x-docker.git docker/
```
2\. Setup environment variables inside _docker/.env_ file  
3\. Clone symfony project code into _src_ directory
```
git clone https://github.com/ignas-zil/x-app.git src/
```
4\. Setup _DATABASE_URL_ inside _src/.env_ file  
5\. Boot up containers
```
cd docker/

docker-compose up -d
```
6\. Install vendors
```
docker-compose run php-fpm composer install
```
7\. Run DB migrations
```
docker-compose run php-fpm bin/console doctrine:migrations:migrate
```
8\. Add new candidates
```
docker-compose run php-fpm bin/console cron:new-candidate Name1 1
docker-compose run php-fpm bin/console cron:new-candidate Name1 0
docker-compose run php-fpm bin/console cron:new-candidate Name1 0
docker-compose run php-fpm bin/console cron:new-candidate Name2 0
```