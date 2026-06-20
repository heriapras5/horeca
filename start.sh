#!/bin/bash
echo "Running migrations..."
php artisan migrate --force --verbose || echo "Migration failed, continuing..."
echo "Starting Laravel server..."
php artisan serve --host=0.0.0.0 --port=$PORT
