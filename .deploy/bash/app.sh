#!/usr/bin/env bash

composer install

php artisan migrate --path=/database/migrations/** --force --seed

php artisan config:clear
php artisan route:clear

php artisan key:generate

set -a
source .deploy/.env
set +a

find . -type f -exec chmod 664 {} \;
find . -type d -exec chmod 775 {} \;
chgrp -R www-data storage bootstrap/cache
chmod -R ug+rwx storage bootstrap/cache

php-fpm
