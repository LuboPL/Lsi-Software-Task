# Aplikacja do generowania historii raportów
## Wymagania

- Docker + Docker Compose

## Stack

- Symfony 7.4 (Twig, Doctrine)
- PHP 8.3 (FPM)
- MySQL 8
- Nginx

## Pierwsze uruchomienie

1) Uruchom kontenery:

```bash
make up
```

2) Uruchom migracje i seed:

```bash
make init
```

3) Otwórz aplikację:

- http://localhost:8080/report/export_history

## Makefile

- `make up` - uruchamia kontenery
- `make down` - zatrzymuje kontenery
- `make reset` - zatrzymuje kontenery i usuwa wolumeny oraz lokalne obrazy
- `make migrate` - uruchamia migracje
- `make seed` - ładuje przykładowe dane
- `make init` - migracje + seed
- `make wait-db` - wewnętrzny target oczekujący na gotową bazę

## Konfiguracja bazy

Domyślne ustawienia w `docker-compose.yml` pochodzą z `.env.example` w root.
