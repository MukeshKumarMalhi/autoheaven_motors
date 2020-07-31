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

Route::get('/','WebController@index');
Route::get('admin/login','WebController@admin_login');
Route::get('/logout', 'Auth\LoginController@logout');

Auth::routes();
Route::get('admin/dashboard', 'Admin\AdminController@admin_dashboard');
Route::get('admin/view_cars', 'Admin\AdminController@view_cars');
Route::post('admin/store_car_data', 'Admin\AdminController@store_car_data');

//Categories

Route::get('admin/view_categories', 'Admin\AdminController@view_categories');
Route::post('admin/store_category', 'Admin\AdminController@store_category');
Route::post('admin/update_category', 'Admin\AdminController@update_category');
Route::post('admin/delete_category', 'Admin\AdminController@delete_category');

//End categories
// Route::get('/home', 'HomeController@index')->name('home');
