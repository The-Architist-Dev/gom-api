# Deploy gom-api on Railway

## 1. Build source

Service uses Dockerfile at project root.

## 2. Required variables

Set these variables in gom-api service:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://<gom-api-public-domain>`
- `APP_KEY=<your-laravel-app-key>`
- `DB_CONNECTION=mysql`
- `DB_HOST=<mysql-host>`
- `DB_PORT=<mysql-port>`
- `DB_DATABASE=<mysql-database>`
- `DB_USERNAME=<mysql-user>`
- `DB_PASSWORD=<mysql-password>`
- `DATABASE_URL=<mysql://...>` (optional but recommended)
- `PYTHON_AI_URL=https://<gom-ai-public-domain>`

If both services are in the same Railway project, you can use private networking and set:

- `PYTHON_AI_URL=http://<gom-ai-private-domain>`

## 3. Startup behavior

Container entrypoint runs:

1. `php artisan migrate --force` (with retry)
2. `php artisan serve --host=0.0.0.0 --port=$PORT`

So database tables are auto-created/applied on startup.

## 4. Health check

- App health: `GET /up`
- API sanity: `GET /api/test`
