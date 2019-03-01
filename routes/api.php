<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => 'api'], function() {
    Route::get('getCategorys',  'CategoryController@getCategorys');
    Route::post('addCategorys',  'CategoryController@addCategorys');
    Route::post('updateCategorys',  'CategoryController@updateCategorys');
    
    Route::get('getRecords',  'RecordController@getRecords');
    Route::post('getRecordsDetail',  'RecordController@getRecordsDetail');
    Route::post('getCategoryName',  'RecordController@getCategoryName');
    Route::post('registRecord',  'RecordController@registRecord');
});
