#!/bin/sh
set -e

# Crea carpetas de storage si no existen
# Quien clona el repo no las tiene porque están en .gitignore
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/bootstrap/cache

# Permisos correctos para que Laravel pueda escribir
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

# Copia .env.example si no existe .env
# Esto es lo que le pasa a quien clona desde cero
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Genera APP_KEY solo si está vacía
# Así no sobreescribe una key existente en cada restart
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Limpia cache de config para que tome las variables nuevas
php artisan config:clear

# Migraciones automáticas
# --force permite correr en cualquier APP_ENV sin confirmación
php artisan migrate --force

# Arranca PHP-FPM — diferente al Task Manager que usaba artisan serve
# PHP-FPM queda esperando peticiones de Nginx
exec php-fpm
