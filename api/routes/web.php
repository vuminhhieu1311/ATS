<?php

use App\Http\Controllers\SocialLoginController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('social')->group(function () {
    Route::get('{provider}/login', [SocialLoginController::class, 'login']);
    Route::get('{provider}/callback', [SocialLoginController::class, 'callback']);
});
