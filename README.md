<div align="center">

# Tour And Travel Touch

**Explore Bangladesh — full-stack travel booking platform**

[![Live Site](https://img.shields.io/badge/Live_Demo-tourandtraveltouch--backend.onrender.com-00d2ff?style=for-the-badge)](https://tourandtraveltouch-backend.onrender.com)
[![CI](https://img.shields.io/github/actions/workflow/status/mahfuj735/TourAndTravelTouch/ci.yml?style=for-the-badge&label=CI)](https://github.com/mahfuj735/TourAndTravelTouch/actions)
[![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![Postgres](https://img.shields.io/badge/PostgreSQL-Neon-4169E1?style=for-the-badge&logo=postgresql&logoColor=white)](https://neon.tech)
[![Docker](https://img.shields.io/badge/Docker-Render-2496ED?style=for-the-badge&logo=docker&logoColor=white)](https://render.com)

*No frameworks. No magic. Just engineering — vanilla PHP + PDO, vanilla JS, Bootstrap 5.*

</div>

---

## 🌍 Live

| 🖥️ What | 🔗 URL |
|---|---|
| **Live Website (full-stack)** | [tourandtraveltouch-backend.onrender.com](https://tourandtraveltouch-backend.onrender.com) |
| **Frontend Preview (static)** | [mahfuj735.github.io/TourAndTravelTouch](https://mahfuj735.github.io/TourAndTravelTouch/) |
| **🔐 Admin Panel** | [Admin Login](https://tourandtraveltouch-backend.onrender.com/backend/admin/login.php) |
| **💚 Health Check** | [health.php](https://tourandtraveltouch-backend.onrender.com/backend/handlers/health.php) |
| **📦 Repository** | [mahfuj735/TourAndTravelTouch](https://github.com/mahfuj735/TourAndTravelTouch) |

> Render free sleeps after 15 min idle — first visit takes ~30s to wake. Data never deletes.

---

## ✨ Features

### 🎨 Frontend
- 3D tilt destination cards · particle network canvas · parallax hero · scroll reveal
- Background slideshow (preloaded, zero flicker) · glassmorphism UI · theme switching
- Toast flash messages · auth-aware navbar/booking section · newsletter + footer stats

### ⚙️ Backend (PHP 8.2 + PDO)
- Auth: register/login/logout, bcrypt cost 12, session regeneration ready
- Booking engine: create + validate (dates, travelers) + user-linked records
- Search across destination, travelers, notes, name, email (ILIKE/LIKE per driver)
- Admin realm: separate login, auto-seed, bookings + users dashboard with stats
- CSRF (32-byte) on every POST · flash messaging · JSON health endpoint

### 🗄️ Database (Neon Postgres, MySQL fallback)
- `DATABASE_URL` → Postgres (Neon, persistent) · `DB_*` → MySQL · one PDO layer
- 3 tables: `users`, `information` (bookings), `admins` — see `database/schema-pg.sql`

### 🚀 DevOps
- `Dockerfile` (php-apache + pdo_pgsql/pdo_mysql) · `render.yaml` Blueprint (free tier)
- GitHub Actions CI: PHP lint + stale-asset guard on every push · Render auto-deploys `main`

---

## 🗺️ Destinations

| Destination | Region | Starting From |
|---|---|---|
| Sundarbans 🌿 | Khulna · UNESCO Heritage | 5,000 ৳ |
| Srimangal 🍵 | Sylhet · Tea Gardens | 5,500 ৳ |
| Rangamati 🏞️ | CHT · Lake District | 7,700 ৳ |
| Bandarbans ⛰️ | CHT · Trekking | 6,000 ৳ |
| Saint Martin 🏖️ | Bay of Bengal · Coral Island | 8,000 ৳ |
| Shait-Gumbad 🕌 | Bagerhat · Historic Mosque | 1,500 ৳ |

---

## 🏗️ Architecture

```
Browser (GitHub Pages preview OR Render)
   │  same-origin on Render · absolute BACKEND_URL on Pages
   ▼
PHP 8.2 backend (PDO) — handlers/ + admin/ + config/
   │  prepared statements only
   ▼
Neon Postgres (DATABASE_URL) — users / information / admins
```

**User journey:** Browse → Register → Login → Book (CSRF + validation) → Toast confirm → Admin manages.

---

## 📂 Project Map

```
├── index.html                    # Single-page frontend
├── pages/                        # login.html, signup.html
├── assets/css|js|images/         # themes, config.js (auto backend URL), photos
├── backend/
│   ├── config/app.php            # CORS, session (Lax/None), URLs
│   ├── config/database.php       # PDO: DATABASE_URL (pgsql) → MySQL fallback
│   ├── helpers.php               # CSRF, flash, auth, validation
│   ├── handlers/                 # register, login, logout, booking, search,
│   │                             # csrf-token, flash, auth-status, health
│   └── admin/                    # login.php, dashboard.php, logout.php
├── database/schema.sql           # MySQL schema (legacy/local)
├── database/schema-pg.sql        # Postgres schema (Neon — import once)
├── Dockerfile + render.yaml      # Render free deploy
└── .github/workflows/ci.yml      # PHP lint + asset guard
```

---

## 🚀 Run Locally

```bash
git clone https://github.com/mahfuj735/TourAndTravelTouch.git
cd TourAndTravelTouch

# Option A — Postgres (mirrors production). Set then import schema-pg.sql:
export DATABASE_URL='postgresql://USER:PASS@HOST/DB?sslmode=require'
php -S localhost:8000

# Option B — MySQL local:
# import database/schema.sql, set DB_HOST/DB_NAME/DB_USER/DB_PASS, then:
php -S localhost:8000
```

Open `http://localhost:8000`.

## ☁️ Deploy (free, persistent)

1. **Neon** ([neon.tech](https://neon.tech)): project → copy pooled string → run `database/schema-pg.sql` in SQL Editor.
2. **Render** ([render.com](https://render.com)): New → Blueprint → this repo → env: `DATABASE_URL`, `FRONTEND_URL`, `ADMIN_USER`, `ADMIN_PASS` → Deploy.
3. If service URL ≠ `tourandtraveltouch-backend.onrender.com`, update `PROD_BACKEND` in `assets/js/config.js`.
4. Verify `/backend/handlers/health.php` → `{"ok":true,"db":"up"}`.

---

## ⚙️ Config Reference

| File | Vars | Purpose |
|---|---|---|
| `backend/config/database.php` | `DATABASE_URL` or `DB_HOST/DB_PORT/DB_NAME/DB_USER/DB_PASS` | DB connection (never commit secrets) |
| `backend/config/app.php` | `FRONTEND_URL`, `BACKEND_URL` | CORS + redirects |
| `assets/js/config.js` | `PROD_BACKEND` | API base for GitHub Pages preview |
| Render env | `DATABASE_URL`, `ADMIN_USER`, `ADMIN_PASS` | Production secrets |

## 🔐 Admin Panel

| Detail | Value |
|---|---|
| Live URL | [Admin Login](https://tourandtraveltouch-backend.onrender.com/backend/admin/login.php) |
| Default user | `admin` / `admin123` (set `ADMIN_USER`/`ADMIN_PASS` in Render, change after login) |
| Sees | Total bookings + users stats, bookings table, users table |

## 🛡️ Security

| Threat | Mitigation |
|---|---|
| SQL injection | 100% PDO prepared statements |
| XSS | `htmlspecialchars()` on output |
| Passwords | bcrypt cost 12 |
| CSRF | 32-byte token on all POST |
| Session | HttpOnly, Lax same-site / None+Secure cross-site |
| Secrets | Env only — placeholders in repo |

---

<div align="center">

**Built with 💙 using PHP, Postgres, and Vanilla JavaScript**

*Full-stack. Free-hosted. Never deleted.*

Author: [Mahfujul Karim](https://github.com/mahfuj735) · Live: [Render](https://tourandtraveltouch-backend.onrender.com) · [Pages](https://mahfuj735.github.io/TourAndTravelTouch/)

</div>
