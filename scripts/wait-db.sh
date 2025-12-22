#!/usr/bin/env sh
set -eu

if [ -z "${MYSQL_DATABASE:-}" ] && [ -f ./.env.example ]; then
  . ./.env.example
fi

dots='...'
i=0

printf 'MySQL '
until docker compose exec -T mysql sh -c 'mysqladmin ping -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" -h 127.0.0.1 --silent >/dev/null 2>&1'; do
  i=$(( (i + 1) % 4 ))
  printf '\rMySQL %.*s   ' "$i" "$dots"
  sleep 1
done
printf '\rMySQL OK\n'

i=0
printf 'Baza "%s" ' "${MYSQL_DATABASE:-}"
until docker compose exec -T mysql sh -c 'mysql -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" -e "USE $MYSQL_DATABASE" >/dev/null 2>&1'; do
  i=$(( (i + 1) % 4 ))
  printf '\rBaza "%s" %.*s   ' "${MYSQL_DATABASE:-}" "$i" "$dots"
  sleep 1
done
printf '\rBaza "%s" OK\n' "${MYSQL_DATABASE:-}"
