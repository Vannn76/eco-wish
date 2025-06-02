#!/bin/sh

# Bersihin dan cache ulang config Laravel
php artisan config:clear
php artisan config:cache

# Jalankan migrate (wajib --force biar jalan di CI/CD)
php artisan migrate --force

# Start server Laravel
php artisan serve --host=0.0.0.0 --port=8080
