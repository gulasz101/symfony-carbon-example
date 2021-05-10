```
docker compose up -d
```

composer install:
```
docker compose exec app composer install
```

prepare local db:
```
docker compose exec app php bin/console doctrine:database:create  
docker compose exec app php bin/console  doctrine:migrations:migrate  
```
run test:
```
docker compose exec app vendor/bin/phpunit  
```