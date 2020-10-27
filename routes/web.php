<?php

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
    return view('home');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('{path}',"HomeController@index")->where('path','([A-Z\d-\/_.]+)?');

Route::group(['middleware'=> ['web','auth']], function(){
   Route::get('/', function () {
       return view('welcome');
   });

   Route::get('/', function() {
       if(Auth::user()->roll == 1) {
           return view('adminHome');
       } else {
        return view('customerHome');
       }
   });


});

Route::group(['middleware' => 'prevent-back-history'],function(){
    Auth::routes();
    Route::get('/adminHome', 'HomeController@index');
  });

  Route::get('/{any}', function () {
    if(Auth::user()->roll == 1) {
        return view('adminHome');
    } else {
     return view('customerHome');
    }
    
})->where('any', '.*');
