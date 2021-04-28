composer install:
```
docker run --rm -it -v $PWD:/app composer install
```

prepare local db:
```
docker run --rm -it -v $PWD:/app -w /app php:7.4 php bin/console doctrine:database:create  
docker run --rm -it -v $PWD:/app -w /app php:7.4 php bin/console  doctrine:migrations:migrate  
```
run test:
```
docker run --rm -it -v $PWD:/app -w /app php:7.4 vendor/bin/phpunit  
```