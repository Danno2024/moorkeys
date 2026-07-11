# MoorKeys — License Key Management Platform

## Comprehensive Documentation

**Version 1.0** | **Last Updated: July 2026**

---

## Table of Contents

1. [Introduction](#1-introduction)
2. [System Requirements](#2-system-requirements)
3. [Installation Guide](#3-installation-guide)
4. [Getting Started](#4-getting-started)
5. [Admin Dashboard](#5-admin-dashboard)
6. [Client Portal](#6-client-portal)
7. [License Key Management](#7-license-key-management)
8. [Subscription & Billing](#8-subscription--billing)
9. [Email & Invoice Templates](#9-email--invoice-templates)
10. [Content Management](#10-content-management)
11. [Settings & Configuration](#11-settings--configuration)
12. [API Reference](#12-api-reference)
13. [Reinstall / Reset System](#13-reinstall--reset-system)
14. [Troubleshooting](#14-troubleshooting)
15. [Appendix](#15-appendix)

---

## 1. Introduction

### 1.1 What is MoorKeys?

MoorKeys is a **complete License Key Management Platform** built on Laravel 12. It enables software vendors to:

- **Generate and manage activation keys** for desktop, web, mobile, and API products
- **Sell subscriptions** with Stripe integration
- **Validate licenses** via a secure REST API
- **Manage customers** (clients) and their activations
- **Automate email communications** with customizable templates
- **Handle billing** with Stripe Checkout and Customer Portal
- **Maintain a public website** with CMS pages

### 1.2 Key Features

| Feature | Description |
|---------|-------------|
| **Multi-tenant Architecture** | Super admins manage the platform; clients manage their own keys |
| **Activation Keys** | Generate, validate, revoke, and track activations with domain locking |
| **Subscription Plans** | Free, monthly, yearly with feature limits and Stripe integration |
| **License Validation API** | Secure HMAC-signed endpoints for software validation |
| **Stripe Billing** | Checkout sessions, customer portal, webhook handling |
| **Email Templates** | 10 pre-built templates with variable substitution |
| **Invoice Templates** | Customizable invoice generation |
| **CMS Pages** | Public pages with header/footer placement |
| **2FA Support** | Google Authenticator compatible |
| **Maintenance Mode** | With secret bypass for admins |
| **Web-based Installer** | 6-step guided installation |

### 1.3 User Roles

| Role | Description |
|------|-------------|
| **Super Admin** | Full platform control: users, settings, templates, reinstall |
| **Client** | Software vendor: manages their keys, plans, profile |
| **End User** | Customer of client: views their licenses via portal |

---

## 2. System Requirements

### 2.1 Server Requirements

| Requirement | Minimum Version |
|-------------|-----------------|
| **PHP** | 8.1+ |
| **MySQL / MariaDB** | 5.7+ / 10.3+ |
| **Composer** | 2.0+ |
| **Node.js / NPM** | 18+ / 9+ (for asset building) |

### 2.2 Required PHP Extensions

```bash
pdo, pdo_mysql, openssl, mbstring, tokenizer, xml, ctype, json, bcmath, fileinfo
```

### 2.3 Directory Permissions

The following directories must be writable by the web server:

```
storage/
storage/framework/cache/
storage/framework/views/
storage/framework/sessions/
bootstrap/cache/
```

### 2.4 Recommended Stack

- **Web Server**: Nginx or Apache
- **Process Manager**: PHP-FPM
- **SSL**: Let's Encrypt or valid certificate
- **Queue Worker**: For async email sending (optional but recommended)

---

## 3. Installation Guide

### 3.1 Quick Start (Automated)

```bash
# 1. Clone repository
git clone https://github.com/Danno2024/moorkeys.git
cd moorkeys

# 2. Run setup script
composer install
cp .env.example .env
php artisan key:generate

# 3. Configure .env
# Edit database credentials, APP_URL, etc.

# 4. Build assets
npm install && npm run build

# 5. Run installer via web
# Visit: https://your-domain.com/install
```

### 3.2 Web-Based Installer (Recommended)

The installer provides a **6-step guided setup**:

#### Step 1: Welcome
- Overview of requirements
- Links to documentation

#### Step 2: Requirements Check
Automatically verifies:
- PHP version ≥ 8.1
- Required extensions loaded
- Writable directories
- Database connectivity

> **Screenshot: Requirements Check Page**
> [A page showing green checkmarks for each requirement: PHP version, PDO, OpenSSL, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath, Fileinfo, Storage writable, Cache writable, .env writable. All green = ready to continue.]

#### Step 3: Database Configuration
Enter database credentials:
- Host (default: 127.0.0.1)
- Port (default: 3306)
- Database name
- Username
- Password

Click **"Test Connection & Continue"** — validates credentials before proceeding.

> **Screenshot: Database Configuration**
> [Form with fields for host, port, database, username, password. "Test Connection" button. Success message appears on valid credentials.]

#### Step 4: Admin Account
Create your super administrator:
- Full name
- Email address
- Password (min 8 characters)
- Confirm password

#### Step 5: Seed Options
Choose initialization mode:

| Option | Description |
|--------|-------------|
| **Start Empty** | Admin user only + 10 email templates |
| **Install Demo Data** | Admin + 3 plans (Free/Pro/Enterprise), sample keys, pages, templates, settings |

> **Screenshot: Seed Options**
> [Two cards side by side: "Start Empty" (gray icon) and "Install Demo Data" (indigo icon with description). Radio buttons with visual selection state.]

#### Step 6: Complete
Shows success message with next steps:
- Login link
- Configure SMTP
- Create plans
- Customize templates

### 3.3 Post-Installation

1. **Configure SMTP** in Admin → Settings → Mail Settings
2. **Set Stripe keys** in `.env` for billing
3. **Create your first plan** in Admin → Plans
4. **Customize email templates** in Admin → Email Templates

### 3.4 Manual Installation (Alternative)

```bash
# Run migrations
php artisan migrate --force

# Seed database (choose one)
php artisan db:seed --class=AdminUserSeeder        # Empty
php artisan db:seed                                # Full demo

# Create storage link
php artisan storage:link

# Clear caches
php artisan optimize:clear
```

---

## 4. Getting Started

### 4.1 First Login

1. Visit `https://your-domain.com/login`
2. Use admin credentials from installation
3. Complete 2FA setup (optional but recommended)

### 4.2 Admin Dashboard Overview

The dashboard shows key metrics at a glance:

| Metric | Description |
|--------|-------------|
| **Total Users** | All registered users (admins + clients) |
| **Total Keys** | All activation keys in system |
| **Active Keys** | Currently active licenses |
| **Total Revenue** | Stripe-based revenue tracking |
| **Active Subscriptions** | Current paying subscribers |

> **Screenshot: Admin Dashboard**
> [Clean dashboard with stat cards in a grid: Total Users (blue), Total Keys (green), Active Keys (green), Revenue (purple), Subscriptions (orange). Quick action buttons: Create Plan, Create Key, View Users.]

### 4.3 Navigation

| Section | Access | Description |
|---------|--------|-------------|
| **Dashboard** | `/admin/dashboard` | Overview metrics |
| **Users** | `/admin/users` | Manage all users |
| **Plans** | `/admin/plans` | Subscription plans |
| **Keys** | `/admin/keys` | All activation keys |
| **Pages** | `/admin/pages` | CMS pages |
| **Email Templates** | `/admin/email-templates` | Transactional emails |
| **Invoice Templates** | `/admin/invoice-templates` | Invoices |
| **Settings** | `/admin/settings` | Global configuration |

---

## 5. Admin Dashboard

### 5.1 User Management

**Route**: `/admin/users`

- **Create users** with role: `super_admin` or `client`
- **Edit** user details, toggle active status
- **Generate API tokens** for clients
- **2FA status** visible per user
- **Pagination** and search

> **Screenshot: Users Index**
> [Table with columns: Name, Email, Role (badge: Super Admin/Client), Status (Active/Inactive badge), 2FA (Yes/No), API Token (Show/Generate), Actions (Edit). Pagination at bottom.]

### 5.2 Plan Management

**Route**: `/admin/plans`

- **Create plans** with:
  - Name, slug, description
  - Price (0 = free)
  - Billing period: monthly/yearly
  - Max keys (0 = unlimited)
  - **Stripe Price ID** for billing integration
  - Features (ordered list with icons)
  - Sort order

- **Features** managed inline (add/remove rows)

> **Screenshot: Plan Form**
> [Form with fields: Name, Slug, Description, Price, Billing Period, Max Keys, Stripe Price ID, Is Active, Sort Order. Below: Features section with "Add Feature" button. Each feature row: Name, Description, Icon, Sort Order, Remove button.]

### 5.3 Activation Keys (Admin View)

**Route**: `/admin/keys`

- **Bulk create** multiple keys at once
- **Filter** by status, product type, search
- **View/Edit** any key in system
- **Columns**: Key, Owner, Client, End User, Type, Status, Expires, Actions

> **Screenshot: Admin Keys Index**
> [Table with key codes (monospace), Owner (admin user), Client name, End User (claimed by), Type badge, Status badge (green/red/gray/yellow), Expiry date, View/Edit links. Search and filter bar at top.]

### 5.4 Email Templates

**Route**: `/admin/email-templates`

**10 Pre-built Templates Included**:

| Key | Name | Use Case |
|-----|------|----------|
| `welcome` | Welcome Email | New user registration |
| `license_activated` | License Activated | Confirmation email |
| `license_expired` | License Expired | Expiration notice |
| `license_expiring_soon` | Expiring Soon | Renewal reminder (days_left) |
| `license_renewed` | License Renewed | Renewal confirmation |
| `activation_limit_reached` | Limit Reached | Max activations warning |
| `password_reset` | Password Reset | Account recovery |
| `invoice_created` | Invoice Created | New invoice notification |
| `subscription_cancelled` | Cancelled | Subscription ended |
| `password_reset` | Password Reset | Account recovery |

**Template Features**:
- **Variables sidebar** with 20+ documented variables
- **Live preview** in modal
- **Blade-style syntax**: `@{{variable_name}}`
- **Responsive HTML** with inline CSS

> **Screenshot: Email Template Editor**
> [Split view: Left 75% - form fields (Key, Name, Subject, Variables, Active checkbox, Body textarea). Right 25% sticky sidebar: "Available Variables" with cards showing @{{variable}} and description. Preview button opens modal.]

### 5.5 Invoice Templates

**Route**: `/admin/invoice-templates`

Similar to email templates but for PDF/invoice generation. Includes:
- Company details
- Line items table
- Totals calculation
- Terms & conditions

### 5.6 CMS Pages

**Route**: `/admin/pages`

- **Create pages** with slug, title, content (HTML)
- **Placement**: None / Header / Footer
- **Sort order** for navigation
- **SEO fields**: meta title, description
- **Published status** with date

> **Screenshot: Page Form**
> [Form with Title, Slug (auto-generated), Content (WYSIWYG/textarea), Placement dropdown (None/Header/Footer), Sort Order, Meta Title, Meta Description, Published checkbox, Published At date picker.]

---

## 6. Client Portal

### 6.1 Client Dashboard

**Route**: `/client/dashboard`

Clients (software vendors) see:

| Widget | Description |
|--------|-------------|
| **Total Keys** | All keys created |
| **Active Keys** | Currently valid |
| **Subscription** | Current plan + renewal date |
| **Billing Portal Link** | Manage Stripe subscription |

> **Screenshot: Client Dashboard**
> [Clean cards layout: Total Keys (blue), Active Keys (green), Subscription (purple with plan name + renewal date + "Manage Billing" link), Recent Keys table with 5 latest keys.]

### 6.2 Key Management (Client)

**Route**: `/client/keys`

- **Create keys** (subject to plan limits)
- **View/Edit/Revoke** own keys
- **Set domain locking**
- **Set expiry dates**
- **Track activations**

> **Screenshot: Client Keys Index**
> [Table: Key code, Client name, Type, Domain, Status badge, Expiry, Actions (View, Edit, Revoke). Create Key button top right.]

### 6.3 Profile & Billing

**Route**: `/client/profile`

- **Profile info**: Name, email, company, website
- **API Token** management (generate/revoke)
- **Password change**
- **2FA setup**

**Route**: `/billing/portal`

Redirects to Stripe Customer Portal for:
- Update payment method
- View invoices
- Cancel subscription
- Change plan

---

## 7. License Key Management

### 7.1 Key Lifecycle

```
CREATE → ACTIVATE → VALIDATE (periodic) → EXPIRE / REVOKE / RENEW
```

### 7.2 Key Properties

| Property | Description |
|----------|-------------|
| **Key** | Unique 25-char code (e.g., `MK-ABCD-EFGH-IJKL-MNOP`) |
| **Owner** | Client user who created it |
| **End User** | Customer who claimed it (optional) |
| **Product Type** | web / desktop / mobile / api / other |
| **Domain** | Optional domain lock |
| **Status** | active / expired / revoked / suspended |
| **Activated At** | First validation timestamp |
| **Expires At** | Expiration date (null = never) |
| **Activations Used** | Count of unique activations |

### 7.3 Bulk Operations

**Admin** → Keys → "Bulk Create":
- Select client, plan, quantity (1-100)
- Product type, expiry date
- Generates sequential keys instantly

### 7.4 API Validation Endpoint

**POST** `/api/v1/validate`

```json
{
  "key": "MK-ABCD-EFGH-IJKL-MNOP",
  "domain": "example.com",
  "metadata": { "version": "1.2.3" }
}
```

**Response**:
```json
{
  "valid": true,
  "key": "MK-ABCD-EFGH-IJKL-MNOP",
  "product": "Professional",
  "expires_at": "2026-12-31T23:59:59Z",
  "activations_remaining": 3
}
```

**Authentication**: Bearer token (client API token from profile)

---

## 8. Subscription & Billing

### 8.1 Stripe Integration

**Required .env keys**:
```env
STRIPE_KEY=pk_test_xxx
STRIPE_SECRET=sk_test_xxx
STRIPE_WEBHOOK_SECRET=whsec_xxx
```

### 8.2 Webhook Endpoint

Configure in Stripe Dashboard:
```
URL: https://your-domain.com/stripe/webhook
Events:
- checkout.session.completed
- customer.subscription.updated
- customer.subscription.deleted
- invoice.paid
- invoice.payment_failed
```

### 8.3 Checkout Flow

1. **User clicks plan** on pricing page
2. **Free plan** → Redirect to register
3. **Paid plan** → 
   - Authenticated → Stripe Checkout Session
   - Guest → Redirect to register → Checkout
4. **Webhook** creates/updates subscription
5. **Success** → Redirect to billing portal

### 8.4 Billing Portal

Route: `/billing/portal`

Features:
- Update payment method
- View/download invoices
- Change plan (upgrade/downgrade)
- Cancel subscription
- View billing history

---

## 9. Email & Invoice Templates

### 9.1 Variable Syntax

Use **Blade-style** in templates:
```html
<p>Hello @{{name}},</p>
<p>Your license @{{license_key}} expires @{{expires_at}}.</p>
```

### 9.2 Available Variables

| Category | Variables |
|----------|-----------|
| **User** | `name`, `email`, `app_name`, `login_url`, `dashboard_url` |
| **License** | `license_key`, `product_name`, `activated_at`, `expires_at`, `activations_used`, `max_activations`, `days_left`, `renewal_url` |
| **Invoice** | `invoice_number`, `invoice_date`, `due_date`, `amount`, `status`, `invoice_url` |
| **Subscription** | `plan_name`, `cancelled_at`, `access_until`, `resubscribe_url`, `feedback_url` |
| **Security** | `reset_url`, `expires_in` |

### 9.3 Preview

Click **"Preview"** on any template to see rendered output with sample data.

---

## 10. Content Management

### 10.1 Public Pages

Pages are accessible at `/p/{slug}`

### 10.2 Header/Footer Navigation

Pages with placement:
- **Header** → Appear in top navigation
- **Footer** → Appear in footer links
- **None** → Accessible via direct URL only

### 10.3 SEO

Each page has:
- Meta title
- Meta description
- Auto-generated Open Graph tags

---

## 11. Settings & Configuration

### 11.1 General Settings

**Route**: `/admin/settings`

| Setting | Description |
|---------|-------------|
| Site Name | Displayed in templates, title tags |
| Site Description | Meta description, SEO |
| Site Keywords | SEO meta keywords |
| Contact Email | Used in templates, contact forms |
| Footer Text | Global footer |
| Google Analytics ID | GA4 measurement ID |

### 11.2 Logo & Branding

- **Text Logo**: Uses site name
- **Image Logo**: Upload PNG/SVG/JPG/WebP (max 1MB, recommended 200×50px)

### 11.3 SMTP / Mail Settings

| Field | Example |
|-------|---------|
| Driver | smtp / sendmail / log |
| Host | smtp.mailgun.org |
| Port | 587 |
| Encryption | tls / ssl / none |
| Username | postmaster@domain.com |
| Password | •••••••• |
| From Address | noreply@domain.com |
| From Name | MoorKeys |

> **Screenshot: Mail Settings**
> [Form with Driver dropdown, Host, Port, Encryption dropdown, Username, Password (hidden), From Address, From Name. Test email button at bottom.]

### 11.4 Maintenance Mode

**Route**: `/admin/settings/maintenance`

- **Enable/Disable** toggle
- **Secret URL** for admin bypass (e.g., `/maintenance?secret=abc123`)
- **Custom message** shown to visitors

> **Screenshot: Maintenance Mode**
> [Toggle switch, Secret input field, Message textarea with preview. When enabled, shows branded 503 page to non-admin users.]

### 11.5 Reinstall System

**Route**: `/admin/settings/reinstall`

> ⚠️ **DESTRUCTIVE ACTION**

> **Screenshot: Reinstall Page**
> [Red warning banner. List of 4 items to be deleted (all tables, all users/keys/plans, templates/pages/settings, redirect to installer). Yellow advisory box. Checkbox: "I understand this will PERMANENTLY DELETE all data". Red "Reinstall System Now" button (disabled until checkbox checked). JavaScript confirmation on click.]

---

## 12. API Reference

### 12.1 Authentication

All endpoints require **Bearer token**:

```bash
Authorization: Bearer YOUR_API_TOKEN
```

Get token from: Client Portal → Profile → API Token

### 12.2 Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/v1/validate` | Validate license key |
| POST | `/api/v1/activate` | Activate license |
| POST | `/api/v1/deactivate` | Deactivate license |
| GET | `/api/v1/key/{key}` | Get key info |

### 12.3 Validate License

**Request**:
```bash
POST /api/v1/validate
Authorization: Bearer {token}
Content-Type: application/json

{
  "key": "MK-ABCD-EFGH-IJKL-MNOP",
  "domain": "example.com",
  "metadata": { "version": "1.2.3" }
}
```

**Success Response** (200):
```json
{
  "valid": true,
  "key": "MK-ABCD-EFGH-IJKL-MNOP",
  "product": "Professional",
  "status": "active",
  "expires_at": "2026-12-31T23:59:59Z",
  "activations_used": 2,
  "max_activations": 5,
  "activations_remaining": 3
}
```

**Error Response** (422):
```json
{
  "valid": false,
  "error": "License key has expired",
  "error_code": "EXPIRED"
}
```

### 12.4 Error Codes

| Code | Description |
|------|-------------|
| `INVALID_KEY` | Key not found |
| `EXPIRED` | License expired |
| `REVOKED` | License revoked |
| `SUSPENDED` | License suspended |
| `DOMAIN_MISMATCH` | Domain not authorized |
| `ACTIVATION_LIMIT` | Max activations reached |
| `UNAUTHORIZED` | Invalid API token |

---

## 13. Reinstall / Reset System

### 13.1 When to Reinstall

- Corrupted installation
- Need completely fresh start
- Moving to new server
- Testing/development

### 13.2 Process

1. **Login as Super Admin**
2. Navigate to **Admin → Settings**
3. Click **"Reinstall System"** (under Maintenance Mode)
4. **Read warnings** carefully
5. **Check the box**: "I understand this will PERMANENTLY DELETE all data"
6. Click **"Reinstall System Now"**
7. **Confirm** in JavaScript dialog
8. System drops all tables, clears caches, removes install marker
9. **Redirected to `/install`** for fresh setup

### 13.3 What Gets Deleted

- ✅ All database tables (users, keys, plans, settings, templates, pages, etc.)
- ✅ `storage/installed` marker file
- ✅ All caches (config, route, view, application)
- ✅ Session data

### 13.4 After Reinstall

- Redirected to `/install`
- Follow 6-step installer again
- Choose "Start Empty" or "Install Demo Data"

---

## 14. Troubleshooting

### 14.1 Common Issues

| Issue | Solution |
|-------|----------|
| **Installer shows "Already Installed"** | Delete `storage/installed` file |
| **Database connection fails** | Check `.env` credentials, MySQL running, user permissions |
| **Assets not loading** | Run `npm run build`, check `APP_URL` in `.env` |
| **Email not sending** | Configure SMTP in Settings, test with "log" driver first |
| **Stripe webhook fails** | Check `STRIPE_WEBHOOK_SECRET`, verify endpoint URL, check logs |
| **2FA not working** | Sync server time (NTP), check `APP_TIMEZONE` |
| **Permission denied** | Ensure `storage/` and `bootstrap/cache/` writable |

### 14.2 Debug Mode

Enable in `.env`:
```env
APP_DEBUG=true
LOG_LEVEL=debug
```

Check logs:
```bash
tail -f storage/logs/laravel.log
```

### 14.3 Clear All Caches

```bash
php artisan optimize:clear
# Or individually:
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

---

## 15. Appendix

### 15.1 Directory Structure

```
moorkeys/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/           # Admin controllers
│   │   ├── Client/          # Client portal controllers
│   │   ├── Install/         # Installer controllers
│   │   └── Auth/            # Authentication
│   ├── Models/              # Eloquent models
│   ├── Http/Middleware/     # Custom middleware
│   └── Services/            # Business logic
├── database/
│   ├── migrations/          # Schema definitions
│   └── seeders/             # Demo data seeders
├── resources/
│   ├── views/
│   │   ├── admin/           # Admin panel views
│   │   ├── client/          # Client portal views
│   │   ├── install/         # Installer views
│   │   ├── components/      # Reusable components
│   │   └── layouts/         # Base layouts
│   ├── css/                 # Source styles
│   └── js/                  # Source scripts
├── routes/
│   ├── web.php              # Web routes
│   ├── api.php              # API routes
│   └── auth.php             # Auth routes
├── public/                  # Public assets
├── storage/                 # Logs, cache, uploads
└── tests/                   # Test suite
```

### 15.2 Key Models

| Model | Table | Key Relationships |
|-------|-------|-------------------|
| `User` | `users` | `hasMany(ActivationKey)`, `hasOne(Profile)`, `hasMany(Subscription)` |
| `ActivationKey` | `activation_keys` | `belongsTo(User)` [owner], `belongsTo(User)` [client], `belongsTo(Plan)`, `hasMany(KeyEvent)` |
| `Plan` | `plans` | `hasMany(PlanFeature)`, `hasMany(Subscription)`, `hasMany(ActivationKey)` |
| `Subscription` | `subscriptions` | `belongsTo(User)`, `belongsTo(Plan)` |
| `EmailTemplate` | `email_templates` | — |
| `InvoiceTemplate` | `invoice_templates` | — |
| `Page` | `pages` | — |
| `Setting` | `settings` | — (key-value store) |

### 15.3 Environment Variables Reference

```env
# Application
APP_NAME=MoorKeys
APP_ENV=production
APP_KEY=base64:xxx
APP_DEBUG=false
APP_URL=https://your-domain.com
APP_TIMEZONE=UTC

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=moorkeys
DB_USERNAME=root
DB_PASSWORD=

# Session
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_USERNAME=postmaster@domain.com
MAIL_PASSWORD=xxx
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@domain.com
MAIL_FROM_NAME="${APP_NAME}"

# Stripe
STRIPE_KEY=pk_live_xxx
STRIPE_SECRET=sk_live_xxx
STRIPE_WEBHOOK_SECRET=whsec_xxx

# Cache/Queue
CACHE_STORE=database
QUEUE_CONNECTION=database
BROADCAST_CONNECTION=log

# Filesystem
FILESYSTEM_DISK=local
```

### 15.4 Useful Artisan Commands

```bash
# Installation
php artisan migrate --force
php artisan db:seed                    # Full demo
php artisan db:seed --class=AdminUserSeeder  # Empty

# Maintenance
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Storage
php artisan storage:link

# Queue
php artisan queue:work
php artisan queue:failed
php artisan queue:retry all

# Testing
php artisan test
```

---

## Support & Resources

- **GitHub**: https://github.com/Danno2024/moorkeys
- **Issues**: https://github.com/Danno2024/moorkeys/issues
- **License**: MIT

---

*Document generated for MoorKeys v1.0 | July 2026*