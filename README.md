<div align="center" id="top">

<img src="assets/images/ui/logo.png" alt="Tour And Travel Touch" width="84" />

[![Typing SVG](https://readme-typing-svg.demolab.com?font=Poppins&weight=600&size=26&duration=2800&pause=900&color=00D2FF&center=true&vCenter=true&width=560&lines=Tour+And+Travel+Touch;Explore+Bangladesh;Full-Stack+Booking+Platform)](https://tourandtraveltouch-backend.onrender.com)

**A full-stack travel booking platform — vanilla PHP 8.2 · Neon Postgres · vanilla JS · Dockerized on Render**

[![Live Website](https://img.shields.io/badge/🌍_Live_Website-Online-00d2ff?style=for-the-badge)](https://tourandtraveltouch-backend.onrender.com)
[![CI](https://img.shields.io/github/actions/workflow/status/mahfuj735/TourAndTravelTouch/ci.yml?style=for-the-badge&label=CI&logo=github)](https://github.com/mahfuj735/TourAndTravelTouch/actions)
[![Last Commit](https://img.shields.io/github/last-commit/mahfuj735/TourAndTravelTouch?style=for-the-badge&logo=git&logoColor=white)](https://github.com/mahfuj735/TourAndTravelTouch/commits/main)
[![Repo Size](https://img.shields.io/github/repo-size/mahfuj735/TourAndTravelTouch?style=for-the-badge)](https://github.com/mahfuj735/TourAndTravelTouch)
[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=for-the-badge)](https://github.com/mahfuj735/TourAndTravelTouch/pulls)
[![MIT License](https://img.shields.io/badge/License-MIT-6c5ce7?style=for-the-badge)](./LICENSE)

`PHP 8.2` `PDO` `PostgreSQL` `Docker` `JavaScript ES6+` `Bootstrap 5` `GitHub Actions`

[🌍 Live Website](https://tourandtraveltouch-backend.onrender.com) ·
[🔐 Admin Panel](https://tourandtraveltouch-backend.onrender.com/backend/admin/login.php) ·
[💚 Health](https://tourandtraveltouch-backend.onrender.com/backend/handlers/health.php) ·
[🖼️ Preview](https://mahfuj735.github.io/TourAndTravelTouch/) ·
[📂 Repo](https://github.com/mahfuj735/TourAndTravelTouch)

</div>

---

## 📑 Table of Contents

<details>
<summary><b>Click to expand</b></summary>

- [🌍 Live Deployment](#-live-deployment)
- [💡 Why This Project](#-why-this-project)
- [📸 Screenshots](#-screenshots)
- [✨ Features](#-features)
- [🛠️ Tech Stack](#️-tech-stack)
- [🏗️ Architecture](#️-architecture)
- [🗄️ Database](#️-database)
- [📂 Project Structure](#-project-structure)
- [🚀 Getting Started](#-getting-started)
- [☁️ Deployment](#️-deployment)
- [⚙️ Configuration](#️-configuration)
- [🔌 API Reference](#-api-reference)
- [🔐 Admin Panel](#-admin-panel)
- [🛡️ Security](#️-security)
- [⚡ Performance](#-performance)
- [🔄 CI/CD](#-cicd)
- [🗺️ Roadmap](#️-roadmap)
- [❓ FAQ](#-faq)
- [🤝 Contributing](#-contributing)
- [📄 License](#-license)

</details>

---

## 🌍 Live Deployment

<div align="center">

| Environment | URL | Status |
|---|---|---|
| **🚀 Production** (full-stack) | [tourandtraveltouch-backend.onrender.com](https://tourandtraveltouch-backend.onrender.com) | 🟢 Live |
| **🔐 Admin Panel** | [Admin login](https://tourandtraveltouch-backend.onrender.com/backend/admin/login.php) | 🟢 Live |
| **💚 Health Check** | [health.php](https://tourandtraveltouch-backend.onrender.com/backend/handlers/health.php) | 🟢 `{"ok":true,"db":"up"}` |
| **🖼️ Static Mirror** | [mahfuj735.github.io/TourAndTravelTouch](https://mahfuj735.github.io/TourAndTravelTouch/) | 🟢 Live (API → Render) |

</div>

> **Demo login:** `admin` / `admin123` on the [admin panel](https://tourandtraveltouch-backend.onrender.com/backend/admin/login.php) — change it after first login.
>
> **Free-tier note:** Render sleeps after ~15 min idle and wakes on the next request (~30 s cold start). Code (GitHub) and data (Neon) persist — nothing is deleted for inactivity.

---

## 💡 Why This Project

<div align="center">

| 🛡️ **Security-first** | 🎨 **Crafted frontend** |
|---|---|
| PDO prepared statements everywhere, bcrypt-12, CSRF on every POST, escaped output | 3D tilt cards, particle canvas, parallax hero, glassmorphism — zero frontend frameworks |
| 🏗️ **Clean architecture** | 🚀 **Real DevOps** |
| Dual-driver PDO layer (Postgres + MySQL), strict types, Dockerized, health-checked | CI on every push, Blueprint deploy, auto-deploy from `main` |

</div>

---

## 📸 Screenshots

<details open>
<summary><b>Homepage & Authentication</b></summary>
<br />

| 🏠 Homepage | 🔑 Login |
|---|---|
| <img src="assets/images/ui/live_homepage.png" alt="Homepage" width="100%" /> | <img src="assets/images/ui/live_login.png" alt="Login page" width="100%" /> |

</details>

<details>
<summary><b>Booking & Admin</b></summary>
<br />

| 📝 Booking Section | 🔐 Admin Login |
|---|---|
| <img src="assets/images/ui/book-img.png" alt="Booking form" width="100%" /> | <img src="assets/images/ui/live_admin_login.png" alt="Admin login" width="100%" /> |

| ℹ️ About Section |
|---|
| <img src="assets/images/ui/about-img.png" alt="About section" width="100%" /> |

</details>

---

## ✨ Features

<details open>
<summary><b>🎨 Frontend — <code>index.html</code> · <code>pages/</code> · <code>assets/</code></b></summary>
<br />

| Feature | Detail |
|---|---|
| 3D Tilt Cards | Cursor-tracked CSS 3D transforms with eased reset |
| Particle Network | Canvas nodes + spring edges reacting to the mouse |
| Parallax Hero | Multi-layer depth driven by `requestAnimationFrame` |
| Background Slideshow | Preloaded cross-fade — zero flicker |
| Scroll Reveal | `IntersectionObserver` fade/slide at tuned thresholds |
| Glassmorphism UI | `backdrop-filter` navigation, modals and cards |
| Theme Switching | Orange & Red palettes via CSS custom properties |
| Toast Notifications | Flash messages consumed as JSON, auto-dismiss |
| Auth-aware UI | Navbar + booking section adapt to login state |
| Smart Backend URL | Same-origin on Render/localhost, absolute URL on GitHub Pages |

</details>

<details>
<summary><b>⚙️ Backend — <code>backend/</code> · PHP 8.2 + PDO</b></summary>
<br />

| Feature | Detail |
|---|---|
| Registration | Validation → bcrypt (cost 12) → duplicate-email guard |
| Login / Logout | `password_verify` → session-backed auth |
| Booking Engine | Travelers + date validation → user-linked insert → flash confirm |
| Search | One query across destination, travelers, notes, name, email (`ILIKE`/`LIKE` per driver) |
| CSRF Protection | 32-byte session tokens on every state-changing POST |
| Flash Messaging | Session-backed success/error, consumed once via JSON |
| Health Endpoint | `GET /backend/handlers/health.php` → `{ok, db, driver, time}` |
| Dual-driver DB | `DATABASE_URL` (Postgres/Neon) with MySQL fallback — single PDO layer |

</details>

<details>
<summary><b>🗄️ Database & 🚀 DevOps</b></summary>
<br />

| Area | Detail |
|---|---|
| Tables | `users` · `information` (bookings) · `admins` |
| Schemas | `database/schema-pg.sql` (Neon) · `database/schema.sql` (MySQL legacy/local) |
| Docker | `php:8.2-apache` + `pdo_pgsql`/`pdo_mysql`, `$PORT`-ready |
| Blueprint | `render.yaml` — one-click free-tier deploy with health check |
| CI | `ci.yml` — PHP lint + stale-asset guard on every push |
| CD | Render auto-deploys `main` on every push |

</details>

---

## 🛠️ Tech Stack

<div align="center">

![PHP](https://img.shields.io/badge/PHP_8.2-777BB4?style=flat-square&logo=php&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-Neon-4169E1?style=flat-square&logo=postgresql&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-2496ED?style=flat-square&logo=docker&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=flat-square&logo=javascript&logoColor=black)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.0-7952B3?style=flat-square&logo=bootstrap&logoColor=white)
![Render](https://img.shields.io/badge/Render-46E3B7?style=flat-square&logo=render&logoColor=black)
![GitHub Actions](https://img.shields.io/badge/GitHub_Actions-2088FF?style=flat-square&logo=githubactions&logoColor=white)

| Layer | Technology |
|---|---|
| Language | PHP 8.2, `declare(strict_types=1)` throughout |
| Database Access | PDO prepared statements (Postgres + MySQL drivers) |
| Production Database | Neon Postgres (free, persistent) |
| Hosting | Render free web service (Docker · auto-deploy · health checks) |
| Frontend | HTML5 · CSS3 · Vanilla JS (ES6+) · Bootstrap 5.0.2 · Font Awesome 6.2.1 |
| Typography | Google Fonts — Poppins + Inter |
| Static Mirror | GitHub Pages |
| CI | GitHub Actions |

</div>

---

## 🏗️ Architecture

```mermaid
flowchart TB
    subgraph Client["🌐 Client"]
        PAGES["GitHub Pages<br/>(static preview)"]
        RENDER_WWW["Render<br/>(full site)"]
    end
    subgraph Backend["⚙️ PHP 8.2 Backend — Render · Docker"]
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

**Booking flow:**

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

## 🗄️ Database

```mermaid
erDiagram
    users {
        int id PK
        string fullname
        string email UK
        string password_hash "bcrypt-12"
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
        string password_hash "bcrypt-12"
        timestamptz created_at
    }
    users ||--o{ information : books
```

| File | Use |
|---|---|
| [`database/schema-pg.sql`](./database/schema-pg.sql) | Import **once** via Neon SQL Editor (production) |
| [`database/schema.sql`](./database/schema.sql) | MySQL variant (legacy hosts / local XAMPP-style setups) |

**Destinations served:** Sundarbans 🌿 · Srimangal 🍵 · Rangamati 🏞️ · Bandarbans ⛰️ · Saint Martin 🏖️ · Shait-Gumbad 🕌 — from **1,500 ৳**.

---

## 📂 Project Structure

<details>
<summary><b>Click to expand</b></summary>

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
├── database/
│   ├── schema-pg.sql           # Postgres schema (Neon)
│   └── schema.sql              # MySQL schema (legacy/local)
├── Dockerfile                  # php-apache + PDO drivers, $PORT-ready
├── render.yaml                 # Render Blueprint (free tier)
└── .github/workflows/ci.yml    # PHP lint + asset-path guard
```

</details>

---

## 🚀 Getting Started

### Prerequisites

| Tool | Version |
|---|---|
| PHP | 8.2+ with `pdo_pgsql` and/or `pdo_mysql` |
| Database | Neon Postgres (production) · MySQL 5.7+ (local) |
| Docker *(optional)* | For containerized runs |

### ▶️ Local Run

```bash
git clone https://github.com/mahfuj735/TourAndTravelTouch.git
cd TourAndTravelTouch

# ── Option A: Postgres (mirrors production) ──
export DATABASE_URL='postgresql://USER:PASS@HOST/DB?sslmode=require'
php -S localhost:8000

# ── Option B: local MySQL (import database/schema.sql first) ──
export DB_HOST=localhost DB_NAME=tour DB_USER=root DB_PASS=secret
php -S localhost:8000
```

Open 👉 `http://localhost:8000`

### 🐳 Docker Run

```bash
docker build -t tourandtravel .
docker run -p 10000:10000 -e PORT=10000 -e DATABASE_URL='postgresql://...' tourandtravel
```

---

## ☁️ Deployment

Free tier, persistent — sleeps when idle, never deleted.

| # | Step | Where |
|---|---|---|
| 1 | Create project, copy pooled connection string | [neon.tech](https://neon.tech) |
| 2 | Run `database/schema-pg.sql` once | Neon → SQL Editor |
| 3 | New → Blueprint → select this repo | [render.com](https://render.com) |
| 4 | Set `DATABASE_URL`, `FRONTEND_URL`, `ADMIN_USER`, `ADMIN_PASS` | Render → Environment |
| 5 | Deploy — every push to `main` redeploys | Automatic |
| 6 | Verify `…/backend/handlers/health.php` → `{"ok":true,"db":"up"}` | Browser |

> If the Render service URL ever differs from `tourandtraveltouch-backend.onrender.com`,
> update `PROD_BACKEND` in `assets/js/config.js` so the GitHub Pages preview follows it.

---

## ⚙️ Configuration

| File | Variables | Purpose |
|---|---|---|
| `backend/config/database.php` | `DATABASE_URL` *(preferred)* or `DB_HOST`/`DB_PORT`/`DB_NAME`/`DB_USER`/`DB_PASS` | DB connection — **env only**, never commit secrets |
| `backend/config/app.php` | `FRONTEND_URL`, `BACKEND_URL` | CORS origins + post-action redirects |
| `assets/js/config.js` | `PROD_BACKEND` | API base used by the GitHub Pages preview |
| Render → Environment | `DATABASE_URL`, `ADMIN_USER`, `ADMIN_PASS` | Production secrets |

---

## 🔌 API Reference

Forms fetch a CSRF token from `csrf-token.php` automatically — no manual wiring needed.

| Endpoint | Method | Auth | Description |
|---|---|---|---|
| `/backend/handlers/register.php` | POST | — | Create account — `fullname`, `email`, `password` (≥ 8 chars) |
| `/backend/handlers/login.php` | POST | — | Session login — `email`, `password` |
| `/backend/handlers/logout.php` | GET/POST | User | Destroy session |
| `/backend/handlers/booking.php` | POST | User | Create booking — `whereto`, `howmany`, `arrival`, `leaving`, `notes?` |
| `/backend/handlers/search.php` | POST | — | Search bookings — `search` → results page |
| `/backend/handlers/auth-status.php` | GET | — | `{loggedIn, user?}` JSON for the frontend |
| `/backend/handlers/csrf-token.php` | GET | — | `{token}` JSON |
| `/backend/handlers/flash.php` | GET | — | Pending flash message JSON (consumed once) |
| `/backend/handlers/health.php` | GET | — | `{ok, db, driver, time}` JSON |

---

## 🔐 Admin Panel

<div align="center">

| Item | Value |
|---|---|
| 🌐 Live URL | [Admin Login](https://tourandtraveltouch-backend.onrender.com/backend/admin/login.php) |
| 📁 Local URL | `/backend/admin/login.php` |
| 👤 Credentials | `admin` / `admin123` — or `ADMIN_USER` / `ADMIN_PASS` env |
| 📊 Sees | Booking + user tables with totals dashboard |
| 🌱 Seeding | Admin row auto-created on first login |

> ⚠️ **Change the default password immediately after first login.**

</div>

---

## 🛡️ Security

| Threat | Mitigation |
|---|---|
| SQL injection | 100% PDO prepared statements — zero interpolated SQL |
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
| Animations | GPU-friendly `transform`/`opacity` only · `requestAnimationFrame` loops |
| Images | Preloaded slideshow · long-lived cache headers via `.htaccess` |
| Queries | Indexed lookups · `LIMIT 100` on search |
| Cold starts | ~30 s first hit after free-tier sleep · warm afterwards |

---

## 🔄 CI/CD

```mermaid
gitGraph
    commit id: "push to main"
    commit id: "CI: php -l + asset guard"
    commit id: "Render: build Docker image"
    commit id: "Render: live + health check"
```

- **CI** ([`ci.yml`](./.github/workflows/ci.yml)) — PHP syntax check + stale-asset guard on every push/PR.
- **CD** — Render Blueprint auto-deploys `main`; `health.php` is the configured health-check path.

---

## 🗺️ Roadmap

- [ ] Pagination + filters on the admin dashboard
- [ ] Booking status workflow (pending → confirmed)
- [ ] Email notifications on new bookings
- [ ] Rate limiting on auth endpoints
- [ ] Playwright smoke tests in CI

---

## ❓ FAQ

**Q: First visit is slow — is the site broken?**
A: No. Render free sleeps after ~15 min idle; the first request wakes it (~30 s), then it's fast.

**Q: GitHub Pages preview vs Render site — which is real?**
A: Render serves the full stack (frontend + backend + DB). GitHub Pages is a static mirror whose API calls point at Render.

**Q: I forgot the admin password — how to reset?**
A: Set `ADMIN_USER`/`ADMIN_PASS` in Render → Environment. (The auto-seed only runs when the `admins` table is empty; otherwise update the row in Neon.)

**Q: Can I use MySQL instead of Neon?**
A: Yes — set the `DB_*` env vars (or local creds) and import `database/schema.sql`. The PDO layer picks MySQL when `DATABASE_URL` is absent.

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

Released under the **MIT License** — see [LICENSE](./LICENSE) for the full text.

---

<div align="center">

**Built with 💙 — PHP · Postgres · Vanilla JS**

*Full-stack. Free-hosted. Never deleted.*

✍️ [Mahfujul Karim](https://github.com/mahfuj735) ·
🌍 [Live Website](https://tourandtraveltouch-backend.onrender.com) ·
🖼️ [Static Preview](https://mahfuj735.github.io/TourAndTravelTouch/) ·
🔐 [Admin](https://tourandtraveltouch-backend.onrender.com/backend/admin/login.php)

[⬆ Back to top](#top)

</div>
