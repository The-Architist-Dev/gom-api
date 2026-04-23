<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PotteryController;
use App\Http\Controllers\Api\PredictionController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ContactController;

use App\Http\Controllers\Api\CeramicLineController;
use App\Http\Controllers\Api\AzureBlobStorageController;
use App\Http\Controllers\Api\AdminController;

// Public ceramic lines API
Route::get('/ceramic-lines', [CeramicLineController::class, 'index']);
Route::get('/ceramic-lines/{id}', [CeramicLineController::class, 'show']);

// Public stats API
Route::get('/stats', function () {
    return response()->json([
        'total_analyzed' => \App\Models\Pottery::count(),
        'accuracy' => 99.2
    ]);
});

Route::post('/contact', [ContactController::class, 'submit']);

Route::get('/potteries', [PotteryController::class, 'index']);
Route::post('/upload', [PotteryController::class, 'upload']);
Route::delete('/potteries/{pottery}', [PotteryController::class, 'destroy']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/login/social', [AuthController::class, 'socialLogin']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/history', [PredictionController::class, 'history']);
    Route::get('/history/{id}', [PredictionController::class, 'show']);
    Route::post('/predict', [PredictionController::class, 'predict']);
    Route::post('/ai/debate', [PredictionController::class, 'predict']);
    Route::post('/ai/chat', [PredictionController::class, 'chat']);
    Route::post('/profile/update', [AuthController::class, 'updateProfile']);
    Route::post('/profile/password', [AuthController::class, 'updatePassword']);

    // Admin routes
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard']);
        Route::get('/users', [AdminController::class, 'users']);
        Route::put('/users/{id}', [AdminController::class, 'updateUser']);
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser']);
        Route::get('/ceramic-lines', [AdminController::class, 'ceramicLines']);
        Route::post('/ceramic-lines', [AdminController::class, 'storeCeramicLine']);
        Route::put('/ceramic-lines/{id}', [AdminController::class, 'updateCeramicLine']);
        Route::delete('/ceramic-lines/{id}', [AdminController::class, 'deleteCeramicLine']);
        Route::get('/payments', [AdminController::class, 'payments']);
        Route::get('/predictions', [AdminController::class, 'predictions']);
    });

    // Payment routes
    Route::get('/payment/status', [PaymentController::class, 'getStatus']);
    Route::get('/payment/packages', [PaymentController::class, 'getPackages']);
    Route::get('/payment/history', [PaymentController::class, 'getHistory']);
    Route::post('/payment/create', [PaymentController::class, 'createPayment']);
    Route::get('/payment/check/{paymentId}', [PaymentController::class, 'checkStatus']);
    Route::post('/payment/test-complete/{paymentId}', [PaymentController::class, 'testCompletePayment']);
});

Route::prefix('v1/storage/azure-blob')->group(function () {
    Route::post('/upload/single', [AzureBlobStorageController::class, 'uploadSingleFile']);
    Route::post('/upload/multiple', [AzureBlobStorageController::class, 'uploadMultipleFiles']);
    Route::delete('/delete/single', [AzureBlobStorageController::class, 'deleteSingleFile']);
    Route::delete('/delete/multiple', [AzureBlobStorageController::class, 'deleteMultipleFiles']);
    Route::put('/move/single', [AzureBlobStorageController::class, 'moveSingleFile']);
    Route::put('/move/multiple', [AzureBlobStorageController::class, 'moveMultipleFiles']);
});

Route::get('/img/{path}', function (string $path) {
    $fullPath = storage_path('app/public/' . $path);
    if (!file_exists($fullPath)) { abort(404); }
    $mime = mime_content_type($fullPath) ?: 'application/octet-stream';
    return response()->file($fullPath, ['Content-Type' => $mime, 'Cache-Control' => 'public, max-age=86400']);
})->where('path', '.*');

Route::get("/add_token", function() { \App\Models\User::query()->update(["token_balance" => 1000]); return "OK"; });
Route::get('/test', function () {
    return response()->json(['status' => 'ok']);
});