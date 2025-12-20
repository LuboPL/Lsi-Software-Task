# LsiSoftwareTask

Minimalny szkielet Symfony 7.4 (Twig + Doctrine) w kontenerach Docker: PHP 8.3, MySQL 8, Nginx.

## Wymagania

- Docker + Docker Compose

## Stack

- Symfony 7.4 (Twig, Doctrine)
- PHP 8.3 (FPM)
- MySQL 8
- Nginx

## Pierwsze uruchomienie

1) Skopiuj plik z konfiguracją bazy:

```bash
make copy-env
```

Przy pierwszym uruchomieniu kontenera PHP plik `app/.env` zostanie utworzony z `app/.env.example`
i automatycznie dostanie losowy `APP_SECRET`.

2) Uruchom kontenery:

```bash
make up
```

3) Uruchom migracje i seed:

```bash
make init
```

4) Otwórz aplikację:

- http://localhost:8080

## Makefile

- `make copy-env` - tworzy `.env.local` z `.env.example`, jeśli jeszcze nie istnieje
- `make up` - uruchamia kontenery
- `make down` - zatrzymuje kontenery
- `make reset` - zatrzymuje kontenery i usuwa wolumeny oraz lokalne obrazy
- `make migrate` - uruchamia migracje
- `make seed` - ładuje przykładowe dane
- `make init` - migracje + seed
- `make wait-db` - wewnętrzny target oczekujący na gotową bazę

## Konfiguracja bazy

Domyślne ustawienia w `docker-compose.yml` pochodzą z `.env.local` w root.
Symfony korzysta z `DATABASE_URL` w `app/.env`.
Jeśli zmienisz dane w `.env.local`, zaktualizuj też `app/.env` lub dodaj `app/.env.local`.
