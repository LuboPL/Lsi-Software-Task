#!/usr/bin/env sh
set -eu

until docker compose exec -T mysql sh -c 'mysqladmin ping -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" -h 127.0.0.1 --silent >/dev/null 2>&1'; do \
  sleep 1; \
done

until docker compose exec -T mysql sh -c 'mysql -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" -e "USE $MYSQL_DATABASE" >/dev/null 2>&1'; do \
  sleep 1; \
done
