# LsiSoftwareTask

Minimalny szkielet Symfony (Twig + Doctrine) w kontenerach Docker: PHP 8.3, MySQL 8, Nginx.

## Wymagania

- Docker + Docker Compose

## Pierwsze uruchomienie

1) Skopiuj plik z konfiguracja bazy:

```bash
cp .env.example .env.local
```

2) Uruchom kontenery:

```bash
make up
```

3) Uruchom migracje:

```bash
make migrate
```

4) Zaladuj przykladowe dane (seed):

```bash
make seed
```

Aby odswiezyc dane:

```bash
make seed-reset
```

5) Otworz aplikacje:

- http://localhost:8080

## Konfiguracja bazy

Domyslne ustawienia w `docker-compose.yml` pochodza z `.env.local` w root.
Symfony korzysta z `DATABASE_URL` w `app/.env`.
Jesli zmienisz dane w `.env.local`, zaktualizuj tez `app/.env` lub dodaj `app/.env.local`.
