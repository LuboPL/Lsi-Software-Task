# Aplikacja do generowania historii raportów
## Wymagania

- Docker + Docker Compose

## Stack

- Symfony 7.4 (Twig, Doctrine)
- PHP 8.3 (FPM)
- MySQL 8
- Nginx
- PHPUnit
- PHPStan

## Pierwsze uruchomienie (krok po kroku)

1) Uruchom kontenery:

```bash
make up
```

2) Uruchom statyczną analizę kodu i testy jednostkowe:

```bash
make tests
```

3) Uruchom migracje i seed:

```bash
make init
```

4) Otwórz aplikację:

- http://localhost:8080/report/export_history

Opcjonalnie, jeśli chcesz zacząć od zera:

```bash
make reset
```

## Makefile

- `make up` - uruchamia kontenery
- `make down` - zatrzymuje kontenery
- `make reset` - zatrzymuje kontenery i usuwa wolumeny oraz lokalne obrazy
- `make migrate` - uruchamia migracje
- `make seed` - ładuje przykładowe dane
- `make init` - migracje + seed
- `make phpstan` - uruchamia statyczną analizę kodu
- `make phpunit` - uruchamia testy
- `make tests` - statyczna analiza + testy jednostkowe
- `make wait-db` - wewnętrzny target oczekujący na gotową bazę

## Konfiguracja bazy

Domyślne ustawienia w `docker-compose.yml` pochodzą z `.env.example` w root.
