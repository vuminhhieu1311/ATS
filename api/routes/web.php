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

Route::get('test', function() {
    dd(\Illuminate\Support\Carbon::now()->format('Y'));
    $users = \App\Models\User::select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            return \Illuminate\Support\Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

    $usermcount = [];
    $userArr = [];

    foreach ($users as $key => $value) {
        $usermcount[(int)$key] = count($value);
    }

    for ($i = 1; $i <= 12; $i++) {
        if (!empty($usermcount[$i])){
            $userArr[] = $usermcount[$i];
        } else {
            $userArr[] = 0;
        }
    }

    return $userArr;
});
