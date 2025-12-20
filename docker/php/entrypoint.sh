#!/usr/bin/env sh
set -eu

if [ ! -f /var/www/html/vendor/autoload.php ]; then
  mkdir -p /var/www/html/vendor
  cp -a /opt/vendor/. /var/www/html/vendor/
fi

if [ ! -f /var/www/html/.env ] && [ -f /var/www/html/.env.example ]; then
  cp /var/www/html/.env.example /var/www/html/.env
fi

exec "$@"
