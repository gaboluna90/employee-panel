FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev libzip-dev zip unzip curl git \
    && docker-php-ext-install pdo pdo_pgsql zip \
    && apt-get clean

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ARG UID=1000
ARG GID=1000
RUN groupadd -g ${GID} appuser \
    && useradd -u ${UID} -g appuser -m appuser

WORKDIR /var/www/html

COPY --chown=appuser:appuser composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader --no-interaction

COPY --chown=appuser:appuser . .
RUN composer dump-autoload --optimize --no-scripts \
    && chmod +x entrypoint.sh

USER appuser

EXPOSE 9000
CMD ["php-fpm"]
