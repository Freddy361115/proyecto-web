#!/usr/bin/env bash

set -e

env=${APP_ENV:-production}

# Run installations in the image only if we're not in local development
# If we're local, we'll be mounting our folder which would remove these installations...
if [ "$env" != "local" ]; then


    composer install
    php artisan passport:install
    php artisan passport:keys

    npm install
    npm run prod

fi
