# Installation

Guide to run **Contract Management System** on your local machine.

---

## Requirements

| Tool | Minimum Version |
|---|---|
| PHP | 8.1 |
| Composer | 2.4 |
| MySQL / MariaDB | 8.0 / 10.3 |
| Node.js | 16.x |
| NPM | 8.x |
| Git | 2.30 |

**Required PHP extensions:** `bcmath`, `ctype`, `fileinfo`, `gd`, `json`, `mbstring`, `openssl`, `pdo_mysql`, `tokenizer`, `xml`, `zip`.

Check with:

```bash
php -m
```

---

## Setup

### 1. Clone the repository

```bash
git clone https://github.com/username/contract-management.git
cd contract-management
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Create database

```sql
CREATE DATABASE contract_management
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
```

Update `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=contract_management
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrate & seed

```bash
php artisan migrate --seed
```

This creates all tables and seeds roles, permissions, demo users, projects, and 10 sample contracts.

### 6. Link storage

```bash
php artisan storage:link
```

Required for signature files and generated PDFs.

### 7. Build assets

```bash
npm run dev
```

### 8. Start the server

```bash
php artisan serve
```

Open **http://localhost:8000**.

---

## Environment Variables

Key `.env` values for local development:

```env
APP_NAME="Contract Management"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000
APP_TIMEZONE=Asia/Jakarta
APP_LOCALE=id

DB_CONNECTION=mysql
DB_DATABASE=contract_management
DB_USERNAME=root
DB_PASSWORD=

FILESYSTEM_DISK=public
```

---

## Default Accounts

After seeding, log in with any of these:

| Role | Email | Password |
|---|---|---|
| Super Admin | `admin@example.com` | `123123` |
| HRD | `hrd@example.com` | `123123` |
| HRD Head | `hana@example.com` | `123123` |
| General Manager | `muslimin@example.com` | `123123` |
| Employee | `karyawan@example.com` | `123123` |

> Change all default passwords before any real deployment.

---

## Troubleshooting

| Problem | Solution |
|---|---|
| `Class 'Spatie\Permission\...' not found` | `composer dump-autoload && php artisan config:clear` |
| `Permission denied` on storage | `chmod -R 775 storage bootstrap/cache` |
| `Storage link already exists` | `rm public/storage && php artisan storage:link` |
| `SQLSTATE[HY000] [2002]` | Check MySQL is running and `.env` credentials |
| Blank page | `php artisan optimize:clear` then check `storage/logs/laravel.log` |
| PDF not generated | Ensure `gd` extension is enabled (`php -m | grep gd`) |
| `npm run dev` fails | `rm -rf node_modules package-lock.json && npm install` |

---

## Next Steps

- [Workflow](workflow.md) — contract status flow
- [Roles & Permissions](roles-permissions.md) — access matrix
- [Features](features/) — feature deep-dives