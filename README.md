# Filipina Fiancee Visa Platform

A production-ready immigration support platform for a U.S. visa consultancy, handling K-1, CR-1/IR-1, and Adjustment of Status applications end-to-end. Built as a freelance project and included here as a **portfolio sample** to demonstrate real-world Laravel/PHP engineering in a collaborative team environment.

---

## Highlights for Reviewers

This project was developed iteratively with multiple contributors over an extended period, making it a representative sample of professional team development practices:

- **Laravel 8 + PHP 8** — full MVC application with service layer, observers, policies, and custom middleware
- **OOP design** — business logic extracted into dedicated Service classes, Helpers, and Observer-based event handling
- **Team Git workflow** — feature branches, merge requests, and conflict resolution across multiple contributors (see git history)
- **MySQL** — 60+ migrations covering complex relational data (users, multi-type visa applications, documents, payments, messaging)

---

## Tech Stack

| Layer          | Technology                                            |
| -------------- | ----------------------------------------------------- |
| Backend        | Laravel 8, PHP 8.0+                                   |
| Frontend       | Blade templates, Vue.js 2, Bootstrap 5, Laravel Mix   |
| Database       | MySQL (AWS RDS)                                       |
| Payments       | Stripe API                                            |
| PDF            | FPDF, FPDI, TCPDF                                     |
| Auth           | Laravel Sanctum                                       |
| Storage        | AWS S3                                                |
| Infrastructure | AWS EC2                                               |
| Testing        | PHPUnit, Mockery, Faker                               |

---

## Core Features

### Visa Application Packages

- **K-1 Fiancee Visa** — multi-step form capturing sponsor and beneficiary (alien) information across several sequential steps
- **CR-1 / IR-1 Spouse Visa** — simplified consolidated application flow
- **Adjustment of Status (I-485)** — standalone and combined with CR-1 pathway
- Additional services: Removal of Conditions, IR-5 Parent Visa, Petition for Child, Naturalization

### Application Workflow

- Multi-step form system with persistent draft state
- Document upload and verification (DropBox system with category/type metadata)
- Application status tracking: `draft → ready_for_review → approved / needs_revision`
- Real-time messaging between applicants and admin staff
- PDF generation and merging for completed application packets

### Admin Dashboard

- User and application management
- USCIS form change monitoring and medical fee tracking
- Immigration news aggregation
- Document review and status updates

### Other

- Stripe payment integration (customer management, payment status tracking)
- Multi-language / locale switching support
- CAPTCHA-protected contact forms
- Audit log for application state changes

---

## Architecture & OOP Patterns

The codebase follows Laravel conventions with an additional service layer to keep controllers thin:

```text
app/
├── Http/
│   ├── Controllers/          # 61 controllers, organized by visa type and Admin namespace
│   │   ├── FianceVisa/
│   │   ├── SpouseVisa/
│   │   ├── AdjustmentOfStatus/
│   │   └── Admin/
│   ├── Middleware/           # Custom auth and application-context middleware
│   └── Requests/             # Form request validation
├── Models/                   # 43 Eloquent models with relationships
├── Services/                 # Business logic layer
│   ├── ApplicationDataService.php
│   ├── PdfMergeService.php
│   └── K1FormReviewService.php
├── Observers/                # Model event handling (audit logging, side-effects)
├── Policies/                 # Authorization policies (user/admin role separation)
└── Helpers/                  # Utility classes (PaymentHelper, PdfControlHelper)
```

Key OOP patterns in use:

- **Service Layer** — complex operations (PDF merging, data aggregation) live in dedicated service classes injected into controllers
- **Observers** — model lifecycle hooks for audit logging and monitoring
- **Policies** — resource-level authorization separate from controller logic
- **Form Requests** — validation extracted from controllers into typed request classes

---

## Database Design

60+ migrations with a well-normalized schema:

### Users & Auth

- `users`, `admins`, `password_resets`, `personal_access_tokens`

### Applications

- `user_submitted_applications` — master record per user per visa type
- `fiance_visa_steps`, `spouse_visa_steps`, `adjustment_visa_steps` — step-by-step form data
- `simplified_spouse_visa_applications`, `simplified_aos_applications` — newer consolidated flows
- `combined_cr1_aos_steps`

### Application Details

- `fiance_sponsors`, `fiance_aliens`, `fiance_alien_childrens`
- `spouse_sponsors`, `spouse_beneficiaries`
- `adjustment_services`, `adjustment_steps`, `adjustment_types`

### Documents & Files

- `drop_boxes`, `document_categories`, `document_types`, `application_documents`

### Reference & Communication

- `countries`, `states`, `embassy_cities`
- `messages`, `contact_us`, `news_letters`
- `monitoring_changes`, `application_status_tracking`, `application_audit_logs`

Key relationships:

```text
User → UserSubmittedApplications → ApplicationDocuments
User → DropBox (uploaded files, categorized and verified)
User ↔ Admin (Messages with unread tracking)
UserSubmittedApplication → status lifecycle (draft, ready_for_review, approved, needs_revision)
```

---

## Team Git Workflow

This project was built collaboratively. The workflow used throughout:

- **Feature branches** per task/feature (`feat/visa-packages`, `feat/simplified-spouse`, etc.)
- **Merge Requests / Pull Requests** for code review before merging to `main`
- Conflict resolution managed through standard Git tooling
- Descriptive commit history reflecting iterative delivery

---

## Local Setup

```bash
git clone <repo-url>
cd filipina-fiancee-visa

cp .env.example .env
# fill in DB credentials, Stripe keys, AWS keys

composer install
npm install

php artisan key:generate
php artisan migrate
php artisan db:seed   # optional

npm run dev
php artisan serve
```

Requirements: PHP 8.0+, Composer, Node.js, MySQL

---

## Testing

```bash
php artisan test
```

Uses PHPUnit 9 with Mockery for mocking and Faker for test data. Test suites are split into `Unit` and `Feature`.

---

## Developer

**Gedion Daniel** — Laravel / PHP backend developer

Portfolio project — developed as a freelance engagement to demonstrate production-grade Laravel development in a team context.
