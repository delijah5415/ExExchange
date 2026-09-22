# CryptoExchange

Production-oriented Laravel 11 cryptocurrency exchange application using Supabase PostgreSQL and Supabase Auth.

## Included
- Server-side live quote calculation
- Time-limited quotes
- Exchange order creation and lifecycle events
- Supabase Auth integration through Laravel
- Supabase PostgreSQL-ready schema
- Asset/network/pair data model
- Customer account and order history
- Rate limiting and CSRF protection
- Vercel deployment configuration
- Production environment template

## Important production boundary
This repository does **not** pretend to provide custody, blockchain settlement, fiat payment processing, or real-money payout merely because an order can be created. Those capabilities require verified provider credentials, wallet/node infrastructure, webhook verification, compliance controls and operational approval. Configure those integrations before enabling live settlement.

## Local setup
1. Copy `.env.example` to `.env`.
2. Add Supabase PostgreSQL and Supabase Auth credentials.
3. Run `composer install`.
4. Run `php artisan key:generate`.
5. Run `php artisan migrate --seed`.
6. Run `php artisan serve`.

## Vercel
Set every `.env` value in the Vercel project settings. Use the included `Dockerfile` for container deployment or the included PHP entrypoint configuration supported by the selected Vercel PHP runtime. Run migrations against Supabase as a controlled deployment step, never against a local SQLite database.
