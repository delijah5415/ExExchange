# Vercel + Supabase production deployment

1. Create a Supabase project and obtain the PostgreSQL connection details from **Connect**. Use the Session Pooler connection for the Laravel application and require SSL.
2. Create a Vercel project connected to the Git repository. Vercel will build `Dockerfile.vercel` as a containerized Laravel HTTP service.
3. Add all variables from `.env.example` to the Vercel Production environment. Never commit `.env` or secret keys.
4. Before first customer traffic, run the migration and seed commands against the production Supabase database from a controlled deployment environment:
   - `php artisan migrate --force`
   - `php artisan db:seed --force`
5. Confirm `/up`, `/`, `/login`, `/register`, `/exchange` and `/account` behave correctly.
6. Configure a custom domain and HTTPS in Vercel.
7. Configure Supabase Auth redirect URLs to the production domain.
8. Configure your production email provider. The repository defaults to the Laravel `log` mailer until a real provider is configured.
9. Configure payment, wallet/node and webhook integrations only after their credentials and verification controls have been implemented.

## Stateless runtime requirement
Vercel containers are stateless. This package uses database-backed Laravel sessions so login state is not tied to a container's local filesystem. Persistent uploads must use Supabase Storage or another durable object store rather than local disk.

## Real-money launch gate
Creating an exchange order is not proof that a payment has settled. Before enabling live settlement, implement and verify payment webhooks, blockchain confirmation tracking, withdrawal controls, reconciliation, fraud/risk checks, applicable KYC/AML processes, audit logging and incident procedures.
