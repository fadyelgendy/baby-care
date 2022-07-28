<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChildController;
use App\Http\Controllers\Api\ParentController;
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
Route::post("/login", [AuthController::class, 'login'])->middleware("language");
Route::post("/register", [AuthController::class, 'register'])->middleware("language");

Route::middleware(['auth:sanctum', 'language'])->group(function () {
    Route::prefix("user")->group(function() {
        Route::post("/logout", [AuthController::class, 'logout']);

        Route::prefix("partner")->group(function() {
            Route::get("/show", [ParentController::class, "getPartner"]);
            Route::post("/create", [ParentController::class, "createPartner"]);
        });

        Route::prefix("children")->group(function() {
            Route::get("/list", [ChildController::class, "list"]);
            Route::post("/create", [ChildController::class, "create"]);
            Route::get("/{id}/show", [ChildController::class, "show"]);
            Route::post("/{id}/edit", [ChildController::class, "edit"]);
            Route::post("/{id}/delete", [ChildController::class, "delete"]);
        });
        
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
