<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('about-us/{category}', [AboutController::class, 'about']);

Route::get('contact-us', [ContactController::class, 'contact']);

Route::get('create-person', [PersonController::class, 'create']);
Route::post('store-person', [PersonController::class, 'store']);

Route::get('persons', [PersonController::class, 'all']);

Route::get('edit-person/{pid}', [PersonController::class, 'edit']);
Route::post('update-person/{pid}', [PersonController::class, 'update']);
Route::get('delete-person/{pid}', [PersonController::class, 'delete']);

Route::get('register', [AuthController::class, 'register']);
Route::post('store-register', [AuthController::class, 'registerStore']);
Route::get('login', [AuthController::class, 'login']);
Route::post('store-login', [AuthController::class, 'loginStore']);

Route::get('dashboard', [AuthController::class, 'dashboard']);