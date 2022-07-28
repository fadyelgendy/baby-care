<?php

use App\Http\Controllers\Api\AuthController;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public Endpoints
Route::post("/login", [AuthController::class, 'login']);
Route::post("/register", [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix("user")->group(function() {
        Route::post("/logout", [AuthController::class, 'logout']);
    });
});

// Handle unauthorized requests
Route::get('/unauthorized', function () {
    return [
        "success" => false,
        "status_code" => 401,
        "errors" => [
            "error" => trans("auth.unauthorized")
        ]
    ];
})->name("api.unauthorized");
