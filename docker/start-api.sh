#!/bin/sh
set -e

if [ -z "${APP_KEY:-}" ]; then
  export APP_KEY="base64:$(php -r 'echo base64_encode(random_bytes(32));')"
  echo "[start-api] APP_KEY was empty. Generated ephemeral APP_KEY for this container."
fi

php artisan config:clear >/dev/null 2>&1 || true

MIGRATE_ATTEMPTS="${DB_MIGRATE_ATTEMPTS:-20}"
MIGRATE_SLEEP_SECONDS="${DB_MIGRATE_SLEEP_SECONDS:-3}"
ATTEMPT=1

until php artisan migrate --force; do
  if [ "$ATTEMPT" -ge "$MIGRATE_ATTEMPTS" ]; then
    echo "[start-api] Migration failed after ${MIGRATE_ATTEMPTS} attempts."
    exit 1
  fi

  echo "[start-api] Migration attempt ${ATTEMPT}/${MIGRATE_ATTEMPTS} failed. Retrying in ${MIGRATE_SLEEP_SECONDS}s..."
  ATTEMPT=$((ATTEMPT + 1))
  sleep "$MIGRATE_SLEEP_SECONDS"
done

echo "[start-api] Starting Laravel server on port ${PORT:-8080}."
exec php artisan serve --host=0.0.0.0 --port="${PORT:-8080}"
