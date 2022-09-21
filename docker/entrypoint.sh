#!/bin/sh

env=${APP_ENV:-production}
role=${CONTAINER_ROLE:-app}

echo "Waiting for mysql..."
while ! nc -z $DB_HOST $DB_PORT; do
    sleep 0.1
done
echo "MySQL started"

# Queue should wait for app, so in local development we don't do composer installations twice
if [ "$env" = "local" ] && [ "$role" != "app" ]; then

    echo "Waiting for app..."
    while ! nc -z app 80; do
        sleep 0.1
    done
    echo "APP Started"

fi

exec "$@"
