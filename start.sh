#!/bin/bash
php artisan migrate --force 2>/dev/null || echo "Skipping migration"
php artisan serve --host=0.0.0.0 --port=$PORT
