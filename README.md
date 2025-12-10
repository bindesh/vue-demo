# Company Admin Demo

Demo application showing a company list and company detail page built with Laravel + Inertia + Vue 3 (Vite).

## Tech stack
- Laravel 12.0 (requires PHP >= 8.2)
- PHP >= 8.2
- Composer
- MySQL (or compatible)
- Node.js (recommended LTS) and npm
- Vite + Vue 3 + Inertia.js

## Prerequisites
- PHP 8.2 or greater
- Composer
- Node.js (LTS) and npm
- MySQL (or other supported DB)
- Git

## Quick setup (Windows / PowerShell)
1. Clone repo and change into project:
   - git clone <repo-url>
   - cd company-admin-demo

2. Install PHP dependencies:
   - composer install

3. Copy env and set DB credentials:
   - copy .env.example .env
   - edit .env (DB_CONNECTION, DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD)

4. Generate app key:
   - php artisan key:generate

5. Install JS deps (use legacy peer deps to avoid ERESOLVE issues):
   - npm install --legacy-peer-deps

6. Run migrations and seeders:
   - php artisan migrate
   - php artisan db:seed

7. Run Vite (dev assets / HMR):
   - npm run dev

8. Serve the app:
   - php artisan serve

9. Example URLs
   - http://127.0.0.1:8000
   - Admin companies: http://127.0.0.1:8000/admin/companies

## Notes & recommendations
- Laravel 12.0 requires PHP 8.2+. Ensure your PHP CLI and webserver use 8.2+.
- CompanyService currently returns Resources; prefer returning models/paginators and resolve resources in controllers.
- Use pagination and eager loading for large datasets.
- If npm peer-dependency errors persist, try `npm install --legacy-peer-deps` or use Yarn/pnpm.

## Useful commands
- Start dev server: php artisan serve
- Start Vite: npm run dev
- Build assets: npm run build
- Refresh DB & seed: php artisan migrate:fresh --seed