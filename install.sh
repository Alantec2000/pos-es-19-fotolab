#!/bin/bash

cp .env.example .env

# Ocorrera alguns erros caso não sejam dadas as permissões para essas pastas
mkdir -p storage/app/imgs/foto_perfil storage/app/imgs/foto_capa
chmod 777 ./bootstrap ./storage -R

composer install

php artisan key:generate
php artisan optimize

