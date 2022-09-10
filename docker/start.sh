#!/usr/bin/env bash

set -e

env=${APP_ENV:-production}
role=${CONTAINER_ROLE:-app}

# We need to cache everything at the final container level
if [ "$env" != "local" ]; then
    php artisan clear-compiled
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

if [ "$role" = "app" ]; then

    php artisan migrate --force
    exec apache2-foreground

elif [ "$role" = "queue" ]; then

    php artisan queue:restart
    supervisord -c /etc/supervisor/conf.d/queue.conf
    supervisorctl reread
    supervisorctl update
    #supervisorctl start queue

elif [ "$role" = "scheduler" ]; then

    echo "Setting up the scheduler..."
    while [ true ]
    do
        php artisan schedule:run --verbose --no-interaction &
        sleep 60
    done
else
    echo "Could not match the container role \"$role\""
    exit 1
fi
