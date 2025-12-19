#!/usr/bin/env sh
set -eu

if [ ! -f /var/www/html/vendor/autoload.php ]; then
  mkdir -p /var/www/html/vendor
  cp -a /opt/vendor/. /var/www/html/vendor/
fi

if [ ! -f /var/www/html/.env ] && [ -f /var/www/html/.env.example ]; then
  cp /var/www/html/.env.example /var/www/html/.env
fi

if [ -f /var/www/html/.env ]; then
  secret=$(awk -F= '/^APP_SECRET=/{print $2}' /var/www/html/.env | tail -n 1)
  if [ -z "$secret" ]; then
    new_secret=$(php -r "echo bin2hex(random_bytes(16));")
    if grep -q '^APP_SECRET=' /var/www/html/.env; then
      sed -i "s/^APP_SECRET=.*/APP_SECRET=$new_secret/" /var/www/html/.env
    else
      printf '\nAPP_SECRET=%s\n' "$new_secret" >> /var/www/html/.env
    fi
  fi
fi

exec "$@"
