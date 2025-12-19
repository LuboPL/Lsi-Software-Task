SHELL := /bin/sh

.PHONY: up down reset wait-db migrate seed seed-reset

up:
	docker compose up -d --build

down:
	docker compose down

reset:
	docker compose down -v --rmi local

wait-db:
	@until docker compose exec -T mysql sh -c 'mysqladmin ping -u"$$MYSQL_USER" -p"$$MYSQL_PASSWORD" -h 127.0.0.1 --silent >/dev/null 2>&1'; do \
		sleep 1; \
	done
	@until docker compose exec -T mysql sh -c 'mysql -u"$$MYSQL_USER" -p"$$MYSQL_PASSWORD" -e "USE $$MYSQL_DATABASE" >/dev/null 2>&1'; do \
		sleep 1; \
	done

migrate: wait-db
	docker compose exec -T php bin/console doctrine:migrations:migrate --no-interaction

seed: wait-db
	docker compose exec -T php bin/console app:seed-export-history

seed-reset: wait-db
	docker compose exec -T php bin/console app:seed-export-history --truncate
