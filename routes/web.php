<?php

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

if (\App::environment() === 'local') {
    Route::get('info', fn() => phpinfo());
    Route::get('env', function () {
        echo '<pre>';
        print_r(\config());
        print_r($_ENV);
        echo '</pre>';
    });

    Route::get('db', function() {
        $app = app();
        $con = DB::connection();
        $a=1;
    });
}

