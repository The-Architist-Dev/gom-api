# GOM API - Laravel Backend

Backend API cho hệ thống giám định gốm sứ. Laravel 12 + Sanctum authentication.

## Tính năng

- Authentication (Email/Password, Google OAuth)
- Phân tích gốm sứ (gọi Python AI service)
- Quản lý token credits (5 lượt free, sau đó trả phí)
- Thanh toán qua SePay
- Chat với AI
- Quản lý dòng gốm (Ceramic Lines)
- Admin dashboard
- Azure Blob Storage

## Tech stack

- Laravel 12
- Sanctum (token auth)
- SQLite (dev) / MySQL (prod)
- Azure Blob Storage
- SePay payment gateway

## Yêu cầu

- PHP 8.2+
- Composer 2.x
- SQLite hoặc MySQL 8.0+

## Cài đặt

```bash
cd gom-api
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan storage:link
```

## Cấu hình

File `.env`:

```env
APP_NAME="GOM API"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite

FRONTEND_URL=http://localhost:3000
SANCTUM_STATEFUL_DOMAINS=localhost:3000,127.0.0.1:3000

PYTHON_AI_URL=http://localhost:8001

AZURE_STORAGE_CONNECTION_STRING=DefaultEndpointsProtocol=https;AccountName=xxx;AccountKey=xxx
AZURE_STORAGE_CONTAINER=gom-uploads

GOOGLE_CLIENT_ID=xxxxx.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=xxxxx

SEPAY_API_KEY=xxxxx
SEPAY_ACCOUNT_NUMBER=1234567890
SEPAY_ACCOUNT_NAME=NGUYEN VAN A
SEPAY_BANK_CODE=MB

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
```

## Chạy server

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

Server chạy tại http://localhost:8000

## API Endpoints

### Public

```
GET  /api/health
POST /api/register
POST /api/login
POST /api/login/social
POST /api/forgot-password
POST /api/reset-password
GET  /api/ceramic-lines
GET  /api/ceramic-lines/{id}
GET  /api/stats
POST /api/contact
```

### Authenticated (cần Bearer token)

```
GET  /api/user
POST /api/logout
POST /api/profile/update
POST /api/profile/password

POST /api/predict              # 1 token
POST /api/ai/chat              # 0.1 token
GET  /api/history
GET  /api/history/{id}

GET  /api/payment/status
GET  /api/payment/packages
GET  /api/payment/history
POST /api/payment/create
GET  /api/payment/check/{id}

POST /api/v1/storage/azure-blob/upload/single
POST /api/v1/storage/azure-blob/upload/multiple
DELETE /api/v1/storage/azure-blob/delete/single
```

### Admin

```
GET  /api/admin/dashboard
GET  /api/admin/users
PUT  /api/admin/users/{id}
DELETE /api/admin/users/{id}
GET  /api/admin/ceramic-lines
POST /api/admin/ceramic-lines
PUT  /api/admin/ceramic-lines/{id}
DELETE /api/admin/ceramic-lines/{id}
GET  /api/admin/payments
GET  /api/admin/predictions
```

## Database

Tables:
- users (name, email, password, token_balance, free_predictions_used, avatar, phone)
- predictions (user_id, image, final_prediction, country, era, result_json)
- payments (user_id, package_id, amount_vnd, credit_amount, hex_id, status, sepay_tx_id)
- token_history (user_id, type, amount, description)
- ceramic_lines (name, origin, country, era, description, image_url, style, is_featured)
- potteries (legacy)
- personal_access_tokens (Sanctum)

Chi tiết: docs/database.md

## Token System

- Free: 5 lượt phân tích miễn phí
- Predict: 1 token/lần
- Chat: 0.1 token/lần
- Mua token qua payment packages:
  - Gói Basic: 50,000 VNĐ = 10 tokens
  - Gói Pro: 100,000 VNĐ = 25 tokens
  - Gói Premium: 200,000 VNĐ = 60 tokens

## Testing

```bash
php artisan test

# Test API
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{"name":"Test","email":"test@test.com","password":"password123","password_confirmation":"password123"}'

curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@test.com","password":"password123"}'

curl http://localhost:8000/api/user \
  -H "Authorization: Bearer YOUR_TOKEN"
```

## Troubleshooting

Class not found:
```bash
composer dump-autoload
```

Permission denied:
```bash
chmod -R 775 storage bootstrap/cache
```

CORS error: Check FRONTEND_URL trong .env

## Deployment

```bash
APP_ENV=production
APP_DEBUG=false

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

php artisan migrate --force
```

## Tài liệu khác

- docs/database.md - Schema chi tiết
- docs/api.md - API documentation đầy đủ
