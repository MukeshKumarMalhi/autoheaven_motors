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
Route::get('/get_cars_by_company', 'WebController@get_cars_by_company');
Route::get('/get_cars_by_company_home', 'WebController@get_cars_by_company_home');

Auth::routes();
Route::get('admin/dashboard', 'Admin\AdminController@admin_dashboard');
Route::get('admin/view_cars', 'Admin\AdminController@view_cars');
Route::get('admin/upload_car_images/{id}', 'Admin\AdminController@upload_car_images');
Route::post('admin/delete_car_image', 'Admin\AdminController@delete_car_image');
Route::post('admin/store_car_data', 'Admin\AdminController@store_car_data');
Route::get('admin/view_details/{name}/{id}', 'Admin\AdminController@view_car_details');
Route::post('admin/update_car_details', 'Admin\AdminController@update_car_details');
Route::post('admin/store_car_vehicle_summary_details', 'Admin\AdminController@store_car_vehicle_summary');
Route::post('admin/update_car_vehicle_summary_details', 'Admin\AdminController@update_car_vehicle_summary');
Route::post('admin/store_car_performance_economy_details', 'Admin\AdminController@store_car_performance_economy');
Route::post('admin/update_car_performance_economy_details', 'Admin\AdminController@update_car_performance_economy');
Route::post('admin/store_car_dimensions_details', 'Admin\AdminController@store_car_dimensions');
Route::post('admin/update_car_dimensions_details', 'Admin\AdminController@update_car_dimensions');
Route::post('admin/store_car_interior_features_details', 'Admin\AdminController@store_car_interior_features');
Route::post('admin/update_car_interior_features_details', 'Admin\AdminController@update_car_interior_features');
Route::post('admin/store_car_exterior_features_details', 'Admin\AdminController@store_car_exterior_features');
Route::post('admin/update_car_exterior_features_details', 'Admin\AdminController@update_car_exterior_features');
Route::post('admin/store_car_safety_features_details', 'Admin\AdminController@store_car_safety_features');
Route::post('admin/update_car_safety_features_details', 'Admin\AdminController@update_car_safety_features');
Route::post('admin/store_car_images', 'Admin\AdminController@store_car_images');
Route::post('admin/store_car_video_file', 'Admin\AdminController@store_car_video');

Route::get('admin/view_reviews', 'Admin\AdminController@view_cars_reviews');
Route::get('admin/view_part_exchanges', 'Admin\AdminController@view_cars_part_exchanges');
Route::get('admin/view_sell_your_vehicles', 'Admin\AdminController@view_cars_sell_your_vehicles');
Route::get('admin/view_finances', 'Admin\AdminController@view_cars_finances');
Route::get('admin/view_contacts', 'Admin\AdminController@view_cars_contacts');
Route::get('admin/view_car_enquiries', 'Admin\AdminController@view_cars_enquiries');

//Categories

Route::get('admin/view_categories', 'Admin\AdminController@view_categories');
Route::post('admin/store_category', 'Admin\AdminController@store_category');
Route::post('admin/update_category', 'Admin\AdminController@update_category');
Route::post('admin/delete_category', 'Admin\AdminController@delete_category');

//End categories
// Route::get('/home', 'HomeController@index')->name('home');

//website routes

// Route::get('search-results/{make}/{model}/{min_price}/{max_price}/{body_style}/{mileage}/{min_engine_size}/{max_engine_size}/{fuel_type}/{gearbox_type}/{min_year}/{max_year}/{no_of_doors}', 'WebController@search_car_results');
Route::get('/used-cars/search-results', 'WebController@search_car_results');
Route::get('/used-cars', 'WebController@search_car_results');
Route::get('/used-cars/{name}', 'WebController@car_details_page');
Route::get('/used-cars/finance/{name}', 'WebController@car_enquire_finance');
Route::get('/sell-your-car', 'WebController@sell_your_car');
Route::post('/store_sell_your_car', 'WebController@store_sell_your_car');
Route::post('/store_part_exchange', 'WebController@store_part_exchange');
Route::post('/store_contact_us_form', 'WebController@store_contact_us_form');
Route::post('/store_finance_form', 'WebController@store_finance_form');
Route::post('/store_enquiry_form', 'WebController@store_enquiry_form');
Route::post('/store_review_form', 'WebController@store_review_form');
Route::get('/part-exchange', 'WebController@part_exchange');
Route::get('/contact-us', 'WebController@contact_us_page');
Route::get('/finance', 'WebController@finance_page');
Route::get('/reviews', 'WebController@reviews_page');
Route::get('/send_test_email', 'WebController@send_test_email');
