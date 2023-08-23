<?php

use App\Http\Controllers\web\noteController as noteWeb;
use App\Http\Controllers\web\userController as userWeb;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [userWeb::class,'login'])->name("login");
Route::get('/register', [userWeb::class,'register']);

Route::get('/', [noteWeb::class,'index']);
Route::get('/note/create', [noteWeb::class,'create']);
Route::get('/note/update/{id}', [noteWeb::class,'update']);




