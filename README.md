# DonorConnect Backend — Laravel API + Filament Admin

This repository contains the backend implementation for the **DonorConnect Android App** — a platform that connects donors and beneficiaries to exchange donation items. The backend is built using Laravel with secure REST APIs and includes an admin dashboard built with Filament for system management.

---

## 🧰 Tech Stack

- **Framework:** Laravel (MVC Architecture)
- **Admin Panel:** Filament Admin
- **Authentication & Security:** Laravel Sanctum (Token-based API auth)
- **Database:** SQLite (lightweight & serverless)
- **Cloud & External Services:** Google Cloud, Firebase
- **HTTP Client:** Guzzle

---

## 🔧 Core Capabilities

- **RESTful API Endpoints** for Android client communication
- **Secure Authentication** with Sanctum tokens
- **Donation Item Management** (create, list, validate)
- **Filament-based Admin Dashboard** for monitoring and moderation
- **Cloud Integration** for future scalability (Google Storage / Firebase)

---

## 🚀 Installation & Setup

### Requirements

- PHP 8.1+
- Composer
- PHP extension for SQLite (enabled by default)
- Git (optional but recommended)

### Steps

```bash
# Clone the repository
git clone <repo-url>
cd donorconnect-backend

# Install dependencies
composer install

# Create environment file
cp .env.example .env

# Generate app key
php artisan key:generate

# Run migrations
php artisan migrate

# Serve the application
php artisan serve
