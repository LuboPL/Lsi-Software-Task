#!/usr/bin/env sh
set -eu

if [ ! -f /var/www/html/vendor/autoload.php ]; then
  mkdir -p /var/www/html/vendor
  cp -a /opt/vendor/. /var/www/html/vendor/
fi

exec "$@"
