#!/usr/bin/env bash

set -e


COMPOSER_MEMORY_LIMIT=2G composer install --no-scripts --ignore-platform-reqs


npm install
npm install vue
npm rebuild node-sass --force
npm run dev
