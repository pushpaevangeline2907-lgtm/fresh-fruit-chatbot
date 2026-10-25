# 🍎 Fresh Fruit Shop (Laravel)

A small Laravel 12 application with two parts:

- **Customer Bot** (`/bot`) – a chat page where customers type a fruit name
  (e.g. `Mango`) or `Mango price` and get availability and price per kg.
- **Fruit Management** (`/fruits`) – list, search, add, edit and delete fruits.

16 fruits are loaded by the seeder (Banana, Orange, Mango, Grapes, Watermelon,
Pineapple, Guava, Papaya, Pomegranate, Pear, Lemon, Kiwi, Strawberry, Sapota,
Dragon Fruit, Apple).

## Requirements

This is a PHP project, so dependencies are listed in `composer.json`
(Composer's equivalent of `requirements.txt`).

- PHP **8.2+** with extensions: `pdo_sqlite`, `sqlite3`, `mbstring`, `openssl`,
  `tokenizer`, `xml`, `ctype`, `fileinfo`, `curl`
- [Composer](https://getcomposer.org/) 2.x
- No Node.js needed (views use plain CSS/JS).

## Install and run

```bash
# 1. Go into the extracted folder
cd fresh-fruit-shop

# 2. Install dependencies (creates the vendor/ folder)
composer install

# 3. Create your environment file and app key
cp .env.example .env          # Windows: copy .env.example .env
php artisan key:generate

# 4. Create tables and load the sample fruits
php artisan migrate --seed

# 5. Start the server
php artisan serve
```

Open <http://localhost:8000> – it redirects to the Customer Bot.

**Shortcut:** `composer setup` runs steps 2–4 in one go
(on Windows run it in Git Bash, or use the commands above).

## Pages

| URL | Purpose |
|-----|---------|
| `/bot` | Customer chat bot |
| `/fruits` | Fruit list + search |
| `/fruits/create` | Add a fruit |
| `/fruits/{id}/edit` | Edit a fruit |

## Bot usage

- `Banana` → "Banana is available. Price: ₹100 / kg"
- `Banana price` → "Banana price is ₹100 / kg"
- Anything else → "Sorry, that fruit is not available in our database."

Matching is case-insensitive. Clicking a fruit chip under the chat does the same
as typing its name. Fruits you add on the management page show up in the bot
immediately.

## Configuration

All settings are in `.env` (copied from `.env.example`). No API keys or
passwords are required. The default database is SQLite
(`database/database.sqlite`, already included as an empty file).
To use MySQL, edit the `DB_*` lines in `.env`, create the database, then run
`php artisan migrate --seed`.

## Reset the data

```bash
php artisan migrate:fresh --seed
```

> Running `php artisan db:seed` a second time adds the 16 fruits again
> (duplicates). Use the command above to reset cleanly.

## Run the tests

```bash
php artisan test
```

## Project structure (files for this app)

```
app/Http/Controllers/BotController.php      chat logic
app/Http/Controllers/FruitController.php    CRUD + search
app/Models/Fruit.php
database/migrations/2025_01_01_000000_create_fruits_table.php
database/seeders/FruitSeeder.php
database/seeders/DatabaseSeeder.php
resources/views/bot.blade.php
resources/views/fruits/{index,create,edit}.blade.php
routes/web.php
```

## Troubleshooting

- **"could not find driver"** – enable `pdo_sqlite` / `sqlite3` in `php.ini`.
- **"No application encryption key"** – run `php artisan key:generate`.
- **Bot replies "Something went wrong"** – make sure `.env` exists and run
  `php artisan config:clear`.
- **Permission errors (Linux/macOS)** – `chmod -R 775 storage bootstrap/cache`.
