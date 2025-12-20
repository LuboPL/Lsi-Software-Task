SHELL := /bin/sh

.PHONY: up down reset wait-db migrate seed init

up:
	docker compose up -d --build

down:
	docker compose down

reset:
	docker compose down -v --rmi local

wait-db:
	@sh scripts/wait-db.sh

migrate: wait-db
	docker compose exec -T php bin/console doctrine:migrations:migrate --no-interaction

seed: wait-db
	docker compose exec -T php bin/console app:seed-export-history

init: migrate seed
