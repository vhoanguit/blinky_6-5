<?php

use Illuminate\Support\Facades\Route;
// // FE
Route::get('/', 'App\Http\Controllers\HomeController@index'); // goi ham index trong HomeController
Route::get('/trang-chu', 'App\Http\Controllers\HomeController@index');

// //BE 
// //admin
Route::get('/admin','App\Http\Controllers\AdminController@index');
Route::get('/dashboard','App\Http\Controllers\AdminController@show_dashboard');



// Route::get('/Admin','App\Http\Controllers\AdminController@index');

// use app\Http\Controllers\HomeController;
// use app\Http\Controllers\AdminController;
// Route::get('/',[HomeController::class,'index']);
// Route::get('/trang-chu',[HomeController::class,'index']);
// Route::get('/admin',[AdminController::class,'index']);
?>