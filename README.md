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

1) Skopiuj plik z konfiguracja bazy:

```bash
make copy-env
```

Przy pierwszym uruchomieniu kontenera PHP plik `app/.env` zostanie utworzony z `app/.env.example`
i automatycznie dostanie losowy `APP_SECRET`.

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

5) Aby odswiezyc dane:

```bash
make seed-reset
```

6) Otworz aplikacje:

- http://localhost:8080

## Konfiguracja bazy

Domyslne ustawienia w `docker-compose.yml` pochodza z `.env.local` w root.
Symfony korzysta z `DATABASE_URL` w `app/.env`.
Jesli zmienisz dane w `.env.local`, zaktualizuj tez `app/.env` lub dodaj `app/.env.local`.
