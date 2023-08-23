<?php

use App\Http\Controllers\api\noteController;
use App\Http\Controllers\api\userController as userApi;
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

Route::post("/login",[userApi::class,"login"]);
Route::post("/register",[userApi::class,"register"]);

Route::get("/note/getall",[noteController::class,"getall"])->middleware("auth:api");
Route::middleware(['auth:api'])->group(function () {
    Route::prefix('note')->group(function () {
        Route::get("/getall",[noteController::class,"getall"]);
        Route::get("/getbyid/{id}",[noteController::class,"getbyid"]);
        Route::post("/add",[noteController::class,"store"]);
        Route::delete("/delete/{id}",[noteController::class,"delete"]);
        Route::put("/update/{id}",[noteController::class,"update"]);
    });
});

