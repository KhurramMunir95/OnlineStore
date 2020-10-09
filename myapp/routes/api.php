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

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('auth/me', 'API\AuthController@local');
    Route::get('oauth/me', 'API\AuthController@oauth');
   
});
// ================= User Register =================

// Register User
Route::post('/register/{email}', 'API\AuthController@register');

// ================= Products =================

    /*Insert*/
Route::post('/createproduct', 'ProductController@store');

    /*Select the specified product*/
Route::get('/selectproduct/{id}', 'ProductController@show');

    /*Select all products*/
Route::get('/selectproduct', 'ProductController@index');

    /*Update*/
Route::post('/updateproduct/{id}', 'ProductController@update');

    /*Delete*/
Route::delete('/deleteproduct/{id}', 'ProductController@destroy');

// ================= Categories =================

    /*Insert*/
Route::post('/createcategory', 'CategoryController@store');

    /*Select the specified category*/
Route::post('/selectcategory/{id}', 'CategoryController@show');

    /*Select all categories*/
Route::get('/selectcategory', 'CategoryController@index');

    /*update*/
Route::post('/updatecategory/{id}', 'CategoryController@update');

    /*delete*/
Route::delete('/deletecategory/{id}', 'CategoryController@destroy');    


// ================= Cart ================= 

    /*insert*/
Route::post('/addtocart', 'CartController@store');

    /*select*/
Route::get('/selectcart/{id}', 'CartController@show');

    /*update*/
Route::post('/updatecart/{userid}/{productid}', 'CartController@update');

    /*delete*/
Route::delete('/deletefromcart/{userid}/{productid}', 'CartController@destroy');