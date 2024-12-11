<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/registrations/{qrCode}', [ApiController::class, 'show']);
Route::middleware('auth:sanctum')->post('/update-scan-status', [ApiController::class, 'updateScanStatus']);
Route::post('/login', [ApiController::class, 'login']);
Route::middleware('auth:sanctum')->patch('/registrations/{qrCode}', [ApiController::class, 'show']);
Route::middleware('auth:sanctum')->post('/logout', [ApiController::class, 'logout']);
Route::middleware(['auth:sanctum', 'valid_token'])->get('/some-protected-route', function () {
    return response()->json(['message' => 'This is a protected route']);
});
Route::middleware('auth:sanctum')->get('/check-token', [ApiController::class, 'checkToken']);
Route::get('/logo', [ApiController::class, 'getLogo']);  // Mengambil logo pertama



