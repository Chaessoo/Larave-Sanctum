<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\TokoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get("/show",[TokoController::class,"show"]);
Route::get("/solo",[TokoController::class,"solo"]);
Route::post("register",[AuthController::class,"register"]);
Route::post("/login",[AuthController::class,"login"]);
Route::middleware('auth:sanctum')->group( function () {
    Route::get("/profil",[AuthController::class,"profil"]);
// Route::put("/edit/{id}",[TokoController::class,"edit"]);
Route::post("/add",[TokoController::class,"add"]);
Route::put("/update/{id}",[TokoController::class,"update"]);
Route::delete("/update/{id}",[TokoController::class,"destroy"]);


});
