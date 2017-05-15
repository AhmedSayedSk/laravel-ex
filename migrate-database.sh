#!/bin/bash
set -e 

echo "Migrating database 'php artisan migrate --force'..."
php artisan migrate --force

echo "seeding database 'php artisan db:seed'..."
php artisan db:seed
