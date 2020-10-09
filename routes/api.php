<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([ 'prefix' => 'api/v1', 'namespace' => 'Api\V1' ], function() {
    Route::post('document', 'DocumentController@store')->name('document.store');
    Route::patch('document', 'DocumentController@update')->name('document.update');
    Route::get('document/{document}', 'DocumentController@show')->name('document.show');;
    Route::post('document{document}/publish', 'DocumentController@publish')->name('document.publish');;
    Route::get('document', 'DocumentController@index')->name('document.index');
});
