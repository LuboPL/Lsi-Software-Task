# Raport eksportów

Aplikacja do przeglądania historii eksportów z filtrowaniem po dacie i lokalu.

## Szybki start

1) Uruchom kontenery:

```bash
make up
```

2) Uruchom migracje i seed:

```bash
make init
```

3) Otwórz raport:

- http://localhost:8080/report/export_history

## Testy i jakość

```bash
make tests
```

- PHPStan: level 7 (`make phpstan`)
- PHPUnit: testy jednostkowe (`make phpunit`)

## Przepływ danych

1) Żądanie GET `/report/export_history` trafia do `ExportHistoryController::index`.
2) Formularz mapuje dane do `ExportHistoryFilter`, normalizuje górną datę (`EndOfDayTransformer`) i waliduje zakres (`ExportHistoryDateRange`).
3) Mapper buduje niemutowalne `ExportHistoryCriteria` z `ExportHistoryFilter`.
4) `ExportHistoryReportQuery` pobiera dane z `ExportHistoryReadRepository`.
5) Twig renderuje wynik w `report/export_history.html.twig`.

## Najważniejsze decyzje techniczne

- Rozdzielone modele: DTO formularza (`ExportHistoryFilter`) i niemutowalne kryteria query (`ExportHistoryCriteria`).
- `ExportHistoryReportQueryInterface` i `ExportHistoryReadRepositoryInterface` rozdzielają logikę zapytań od persystencji.
- `LocationProvider` cache'uje listę lokali przez 1h (konfigurowalne w kodzie).
- Moduł `Report/ExportHistory` jest wydzielony pod dalszą rozbudowę raportów.

## Model bazy danych

- `export_history`: `id`, `export_name`, `exported_at`, `exported_by_username`, `location_name`
- Indeksy: `exported_at`, `(location_name, exported_at)`

## Założenia i kompromisy

- Brak paginacji: w produkcji dodałbym limit + offset.
- Relacje: w produkcji dodałbym klucze obce do tabel `user` i `location`.
- Snapshot: `exported_by_username` i `location_name` przechowują stan z momentu eksportu.
- Normalizacja końca dnia jest w formularzu, bo zakres zadania nie obejmuje np API i wejście jest bez godziny.

## Wymagania i stack

- Docker + Docker Compose
- Symfony 7.4 (Twig, Doctrine)
- PHP 8.3 (FPM)
- MySQL 8
- Nginx

## Makefile

- `make up` - uruchamia kontenery
- `make init` - uruchamia migracje i seed
- `make tests` - uruchamia statyczną analizę i testy jednostkowe
- `make down` - zatrzymuje kontenery
- `make reset` - zatrzymuje kontenery i usuwa wolumeny oraz lokalne obrazy
