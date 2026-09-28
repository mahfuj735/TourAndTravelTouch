<div align="center">

<img src="assets/images/ui/logo.png" alt="Tour And Travel Touch logo" width="72" />

# Tour And Travel Touch

### Explore Bangladesh — a full-stack travel booking platform

[![Live Website](https://img.shields.io/badge/Live_Website-Online-00d2ff?style=for-the-badge&logo=render&logoColor=white)](https://tourandtraveltouch-backend.onrender.com)
[![CI](https://img.shields.io/github/actions/workflow/status/mahfuj735/TourAndTravelTouch/ci.yml?style=for-the-badge&label=CI&logo=github)](https://github.com/mahfuj735/TourAndTravelTouch/actions)
[![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![PostgreSQL](https://img.shields.io/badge/PostgreSQL-Neon-4169E1?style=for-the-badge&logo=postgresql&logoColor=white)](https://neon.tech)
[![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?style=for-the-badge&logo=docker&logoColor=white)](./Dockerfile)
[![License](https://img.shields.io/badge/License-MIT-6c5ce7?style=for-the-badge)](./LICENSE)

**Vanilla PHP 8.2 + PDO · Neon Postgres · Vanilla JS + Bootstrap 5 · Dockerized on Render (free tier) · Static mirror on GitHub Pages**

*No frameworks. No ORM. Every query hand-written, every animation frame-tuned.*

[🌍 Live Website](https://tourandtraveltouch-backend.onrender.com) · [🔐 Admin Panel](https://tourandtraveltouch-backend.onrender.com/backend/admin/login.php) · [💚 Health Check](https://tourandtraveltouch-backend.onrender.com/backend/handlers/health.php) · [📖 Docs](#-table-of-contents)

</div>

---

## 📑 Table of Contents

- [🌍 Live Deployment](#-live-deployment)
- [📸 Screenshots](#-screenshots)
- [✨ Features](#-features)
- [🛠️ Tech Stack](#️-tech-stack)
- [🏗️ Architecture](#️-architecture)
- [🗄️ Database Schema](#️-database-schema)
- [📂 Project Structure](#-project-structure)
- [🚀 Getting Started](#-getting-started)
- [☁️ Deployment](#️-deployment)
- [⚙️ Configuration](#️-configuration)
- [🔌 API Reference](#-api-reference)
- [🔐 Admin Panel](#-admin-panel)
- [🛡️ Security](#️-security)
- [⚡ Performance](#-performance)
- [🔄 CI/CD](#-cicd)
- [🤝 Contributing](#-contributing)
- [📄 License](#-license)

---

## 🌍 Live Deployment

| Environment | URL | Status |
|---|---|---|
| **Production (full-stack)** | [tourandtraveltouch-backend.onrender.com](https://tourandtraveltouch-backend.onrender.com) | 🟢 Live — PHP backend + Neon Postgres |
| **Admin Panel** | [Backend admin login](https://tourandtraveltouch-backend.onrender.com/backend/admin/login.php) | 🟢 Live |
| **Health Check** | [JSON status endpoint](https://tourandtraveltouch-backend.onrender.com/backend/handlers/health.php) | 🟢 `{"ok":true,"db":"up"}` |
| **Static Mirror** | [mahfuj735.github.io/TourAndTravelTouch](https://mahfuj735.github.io/TourAndTravelTouch/) | 🟢 Live — frontend preview, API calls go to Render |
| **Repository** | [github.com/mahfuj735/TourAndTravelTouch](https://github.com/mahfuj735/TourAndTravelTouch) | 🟢 Public |

> **Free-tier note:** Render sleeps after ~15 min idle and wakes on the next request (~30 s cold start). The database (Neon) and code (GitHub) persist — nothing is ever deleted for inactivity.

---

## 📸 Screenshots

| Homepage | Login |
|---|---|
| <img src="assets/images/ui/live_homepage.png" alt="Homepage" width="100%" /> | <img src="assets/images/ui/live_login.png" alt="Login page" width="100%" /> |

| Booking Section | Admin Panel |
|---|---|
| <img src="assets/images/ui/book-img.png" alt="Booking form" width="100%" /> | <img src="assets/images/ui/live_admin_login.png" alt="Admin login" width="100%" /> |

---

## ✨ Features

### 🎨 Frontend (`index.html`, `pages/`, `assets/`)

| Feature | Detail |
|---|---|
| 3D Tilt Cards | Mouse-tracked CSS 3D transforms with eased reset |
| Particle Network | Canvas nodes + spring edges reacting to cursor |
| Parallax Hero | Multi-layer depth via `requestAnimationFrame` |
| Background Slideshow | Preloaded cross-fade, zero flicker |
| Scroll Reveal | `IntersectionObserver` fade/slide at thresholds |
| Glassmorphism UI | `backdrop-filter` nav, modals, cards |
| Theme Switching | Orange & Red palettes via CSS custom properties |
| Toast Notifications | Flash messages consumed as JSON, auto-dismiss |
| Auth-aware UI | Navbar + booking section adapt to login state |
| Smart Backend URL | Same-origin on Render/localhost, absolute URL on GitHub Pages |

### ⚙️ Backend (`backend/`, PHP 8.2 + PDO)

| Feature | Detail |
|---|---|
| Registration | Validation → bcrypt (cost 12) → duplicate-email guard |
| Login / Logout | `password_verify` → session + CSRF-protected forms |
| Booking Engine | Travelers/date validation → user-linked insert → flash confirm |
| Search | One query across destination, travelers, notes, name, email (`ILIKE`/`LIKE` per driver) |
| CSRF Protection | 32-byte session tokens on every state-changing POST |
| Flash Messaging | Session-backed success/error, consumed via JSON |
| Health Endpoint | `/backend/handlers/health.php` → DB + driver status JSON |
| Dual-driver DB | `DATABASE_URL` (Postgres/Neon) with MySQL fallback — one PDO layer |

### 🗄️ Database

| Table | Purpose |
|---|---|
| `users` | Accounts (`fullname`, unique `email`, bcrypt `password_hash`) |
| `information` | Bookings (destination, travelers, dates, notes + user link) |
| `admins` | Admin credentials, auto-seeded on first login |

### 🚀 DevOps

| Piece | Detail |
|---|---|
| `Dockerfile` | `php:8.2-apache` + `pdo_pgsql`/`pdo_mysql`, serves on `$PORT` |
| `render.yaml` | Blueprint for one-click free-tier deploy with health check |
| `ci.yml` | PHP syntax check + stale-asset guard on every push |
| Auto-deploy | Render rebuilds + redeploys `main` on every push |

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Language | PHP 8.2 (`declare(strict_types=1)` throughout) |
| Database Access | PDO prepared statements (Postgres + MySQL drivers) |
| Production DB | Neon Postgres (free, persistent) |
| Hosting | Render free web service (Docker, auto-deploy, health checks) |
| Frontend | HTML5 · CSS3 · Vanilla JS (ES6+) · Bootstrap 5.0.2 · Font Awesome 6.2.1 |
| Fonts | Google Fonts (Poppins, Inter) |
| Static Mirror | GitHub Pages |
| CI | GitHub Actions |

---

## 🏗️ Architecture

```mermaid
flowchart TB
    subgraph Client["🌐 Client"]
        PAGES["GitHub Pages<br/>(static preview)"]
        RENDER_WWW["Render<br/>(full site)"]
    end
    subgraph Backend["⚙️ PHP 8.2 Backend (Render, Docker)"]
        HAND["handlers/<br/>register · login · booking<br/>search · health · ..."]
        ADMIN["admin/<br/>login · dashboard"]
        CFG["config/<br/>app + database (PDO)"]
    end
    subgraph Data["🗄️ Neon Postgres"]
        USR[("users")]
        BOOK[("information")]
        ADM[("admins")]
    end
    PAGES -->|"HTTPS + CORS"| Backend
    RENDER_WWW -->|"same-origin"| Backend
    HAND --> CFG --> Data
    ADMIN --> CFG --> Data
```

**Request flow (booking):**

```mermaid
sequenceDiagram
    participant U as 🧑 User
    participant F as 🌐 Frontend
    participant P as ⚙️ PHP Backend
    participant D as 🗄️ Neon Postgres
    U->>F: Fills booking form
    F->>P: POST /handlers/booking.php + CSRF token
    P->>P: Validate CSRF · dates · travelers · session
    P->>D: INSERT INTO information (PDO prepared)
    D-->>P: ✅ Row stored
    P-->>F: Redirect + flash message
    F-->>U: 🎉 Toast confirmation
```

---

## 🗄️ Database Schema

```mermaid
erDiagram
    users {
        int id PK
        string fullname
        string email UK
        string password_hash "bcrypt"
        timestamptz created_at
    }
    information {
        int id PK
        string whereto
        string howmany
        date arrival
        date leaving
        text textdata
        int user_id FK "nullable"
        string user_name
        string user_email
        timestamptz created_at
    }
    admins {
        int id PK
        string username UK
        string password_hash "bcrypt"
        timestamptz created_at
    }
    users ||--o{ information : "books"
```

- Postgres DDL: [`database/schema-pg.sql`](./database/schema-pg.sql) — import once via Neon SQL Editor.
- MySQL DDL (legacy/local): [`database/schema.sql`](./database/schema.sql).

---

## 📂 Project Structure

```
├── index.html                  # Single-page frontend (home → search)
├── pages/                      # login.html · signup.html
├── assets/
│   ├── css/                    # theme-orange.css · theme-red.css
│   ├── js/config.js            # Backend URL auto-detection
│   └── images/                 # destinations · ui
├── backend/
│   ├── config/app.php          # CORS · sessions · URLs
│   ├── config/database.php     # PDO: DATABASE_URL → MySQL fallback
│   ├── helpers.php             # CSRF · flash · auth · validation
│   ├── handlers/               # register · login · logout · booking ·
│   │                           # search · csrf-token · flash ·
│   │                           # auth-status · health
│   └── admin/                  # login.php · dashboard.php · logout.php
├── database/schema-pg.sql      # Postgres schema (Neon)
├── database/schema.sql         # MySQL schema (legacy/local)
├── Dockerfile                  # php-apache + pdo drivers, $PORT-ready
├── render.yaml                 # Render Blueprint (free tier)
└── .github/workflows/ci.yml    # PHP lint + asset-path guard
```

---

## 🚀 Getting Started

### Prerequisites

| Tool | Version |
|---|---|
| PHP | 8.2+ (with `pdo_pgsql` and/or `pdo_mysql`) |
| Database | Neon Postgres (production) or MySQL 5.7+ (local) |
| Docker *(optional)* | For containerized local run |

### Local Run

```bash
git clone https://github.com/mahfuj735/TourAndTravelTouch.git
cd TourAndTravelTouch

# Option A — Postgres (mirrors production)
export DATABASE_URL='postgresql://USER:PASS@HOST/DB?sslmode=require'
php -S localhost:8000

# Option B — local MySQL (import database/schema.sql first)
export DB_HOST=localhost DB_NAME=tour DB_USER=root DB_PASS=secret
php -S localhost:8000
```

Open `http://localhost:8000`. Admin seeds itself on first visit to `/backend/admin/login.php`
(default `admin` / `admin123` — change immediately, or set `ADMIN_USER`/`ADMIN_PASS`).

### Docker Run

```bash
docker build -t tourandtravel .
docker run -p 10000:10000 -e PORT=10000 -e DATABASE_URL='postgresql://...' tourandtravel
```

---

## ☁️ Deployment

Free tier, persistent — sleeps when idle, never deleted.

| # | Step |
|---|---|
| 1 | **Neon** ([neon.tech](https://neon.tech)): create project → copy pooled connection string → run `database/schema-pg.sql` once in SQL Editor |
| 2 | **Render** ([render.com](https://render.com)): New → Blueprint → select this repo |
| 3 | Set env vars: `DATABASE_URL`, `FRONTEND_URL`, `ADMIN_USER`, `ADMIN_PASS` |
| 4 | Deploy — every push to `main` redeploys automatically |
| 5 | Verify `/backend/handlers/health.php` returns `{"ok":true,"db":"up"}` |

If the Render service URL differs from `tourandtraveltouch-backend.onrender.com`,
update `PROD_BACKEND` in `assets/js/config.js` so the GitHub Pages preview points at it.

---

## ⚙️ Configuration

| File | Variables | Purpose |
|---|---|---|
| `backend/config/database.php` | `DATABASE_URL` *(preferred)* or `DB_HOST`/`DB_PORT`/`DB_NAME`/`DB_USER`/`DB_PASS` | Database connection — env only, never commit secrets |
| `backend/config/app.php` | `FRONTEND_URL`, `BACKEND_URL` | CORS origins + post-action redirects |
| `assets/js/config.js` | `PROD_BACKEND` | API base used by the GitHub Pages preview |
| Render env | `DATABASE_URL`, `ADMIN_USER`, `ADMIN_PASS` | Production secrets |

---

## 🔌 API Reference

All POST handlers validate CSRF tokens (fetched from `csrf-token.php` and injected into forms automatically).

| Endpoint | Method | Auth | Description |
|---|---|---|---|
| `/backend/handlers/register.php` | POST | — | Create account (`fullname`, `email`, `password` ≥ 8 chars) |
| `/backend/handlers/login.php` | POST | — | Session login (`email`, `password`) |
| `/backend/handlers/logout.php` | GET/POST | User | Destroy session |
| `/backend/handlers/booking.php` | POST | User | Create booking (`whereto`, `howmany`, `arrival`, `leaving`, `notes?`) |
| `/backend/handlers/search.php` | POST | — | Search bookings (`search`), renders results page |
| `/backend/handlers/auth-status.php` | GET | — | `{loggedIn, user?}` JSON for the frontend |
| `/backend/handlers/csrf-token.php` | GET | — | `{token}` JSON |
| `/backend/handlers/flash.php` | GET | — | Pending flash message JSON (consumed once) |
| `/backend/handlers/health.php` | GET | — | `{ok, db, driver, time}` JSON |

---

## 🔐 Admin Panel

| Item | Value |
|---|---|
| Live URL | [Admin Login](https://tourandtraveltouch-backend.onrender.com/backend/admin/login.php) |
| Local URL | `/backend/admin/login.php` |
| Default credentials | `admin` / `admin123` (override via `ADMIN_USER` / `ADMIN_PASS`) |
| Capabilities | Booking + user tables, totals dashboard, auto-seed on first run |

> ⚠️ Change the default password immediately after first login.

---

## 🛡️ Security

| Threat | Mitigation |
|---|---|
| SQL injection | 100% PDO prepared statements — no string-interpolated SQL |
| XSS | `htmlspecialchars(..., ENT_QUOTES)` on every rendered value |
| Password leaks | bcrypt, cost factor 12 |
| CSRF | 32-byte per-session tokens on all state-changing POSTs |
| Session hijacking | HttpOnly cookies · `Lax` same-site / `None`+`Secure` cross-site |
| Secret leaks | Env-only credentials · placeholders in repo · `.env` git-ignored |
| Transport | HTTPS enforced by Render |

---

## ⚡ Performance

| Area | Detail |
|---|---|
| Animations | GPU-friendly `transform`/`opacity` only, `requestAnimationFrame` loops |
| Images | Preloaded slideshow, long-lived cache headers via `.htaccess` |
| Queries | Indexed lookups, `LIMIT 100` on search, no `SELECT *` in loops |
| Cold starts | Render free sleeps when idle (~30 s first-hit wake); steady-state is warm |

---

## 🔄 CI/CD

```mermaid
gitGraph
    commit id: "push to main"
    commit id: "CI: php -l + asset guard"
    commit id: "Render: build Docker image"
    commit id: "Render: live + health check"
```

- **CI** (`.github/workflows/ci.yml`): PHP syntax check across all files + guard against
  space-containing asset paths — runs on every push/PR.
- **CD**: Render Blueprint auto-deploys `main`; `/backend/handlers/health.php` is the
  configured health-check path.

---

## 🤝 Contributing

`Fork → Feature Branch → Commit → Push → Pull Request`

| Rule | Reason |
|---|---|
| PDO prepared statements for all SQL | Zero tolerance for injection |
| CSRF token on all POST handlers | Every state change must be authorized |
| Escape all output | XSS prevention is non-negotiable |
| No framework dependencies | Core architectural constraint |

---

## 📄 License

Open for educational and portfolio use. See [LICENSE](./LICENSE) for details
*(if the file is missing, treat the code as all-rights-reserved by the author).*

---

<div align="center">

**Built with 💙 — PHP · Postgres · Vanilla JS**

*Full-stack. Free-hosted. Never deleted.*

✍️ Author: [Mahfujul Karim](https://github.com/mahfuj735) ·
🌍 [Live Website](https://tourandtraveltouch-backend.onrender.com) ·
🖼️ [Static Preview](https://mahfuj735.github.io/TourAndTravelTouch/) ·
🔐 [Admin](https://tourandtraveltouch-backend.onrender.com/backend/admin/login.php)

</div>
