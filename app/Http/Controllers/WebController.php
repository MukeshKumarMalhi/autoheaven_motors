<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use DB;
use App\User;
use App\Category;
use App\Review;
use App\Contact;
use App\Finance;
use App\CarEnquiry;
use App\PartExchange;
use App\SellYourVehicle;
use App\Car;
use App\CarImage;
use App\VehicleSummary;
use App\PerformanceEconomy;
use App\Dimension;
use App\InteriorFeature;
use App\ExteriorFeature;
use App\Safety;
use App\Mail\TestEmail;
use App\Mail\SellYourVehicleEmail;
use App\Mail\PartExchangeEmail;
use App\Mail\ReviewEmail;
use App\Mail\ContactEmail;
use App\Mail\FinanceEmail;
use App\Mail\EnquiryEmail;
use DateTime;
use Illuminate\Pagination\LengthAwarePaginator;

class WebController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function index()
  {
    $list_cars = DB::table('cars')
            ->leftJoin('categories', 'categories.id', '=', 'cars.category_id')
            ->select('cars.*', 'categories.category_name')
            ->get()
            ->toArray();
    $cars = $this->car_attributes_count_home($list_cars);

    $featured_cars = DB::select( DB::raw("SELECT DISTINCT a.id, a.model, a.model_year, a.price, a.fuel_type, a.gearbox_type, a.engine_size, a.mileage, a.number_of_doors, a.featured_image, c.category_name
                              FROM cars AS a LEFT JOIN categories c ON a.category_id = c.id
                              WHERE 4 >= (SELECT COUNT(DISTINCT price)
                                                  FROM cars AS b
                                                  WHERE b.price >= a.price)
                              ORDER BY price DESC"
                            ));
    $reviews = DB::table('reviews')->select('reviews.*')->orderBy('reviews.updated_at', 'desc')->get()->toArray();
    $latest_cars = DB::table('cars')
            ->leftJoin('categories', 'categories.id', '=', 'cars.category_id')
            ->select('cars.*', 'categories.category_name')
            ->latest()
            ->take(2)
            ->get();

    return view('website.index', [
      'cars' => $cars,
      'list_cars' => $list_cars,
      'featured_cars' => $featured_cars,
      'reviews' => $reviews,
      'latest_cars' => $latest_cars
    ]);
  }

  public function admin_login()
  {
    return view('auth.login');
  }

  public function get_cars_by_company(Request $request)
  {
    if($request->make == "make"){
      $make = "make";
    }else {
      $make = str_replace("-", " ", $request->make);
    }

    if($request->model == "model"){
      $model = "model";
    }else {
      $model = str_replace("-", " ", $request->model);
    }

    if($request->min_price == "min_price"){
      $min_price = "min-price";
    }else {
      $min_price = str_replace("-", " ", $request->min_price);
    }

    if($request->max_price == "max_price"){
      $max_price = "max-price";
    }else {
      $max_price = str_replace("-", " ", $request->max_price);
    }

    if($request->body_style == "body_type"){
      $body_style = "body-type";
    }else {
      $body_style = str_replace("-", " ", $request->body_style);
    }

    if($request->mileage == "mileage"){
      $mileage = "mileage";
    }else {
      $mileage = str_replace("-", " ", $request->mileage);
    }

    if($request->min_engine_size == "min_engine_size"){
      $min_engine_size = "min-engine-size";
    }else {
      $min_engine_size = str_replace("-", " ", $request->min_engine_size);
    }

    if($request->max_engine_size == "max_engine_size"){
      $max_engine_size = "max-engine-size";
    }else {
      $max_engine_size = str_replace("-", " ", $request->max_engine_size);
    }

    if($request->fuel_type == "fuel_type"){
      $fuel_type = "fuel-type";
    }else {
      $fuel_type = str_replace("-", " ", $request->fuel_type);
    }

    if($request->gearbox_type == "gearbox_type"){
      $gearbox_type = "gearbox-type";
    }else {
      $gearbox_type = str_replace("-", " ", $request->gearbox_type);
    }

    if($request->min_year == "min_year"){
      $min_year = "min-year";
    }else {
      $min_year = str_replace("-", " ", $request->min_year);
    }

    if($request->max_year == "max_year"){
      $max_year = "max-year";
    }else {
      $max_year = str_replace("-", " ", $request->max_year);
    }

    if($request->number_of_doors == "number_of_doors"){
      $number_of_doors = "number-of-doors";
    }else {
      $number_of_doors = str_replace("-", " ", $request->number_of_doors);
    }

    $category = Category::where('category_name', '=', $request->make)->first();
    $cars = DB::table('cars')
            ->leftJoin('categories', 'categories.id', '=', 'cars.category_id')
            ->select('cars.*', 'categories.category_name');

    if(isset($request->make) && $request->make != "make")
      $cars->where('cars.category_id', '=', $category->id);
    if(isset($request->model) && $request->model != "model")
      $cars->where('cars.model', '=', $model);
    if(isset($request->min_price) && $request->min_price != "min_price")
      $cars->where('cars.price', '>', $min_price);
    if(isset($request->max_price) && $request->max_price != "max_price")
      $cars->where('cars.price', '<', $max_price);
    if(isset($request->body_style) && $request->body_style != "body_type")
      $cars->where('cars.body_style', '=', $body_style);
    if(isset($request->mileage) && $request->mileage != "mileage")
      $cars->where('cars.mileage', '<=', $mileage);
    if(isset($request->min_engine_size) && $request->min_engine_size != "min_engine_size")
      $cars->where('cars.engine_size', '>=', $min_engine_size);
    if(isset($request->max_engine_size) && $request->max_engine_size != "max_engine_size")
      $cars->where('cars.engine_size', '<=', $max_engine_size);
    if(isset($request->fuel_type) && $request->fuel_type != "fuel_type")
      $cars->where('cars.fuel_type', '=', $fuel_type);
    if(isset($request->gearbox_type) && $request->gearbox_type != "gearbox_type")
      $cars->where('cars.gearbox_type', '=', $gearbox_type);
    if(isset($request->min_year) && $request->min_year != "min_year")
      $cars->where('cars.model_year', '>=', $min_year);
    if(isset($request->max_year) && $request->max_year != "max_year")
      $cars->where('cars.model_year', '<=', $max_year);
    if(isset($request->number_of_doors) && $request->number_of_doors != "number_of_doors")
      $cars->where('cars.number_of_doors', '=', $number_of_doors);



    $list_cars = $cars->orderBy('price', 'asc')->get();
    $total_cars = DB::table('cars')
          ->leftJoin('categories', 'categories.id', '=', 'cars.category_id')
          ->select('cars.*', 'categories.category_name')
          ->count();

    if(count($list_cars) == $total_cars){
      $list_cars = DB::table('cars')
            ->leftJoin('categories', 'categories.id', '=', 'cars.category_id')
            ->select('cars.*', 'categories.category_name')
            ->orderBy('price', 'asc')
            ->get()
            ->toArray();
            $cars = $this->car_attributes_count($list_cars);
    }else {
      $cars = $this->car_attributes_counted($list_cars, $make, $model, $min_price, $max_price, $body_style, $mileage, $min_engine_size, $max_engine_size, $fuel_type, $gearbox_type, $min_year, $max_year, $number_of_doors);
    }
    return response()->json($cars, 200);
  }

  public function get_cars_by_company_home(Request $request)
  {
    if($request->make == "make"){
      $make = "make";
    }else {
      $make = str_replace("-", " ", $request->make);
    }

    if($request->model == "model"){
      $model = "model";
    }else {
      $model = str_replace("-", " ", $request->model);
    }

    if($request->min_price == "min_price"){
      $min_price = "min-price";
    }else {
      $min_price = str_replace("-", " ", $request->min_price);
    }

    if($request->max_price == "max_price"){
      $max_price = "max-price";
    }else {
      $max_price = str_replace("-", " ", $request->max_price);
    }

    $category = Category::where('category_name', '=', $request->make)->first();
    $cars = DB::table('cars')
            ->leftJoin('categories', 'categories.id', '=', 'cars.category_id')
            ->select('cars.*', 'categories.category_name');

    if(isset($request->make) && $request->make != "make")
      $cars->where('cars.category_id', '=', $category->id);
    if(isset($request->model) && $request->model != "model")
      $cars->where('cars.model', '=', $model);
    if(isset($request->min_price) && $request->min_price != "min_price")
      $cars->where('cars.price', '>', $min_price);
    if(isset($request->max_price) && $request->max_price != "max_price")
      $cars->where('cars.price', '<', $max_price);


    $list_cars = $cars->orderBy('price', 'asc')->get();
    $total_cars = DB::table('cars')
          ->leftJoin('categories', 'categories.id', '=', 'cars.category_id')
          ->select('cars.*', 'categories.category_name')
          ->count();

    if(count($list_cars) == $total_cars){
      $list_cars = DB::table('cars')
            ->leftJoin('categories', 'categories.id', '=', 'cars.category_id')
            ->select('cars.*', 'categories.category_name')
            ->orderBy('price', 'asc')
            ->get()
            ->toArray();
            $cars = $this->car_attributes_count_home($list_cars);
    }else {
      $cars = $this->car_attributes_counted_home($list_cars, $make, $model, $min_price, $max_price);
    }
    return response()->json($cars, 200);
  }

  public function car_attributes_count($cars)
  {
    $data = [];
    $min_array_engine = [];
    $max_array_engine = [];
    $min_array_year = [];
    $max_array_year = [];
    $extra_array = [];
    $counter = 0;
    foreach ($cars as $key => $value) {

      $data['category_name'][] = $value->category_name;
      $array_cn = array_count_values($data['category_name']);
      ksort($array_cn);
      $data['category'] = $array_cn;

      $data['body_styles'][] = $value->body_style;
      $array_bs = array_count_values($data['body_styles']);
      ksort($array_bs);
      // $this->array_insert( $array_bs, 0, array("Body type (all)" => ""));
      $data['body_style'] = $array_bs;

      $data['models'][] = $value->model;
      $array_mo = array_count_values($data['models']);
      ksort($array_mo);
      $data['model'] = $array_mo;

      $data_min_prices_array = $this->roundDown($value->price, 500, $value->category_name);
      foreach ($data_min_prices_array as $key => $val) {
        $data['min_prices'][] = $val;
      }
      $array_min_pr = array_count_values($data['min_prices']);
      ksort($array_min_pr);
      $data['min_price'] = $array_min_pr;

      $data_max_prices_array = $this->roundUp($value->price, 500, $value->category_name);
      foreach ($data_max_prices_array as $key => $va) {
        $data['max_prices'][] = $va;
      }
      $array_max_pr = array_count_values($data['max_prices']);
      ksort($array_max_pr);
      $data['max_price'] = $array_max_pr;

      $data_mileage_array = $this->roundUpMileage($value->mileage, 5000, $value->category_name);
      if(is_array($data_mileage_array)){
        foreach($data_mileage_array as $key => $va){
          $data['mileages'][] = $va;
        }
      }
      $array_mi = array_count_values($data['mileages']);
      ksort($array_mi);
      $data['mileage'] = $array_mi;

      $data['fuel_types'][] = $value->fuel_type;
      $array_ft = array_count_values($data['fuel_types']);
      ksort($array_ft);
      $data['fuel_type'] = $array_ft;

      $data['gearbox_types'][] = $value->gearbox_type;
      $array_gt = array_count_values($data['gearbox_types']);
      ksort($array_gt);
      $data['gearbox_type'] = $array_gt;

      $data['number_of_doorss'][] = $value->number_of_doors;
      $array_nd = array_count_values($data['number_of_doorss']);
      ksort($array_nd);
      $data['number_of_doors'] = $array_nd;

      $data_min_engine_size_array = $this->engineSizeMin($value->engine_size);
      if ($counter == 0){
        $min_array_engine[] = $data_min_engine_size_array[0];
        foreach ($data_min_engine_size_array as $key => $val) {
          $data['min_engine_sizes'][] = $val;
        }
      }else {
        if (in_array($value->engine_size, $min_array_engine, TRUE)) {
          $extra_array[] = "xyz";
        }else {
          $min_array_engine[] = $data_min_engine_size_array[0];
          foreach ($data_min_engine_size_array as $key => $val) {
            $data['min_engine_sizes'][] = $val;
          }
        }
      }

      $array_min_es = array_count_values($data['min_engine_sizes']);
      ksort($array_min_es);
      $data['min_engine_size'] = $array_min_es;

      $data_max_engine_size_array = $this->engineSizeMax($value->engine_size);
      if ($counter == 0){
        $max_array_engine[] = $data_max_engine_size_array[0];
        foreach ($data_max_engine_size_array as $key => $val) {
          $data['max_engine_sizes'][] = $val;
        }
      }else {
        if (in_array($value->engine_size, $max_array_engine, TRUE)) {
          $extra_array[] = "xyz";
        }else {
          $max_array_engine[] = $data_max_engine_size_array[0];
          foreach ($data_max_engine_size_array as $key => $val) {
            $data['max_engine_sizes'][] = $val;
          }
        }
      }

      $array_max_es = array_count_values($data['max_engine_sizes']);
      ksort($array_max_es);
      $data['max_engine_size'] = $array_max_es;

      $data_min_years_array = $this->modelYearDown($value->model_year);

      if ($counter == 0){
        $min_array_year[] = $data_min_years_array[0];
        foreach ($data_min_years_array as $key => $val) {
          $data['min_years'][] = $val;
        }
      }else {
        if (in_array($value->model_year, $min_array_year, TRUE)) {
          $extra_array[] = "xyz";
        }else {
          $min_array_year[] = $data_min_years_array[0];
          foreach ($data_min_years_array as $key => $val) {
            $data['min_years'][] = $val;
          }
        }
      }

      $array_min_yr = array_count_values($data['min_years']);
      krsort($array_min_yr);
      $data['min_year'] = $array_min_yr;

      $data_max_years_array = $this->modelYearUp($value->model_year);

      if ($counter == 0){
        $max_array_year[] = $data_max_years_array[0];
        foreach ($data_max_years_array as $key => $val) {
          $data['max_years'][] = $val;
        }
      }else {
        if (in_array($value->model_year, $max_array_year, TRUE)) {
          $extra_array[] = "xyz";
        }else {
          $max_array_year[] = $data_max_years_array[0];
          foreach ($data_max_years_array as $key => $val) {
            $data['max_years'][] = $val;
          }
        }
      }

      $array_max_yr = array_count_values($data['max_years']);
      krsort($array_max_yr);
      $data['max_year'] = $array_max_yr;

      $counter = $counter + 1;
    }

    $removeKeys = array('category_name', 'models','min_prices','max_prices','body_styles','mileages','min_engine_sizes','max_engine_sizes','fuel_types','gearbox_types','min_years','max_years','number_of_doorss');
    foreach($removeKeys as $key) {
       unset($data[$key]);
    }

    return json_encode($data);
  }

  public function car_attributes_count_home($cars)
  {
    $data = [];
    $min_array_engine = [];
    $max_array_engine = [];
    $min_array_year = [];
    $max_array_year = [];
    $extra_array = [];
    $counter = 0;
    foreach ($cars as $key => $value) {

      $data['category_name'][] = $value->category_name;
      $array_cn = array_count_values($data['category_name']);
      ksort($array_cn);
      $data['category'] = $array_cn;

      $data['models'][] = $value->model;
      $array_mo = array_count_values($data['models']);
      ksort($array_mo);
      $data['model'] = $array_mo;

      $data_min_prices_array = $this->roundDown($value->price, 500, $value->category_name);
      foreach ($data_min_prices_array as $key => $val) {
        $data['min_prices'][] = $val;
      }
      $array_min_pr = array_count_values($data['min_prices']);
      ksort($array_min_pr);
      $data['min_price'] = $array_min_pr;

      $data_max_prices_array = $this->roundUp($value->price, 500, $value->category_name);
      foreach ($data_max_prices_array as $key => $va) {
        $data['max_prices'][] = $va;
      }
      $array_max_pr = array_count_values($data['max_prices']);
      ksort($array_max_pr);
      $data['max_price'] = $array_max_pr;

      $counter = $counter + 1;
    }

    $removeKeys = array('category_name', 'models','min_prices','max_prices','body_styles','mileages','min_engine_sizes','max_engine_sizes','fuel_types','gearbox_types','min_years','max_years','number_of_doorss');
    foreach($removeKeys as $key) {
       unset($data[$key]);
    }

    return json_encode($data);
  }

  public function car_attributes_counted($cars, $make, $model, $min_price, $max_price, $body_style, $mileage, $min_engine_size, $max_engine_size, $fuel_type, $gearbox_type, $min_year, $max_year, $number_of_doors)
  {
    $data = [];
    $min_array_engine = [];
    $max_array_engine = [];
    $min_array_year = [];
    $max_array_year = [];
    $array_mileage = [];
    $extra_array = [];
    $counter = 0;
    foreach ($cars as $key => $value) {

      $data['category_name'][] = $value->category_name;
      $array_cn = array_count_values($data['category_name']);
      ksort($array_cn);
      $data['category'] = $array_cn;

      $data['body_styles'][] = $value->body_style;
      $array_bs = array_count_values($data['body_styles']);
      ksort($array_bs);
      // $this->array_insert( $array_bs, 0, array("Body type (all)" => ""));
      $data['body_style'] = $array_bs;

      $data['models'][] = $value->model;
      $array_mo = array_count_values($data['models']);
      ksort($array_mo);
      $data['model'] = $array_mo;

      $data_min_prices_array = $this->roundDownCounted($value->price, 500, $make, $value->category_name, $model, $value->model, $min_price, $max_price, $value->price, $body_style, $value->body_style, $mileage, $value->mileage, $min_engine_size, $max_engine_size, $value->engine_size, $fuel_type, $value->fuel_type, $gearbox_type, $value->gearbox_type, $max_year, $min_year, $value->model_year, $number_of_doors, $value->number_of_doors);
      foreach ($data_min_prices_array as $key => $val) {
        $data['min_prices'][] = $val;
      }
      $array_min_pr = array_count_values($data['min_prices']);
      ksort($array_min_pr);
      $data['min_price'] = $array_min_pr;

      $data_max_prices_array = $this->roundUpCounted($value->price, 500, $make, $value->category_name, $model, $value->model, $min_price, $max_price, $value->price, $body_style, $value->body_style, $mileage, $value->mileage, $min_engine_size, $max_engine_size, $value->engine_size, $fuel_type, $value->fuel_type, $gearbox_type, $value->gearbox_type, $max_year, $min_year, $value->model_year, $number_of_doors, $value->number_of_doors);
      foreach ($data_max_prices_array as $key => $va) {
        $data['max_prices'][] = $va;
      }
      $array_max_pr = array_count_values($data['max_prices']);
      ksort($array_max_pr);
      $data['max_price'] = $array_max_pr;

      $data_mileage_array = $this->roundUpMileageCounted($value->mileage, 5000, $make, $value->category_name, $model, $value->model, $min_price, $max_price, $value->price, $body_style, $value->body_style, $mileage, $value->mileage, $min_engine_size, $max_engine_size, $value->engine_size, $fuel_type, $value->fuel_type, $gearbox_type, $value->gearbox_type, $max_year, $min_year, $value->model_year, $number_of_doors, $value->number_of_doors);

      if(is_array($data_mileage_array) && count($data_mileage_array) > 0){
        foreach($data_mileage_array as $key => $va){
          $data['mileages'][] = $va;
        }
      }
      else {
        $data['mileages'][] = "";
      }
      // $array_mi = array_count_values($data['mileages']);
      $array_mi = array_count_values(array_filter($data['mileages']));
      ksort($array_mi);
      $data['mileage'] = $array_mi;

      $data['fuel_types'][] = $value->fuel_type;
      $array_ft = array_count_values($data['fuel_types']);
      ksort($array_ft);
      $data['fuel_type'] = $array_ft;

      $data['gearbox_types'][] = $value->gearbox_type;
      $array_gt = array_count_values($data['gearbox_types']);
      ksort($array_gt);
      $data['gearbox_type'] = $array_gt;

      $data['number_of_doorss'][] = $value->number_of_doors;
      $array_nd = array_count_values($data['number_of_doorss']);
      ksort($array_nd);
      $data['number_of_doors'] = $array_nd;

      $data_min_engine_size_array = $this->engineSizeMinCounted($value->engine_size, $make, $value->category_name, $model, $value->model, $min_price, $max_price, $value->price, $body_style, $value->body_style, $mileage, $value->mileage, $min_engine_size, $max_engine_size, $value->engine_size, $fuel_type, $value->fuel_type, $gearbox_type, $value->gearbox_type, $max_year, $min_year, $value->model_year, $number_of_doors, $value->number_of_doors);

      if ($counter == 0){
        $min_array_engine[] = $data_min_engine_size_array[0];
        foreach ($data_min_engine_size_array as $key => $val) {
          $data['min_engine_sizes'][] = $val;
        }
      }else {
        if (in_array($value->engine_size, $min_array_engine, TRUE)) {
          $extra_array[] = "xyz";
        }else {
          $min_array_engine[] = $data_min_engine_size_array[0];
          foreach ($data_min_engine_size_array as $key => $val) {
            $data['min_engine_sizes'][] = $val;
          }
        }
      }

      // if(is_array($data_min_engine_size_array) && count($data_min_engine_size_array) > 0){
      //   foreach($data_min_engine_size_array as $key => $va){
      //     $data['min_engine_sizes'][] = $va;
      //   }
      // }
      // else {
      //   $data['min_engine_sizes'][] = "";
      // }

      $array_min_es = array_count_values(array_filter($data['min_engine_sizes']));
      ksort($array_min_es);
      $data['min_engine_size'] = $array_min_es;

      $data_max_engine_size_array = $this->engineSizeMaxCounted($value->engine_size, $make, $value->category_name, $model, $value->model, $min_price, $max_price, $value->price, $body_style, $value->body_style, $mileage, $value->mileage, $min_engine_size, $max_engine_size, $value->engine_size, $fuel_type, $value->fuel_type, $gearbox_type, $value->gearbox_type, $max_year, $min_year, $value->model_year, $number_of_doors, $value->number_of_doors);
      if ($counter == 0){
        $max_array_engine[] = $data_max_engine_size_array[0];
        foreach ($data_max_engine_size_array as $key => $val) {
          $data['max_engine_sizes'][] = $val;
        }
      }else {
        if (in_array($value->engine_size, $max_array_engine, TRUE)) {
          $extra_array[] = "xyz";
        }else {
          $max_array_engine[] = $data_max_engine_size_array[0];
          foreach ($data_max_engine_size_array as $key => $val) {
            $data['max_engine_sizes'][] = $val;
          }
        }
      }

      // if(is_array($data_max_engine_size_array) && count($data_max_engine_size_array) > 0){
      //   foreach($data_max_engine_size_array as $key => $va){
      //     $data['max_engine_sizes'][] = $va;
      //   }
      // }
      // else {
      //   $data['max_engine_sizes'][] = "";
      // }

      $array_max_es = array_count_values(array_filter($data['max_engine_sizes']));
      ksort($array_max_es);
      $data['max_engine_size'] = $array_max_es;

      $data_min_years_array = $this->modelYearDownCounted($value->model_year, $make, $value->category_name, $model, $value->model, $min_price, $max_price, $value->price, $body_style, $value->body_style, $mileage, $value->mileage, $min_engine_size, $max_engine_size, $value->engine_size, $fuel_type, $value->fuel_type, $gearbox_type, $value->gearbox_type, $max_year, $min_year, $value->model_year, $number_of_doors, $value->number_of_doors);

      // if ($counter == 0){
      //   $min_array_year[] = $data_min_years_array[0];
      //   foreach ($data_min_years_array as $key => $val) {
      //     $data['min_years'][] = $val;
      //   }
      // }else {
      //   if (in_array($value->model_year, $min_array_year, TRUE)) {
      //     $extra_array[] = "xyz";
      //   }else {
      //     $min_array_year[] = $data_min_years_array[0];
      //     foreach ($data_min_years_array as $key => $val) {
      //       $data['min_years'][] = $val;
      //     }
      //   }
      // }

      if(is_array($data_min_years_array) && count($data_min_years_array) > 0){
        foreach($data_min_years_array as $key => $va){
          $data['min_years'][] = $va;
        }
      }
      else {
        $data['min_years'][] = "";
      }

      $array_min_yr = array_count_values(array_filter($data['min_years']));
      krsort($array_min_yr);
      $data['min_year'] = $array_min_yr;

      $data_max_years_array = $this->modelYearUpCounted($value->model_year, $make, $value->category_name, $model, $value->model, $min_price, $max_price, $value->price, $body_style, $value->body_style, $mileage, $value->mileage, $min_engine_size, $max_engine_size, $value->engine_size, $fuel_type, $value->fuel_type, $gearbox_type, $value->gearbox_type, $max_year, $min_year, $value->model_year, $number_of_doors, $value->number_of_doors);

      // if ($counter == 0){
      //   $max_array_year[] = $data_max_years_array[0];
      //   foreach ($data_max_years_array as $key => $val) {
      //     $data['max_years'][] = $val;
      //   }
      // }else {
      //   if (in_array($value->model_year, $max_array_year, TRUE)) {
      //     $extra_array[] = "xyz";
      //   }else {
      //     $max_array_year[] = $data_max_years_array[0];
      //     foreach ($data_max_years_array as $key => $val) {
      //       $data['max_years'][] = $val;
      //     }
      //   }
      // }

      if(is_array($data_max_years_array) && count($data_max_years_array) > 0){
        foreach($data_max_years_array as $key => $va){
          $data['max_years'][] = $va;
        }
      }
      else {
        $data['max_years'][] = "";
      }

      $array_max_yr = array_count_values(array_filter($data['max_years']));
      krsort($array_max_yr);
      $data['max_year'] = $array_max_yr;

      $counter = $counter + 1;
    }

    $removeKeys = array('category_name', 'models','min_prices','max_prices','body_styles','mileages','min_engine_sizes','max_engine_sizes','fuel_types','gearbox_types','min_years','max_years','number_of_doorss');
    foreach($removeKeys as $key) {
       unset($data[$key]);
    }

    return json_encode($data);
  }

  public function car_attributes_counted_home($cars, $make, $model, $min_price, $max_price)
  {
    $data = [];
    $min_array_engine = [];
    $max_array_engine = [];
    $min_array_year = [];
    $max_array_year = [];
    $array_mileage = [];
    $extra_array = [];
    $counter = 0;
    foreach ($cars as $key => $value) {

      $data['category_name'][] = $value->category_name;
      $array_cn = array_count_values($data['category_name']);
      ksort($array_cn);
      $data['category'] = $array_cn;

      $data['models'][] = $value->model;
      $array_mo = array_count_values($data['models']);
      ksort($array_mo);
      $data['model'] = $array_mo;

      $data_min_prices_array = $this->roundDownCountedHome($value->price, 500, $make, $value->category_name, $model, $value->model, $min_price, $max_price, $value->price);
      foreach ($data_min_prices_array as $key => $val) {
        $data['min_prices'][] = $val;
      }
      $array_min_pr = array_count_values($data['min_prices']);
      ksort($array_min_pr);
      $data['min_price'] = $array_min_pr;

      $data_max_prices_array = $this->roundUpCountedHome($value->price, 500, $make, $value->category_name, $model, $value->model, $min_price, $max_price, $value->price);
      foreach ($data_max_prices_array as $key => $va) {
        $data['max_prices'][] = $va;
      }
      $array_max_pr = array_count_values($data['max_prices']);
      ksort($array_max_pr);
      $data['max_price'] = $array_max_pr;

      $counter = $counter + 1;
    }

    $removeKeys = array('category_name', 'models','min_prices','max_prices');
    foreach($removeKeys as $key) {
       unset($data[$key]);
    }

    return json_encode($data);
  }

  public function roundUpCounted($num, $divisor, $make, $category_name, $model, $model_name, $min_price, $max_price, $price_name, $body_style, $body_style_name, $mileage, $mileage_name, $min_engine_size, $max_engine_size, $engine_size_name, $fuel_type, $fuel_type_name, $gearbox_type, $gearbox_type_name, $max_year, $min_year, $model_year_name, $number_of_doors, $number_of_doors_name) {
    $diff = $num % $divisor;
    if ($diff == 0)
      return $num;
    else
      $actual_unum = $num - $diff + $divisor;
      $category = Category::where('category_name', '=', $category_name)->first();
      $cars = DB::table('cars');
      if($make != 'make')
        $cars->where('category_id', '=', $category->id);
      if($model != 'model')
        $cars->where('model', '=', $model_name);
      // if($min_price != "min-price")
      //   $cars->where('price', '>', $price_name);
      // if($max_price != "max-price")
      //   $cars->where('price', '<', $price_name);
      if($body_style != "body-type")
        $cars->where('body_style', '=', $body_style_name);
      if($mileage != "mileage")
        $cars->where('mileage', '<=', $mileage_name);
      if($min_engine_size != "min-engine-size")
        $cars->where('engine_size', '>=', $engine_size_name);
      if($max_engine_size != "max-engine-size")
        $cars->where('engine_size', '<=', $engine_size_name);
      if($fuel_type != "fuel-type")
        $cars->where('fuel_type', '=', $fuel_type_name);
      if($gearbox_type != "gearbox-type")
        $cars->where('gearbox_type', '=', $gearbox_type_name);
      if($min_year != "min-year")
        $cars->where('model_year', '>=', $model_year_name);
      if($max_year != "max-year")
        $cars->where('model_year', '<=', $model_year_name);
      if($number_of_doors != "number-of-doors")
        $cars->where('number_of_doors', '=', $number_of_doors_name);

      $cars = $cars->where('price', '<=', $actual_unum)
      ->get()
      ->toArray();
      $arrayPrice = array();
      for ($i=0; $i < count($cars); $i++) {
        array_push($arrayPrice, $actual_unum);
      }
      return $arrayPrice;
  }

  public function roundUpCountedHome($num, $divisor, $make, $category_name, $model, $model_name, $min_price, $max_price, $price_name) {
    $diff = $num % $divisor;
    if ($diff == 0)
      return $num;
    else
      $actual_unum = $num - $diff + $divisor;
      $category = Category::where('category_name', '=', $category_name)->first();
      $cars = DB::table('cars');
      if($make != 'make')
        $cars->where('category_id', '=', $category->id);
      if($model != 'model')
        $cars->where('model', '=', $model_name);
      // if($min_price != "min-price")
      //   $cars->where('price', '>', $price_name);
      // if($max_price != "max-price")
      //   $cars->where('price', '<', $price_name);

      $cars = $cars->where('price', '<=', $actual_unum)
      ->get()
      ->toArray();
      $arrayPrice = array();
      for ($i=0; $i < count($cars); $i++) {
        array_push($arrayPrice, $actual_unum);
      }
      return $arrayPrice;
  }

  public function roundDownCounted($num, $divisor, $make, $category_name, $model, $model_name, $min_price, $max_price, $price_name, $body_style, $body_style_name, $mileage, $mileage_name, $min_engine_size, $max_engine_size, $engine_size_name, $fuel_type, $fuel_type_name, $gearbox_type, $gearbox_type_name, $max_year, $min_year, $model_year_name, $number_of_doors, $number_of_doors_name) {
    $diff = $num % $divisor;
    $actual_num = $num - $diff;
    $category = Category::where('category_name', '=', $category_name)->first();
    $cars = DB::table('cars');
    if($make != 'make')
      $cars->where('category_id', '=', $category->id);
    if($model != 'model')
      $cars->where('model', '=', $model_name);
    // if($min_price != "min-price")
    //   $cars->where('price', '>', $price_name);
    // if($max_price != "max-price")
    //   $cars->where('price', '<', $price_name);
    if($body_style != "body-type")
      $cars->where('body_style', '=', $body_style_name);
    if($mileage != "mileage")
      $cars->where('mileage', '<=', $mileage_name);
    if($min_engine_size != "min-engine-size")
      $cars->where('engine_size', '>=', $engine_size_name);
    if($max_engine_size != "max-engine-size")
      $cars->where('engine_size', '<=', $engine_size_name);
    if($fuel_type != "fuel-type")
      $cars->where('fuel_type', '=', $fuel_type_name);
    if($gearbox_type != "gearbox-type")
      $cars->where('gearbox_type', '=', $gearbox_type_name);
    if($min_year != "min-year")
      $cars->where('model_year', '>=', $model_year_name);
    if($max_year != "max-year")
      $cars->where('model_year', '<=', $model_year_name);
    if($number_of_doors != "number-of-doors")
      $cars->where('number_of_doors', '=', $number_of_doors_name);

    $cars = $cars->where('price', '>=', $actual_num)
    ->get()
    ->toArray();
    $arrayPrice = array();
    for ($i=0; $i < count($cars); $i++) {
      array_push($arrayPrice, $actual_num);
    }
    return $arrayPrice;
  }

  public function roundDownCountedHome($num, $divisor, $make, $category_name, $model, $model_name, $min_price, $max_price, $price_name) {
    $diff = $num % $divisor;
    $actual_num = $num - $diff;
    $category = Category::where('category_name', '=', $category_name)->first();
    $cars = DB::table('cars');
    if($make != 'make')
      $cars->where('category_id', '=', $category->id);
    if($model != 'model')
      $cars->where('model', '=', $model_name);
    // if($min_price != "min-price")
    //   $cars->where('price', '>', $price_name);
    // if($max_price != "max-price")
    //   $cars->where('price', '<', $price_name);

    $cars = $cars->where('price', '>=', $actual_num)
    ->get()
    ->toArray();
    $arrayPrice = array();
    for ($i=0; $i < count($cars); $i++) {
      array_push($arrayPrice, $actual_num);
    }
    return $arrayPrice;
  }

  public function roundUpMileageCounted($num, $divisor, $make, $category_name, $model, $model_name, $min_price, $max_price, $price_name, $body_style, $body_style_name, $mileage, $mileage_name, $min_engine_size, $max_engine_size, $engine_size_name, $fuel_type, $fuel_type_name, $gearbox_type, $gearbox_type_name, $max_year, $min_year, $model_year_name, $number_of_doors, $number_of_doors_name) {
    $diff = $num % $divisor;
    if ($diff == 0)
      return $num;
    else
      $actual_unum = $num - $diff + $divisor;
      $category = Category::where('category_name', '=', $category_name)->first();
      $cars = DB::table('cars');
      if($make != 'make')
        $cars->where('category_id', '=', $category->id);
      if($model != 'model')
        $cars->where('model', '=', $model_name);
      if($min_price != "min-price")
        $cars->where('price', '>', $price_name);
      if($max_price != "max-price")
        $cars->where('price', '<', $price_name);
      if($body_style != "body-type")
        $cars->where('body_style', '=', $body_style_name);
      // if($mileage != "mileage")
      //   $cars->where('mileage', '<=', $mileage_name);
      if($min_engine_size != "min-engine-size")
        $cars->where('engine_size', '>=', $engine_size_name);
      if($max_engine_size != "max-engine-size")
        $cars->where('engine_size', '<=', $engine_size_name);
      if($fuel_type != "fuel-type")
        $cars->where('fuel_type', '=', $fuel_type_name);
      if($gearbox_type != "gearbox-type")
        $cars->where('gearbox_type', '=', $gearbox_type_name);
      if($min_year != "min-year")
        $cars->where('model_year', '>=', $model_year_name);
      if($max_year != "max-year")
        $cars->where('model_year', '<=', $model_year_name);
      if($number_of_doors != "number-of-doors")
        $cars->where('number_of_doors', '=', $number_of_doors_name);

      $cars = $cars->where('mileage', '<=', $actual_unum)
      ->get()
      ->toArray();
      $arrayMileage = array();
      for ($i=0; $i < count($cars); $i++) {
        array_push($arrayMileage, $actual_unum);
      }
      return $arrayMileage;
  }

  public function modelYearUpCounted($value, $make, $category_name, $model, $model_name, $min_price, $max_price, $price_name, $body_style, $body_style_name, $mileage, $mileage_name, $min_engine_size, $max_engine_size, $engine_size_name, $fuel_type, $fuel_type_name, $gearbox_type, $gearbox_type_name, $max_year, $min_year, $model_year_name, $number_of_doors, $number_of_doors_name)
  {
    $category = Category::where('category_name', '=', $category_name)->first();
    $cars = DB::table('cars');
    if($make != 'make')
      $cars->where('category_id', '=', $category->id);
    if($model != 'model')
      $cars->where('model', '=', $model_name);
    if($min_price != "min-price")
      $cars->where('price', '>', $price_name);
    if($max_price != "max-price")
      $cars->where('price', '<', $price_name);
    if($body_style != "body-type")
      $cars->where('body_style', '=', $body_style_name);
    if($mileage != "mileage")
      $cars->where('mileage', '<=', $mileage_name);
    if($min_engine_size != "min-engine-size")
      $cars->where('engine_size', '>=', $engine_size_name);
    if($max_engine_size != "max-engine-size")
      $cars->where('engine_size', '<=', $engine_size_name);
    if($fuel_type != "fuel-type")
      $cars->where('fuel_type', '=', $fuel_type_name);
    if($gearbox_type != "gearbox-type")
      $cars->where('gearbox_type', '=', $gearbox_type_name);
    // if($min_year != "min-year")
    //   $cars->where('cars.model_year', '>=', $min_year);
    // if($max_year != "max-year")
    //   $cars->where('cars.model_year', '<=', $max_year);
    if($number_of_doors != "number-of-doors")
      $cars->where('number_of_doors', '=', $number_of_doors_name);

    $cars = $cars->where('model_year', '<=', $value)
    ->get()
    ->toArray();
    $arrayYear = array();
    for ($i=0; $i < count($cars); $i++) {
      array_push($arrayYear, $value);
    }
    return $arrayYear;
  }

  public function modelYearDownCounted($value, $make, $category_name, $model, $model_name, $min_price, $max_price, $price_name, $body_style, $body_style_name, $mileage, $mileage_name, $min_engine_size, $max_engine_size, $engine_size_name, $fuel_type, $fuel_type_name, $gearbox_type, $gearbox_type_name, $max_year, $min_year, $model_year_name, $number_of_doors, $number_of_doors_name)
  {
    $category = Category::where('category_name', '=', $category_name)->first();
    $cars = DB::table('cars');
    if($make != 'make')
      $cars->where('category_id', '=', $category->id);
    if($model != 'model')
      $cars->where('model', '=', $model_name);
    if($min_price != "min-price")
      $cars->where('price', '>', $price_name);
    if($max_price != "max-price")
      $cars->where('price', '<', $price_name);
    if($body_style != "body-type")
      $cars->where('body_style', '=', $body_style_name);
    if($mileage != "mileage")
      $cars->where('mileage', '<=', $mileage_name);
    if($min_engine_size != "min-engine-size")
      $cars->where('engine_size', '>=', $engine_size_name);
    if($max_engine_size != "max-engine-size")
      $cars->where('engine_size', '<=', $engine_size_name);
    if($fuel_type != "fuel-type")
      $cars->where('fuel_type', '=', $fuel_type_name);
    if($gearbox_type != "gearbox-type")
      $cars->where('gearbox_type', '=', $gearbox_type_name);
    // if($min_year != "min-year")
    //   $cars->where('cars.model_year', '>=', $min_year);
    // if($max_year != "max-year")
    //   $cars->where('cars.model_year', '<=', $max_year);
    if($number_of_doors != "number-of-doors")
      $cars->where('number_of_doors', '=', $number_of_doors_name);

    $cars = $cars->where('model_year', '>=', $value)
    ->get()
    ->toArray();
    $arrayYear = array();
    for ($i=0; $i < count($cars); $i++) {
      array_push($arrayYear, $value);
    }
    return $arrayYear;
  }

  public function engineSizeMinCounted($value, $make, $category_name, $model, $model_name, $min_price, $max_price, $price_name, $body_style, $body_style_name, $mileage, $mileage_name, $min_engine_size, $max_engine_size, $engine_size_name, $fuel_type, $fuel_type_name, $gearbox_type, $gearbox_type_name, $max_year, $min_year, $model_year_name, $number_of_doors, $number_of_doors_name) {
    $category = Category::where('category_name', '=', $category_name)->first();
    $cars = DB::table('cars');
    if($make != 'make')
      $cars->where('category_id', '=', $category->id);
    if($model != 'model')
      $cars->where('model', '=', $model_name);
    if($min_price != "min-price")
      $cars->where('price', '>', $price_name);
    if($max_price != "max-price")
      $cars->where('price', '<', $price_name);
    if($body_style != "body-type")
      $cars->where('body_style', '=', $body_style_name);
    if($mileage != "mileage")
      $cars->where('mileage', '<=', $mileage_name);
    // if($min_engine_size != "min-engine-size")
    //   $cars->where('cars.engine_size', '>=', $min_engine_size);
    // if($max_engine_size != "max-engine-size")
    //   $cars->where('cars.engine_size', '<=', $max_engine_size);
    if($fuel_type != "fuel-type")
      $cars->where('fuel_type', '=', $fuel_type_name);
    if($gearbox_type != "gearbox-type")
      $cars->where('gearbox_type', '=', $gearbox_type_name);
    if($min_year != "min-year")
      $cars->where('model_year', '>=', $model_year_name);
    if($max_year != "max-year")
      $cars->where('model_year', '<=', $model_year_name);
    if($number_of_doors != "number-of-doors")
      $cars->where('number_of_doors', '=', $number_of_doors_name);

    $cars = $cars->where('engine_size', '>=', $value)
    ->get()
    ->toArray();
    $arrayEngineSize = array();
    for ($i=0; $i < count($cars); $i++) {
      array_push($arrayEngineSize, $value);
    }
    return $arrayEngineSize;
  }

  public function engineSizeMaxCounted($value, $make, $category_name, $model, $model_name, $min_price, $max_price, $price_name, $body_style, $body_style_name, $mileage, $mileage_name, $min_engine_size, $max_engine_size, $engine_size_name, $fuel_type, $fuel_type_name, $gearbox_type, $gearbox_type_name, $max_year, $min_year, $model_year_name, $number_of_doors, $number_of_doors_name) {
    $category = Category::where('category_name', '=', $category_name)->first();
    $cars = DB::table('cars');
    if($make != 'make')
      $cars->where('category_id', '=', $category->id);
    if($model != 'model')
      $cars->where('model', '=', $model_name);
    if($min_price != "min-price")
      $cars->where('price', '>', $price_name);
    if($max_price != "max-price")
      $cars->where('price', '<', $price_name);
    if($body_style != "body-type")
      $cars->where('body_style', '=', $body_style_name);
    if($mileage != "mileage")
      $cars->where('mileage', '<=', $mileage_name);
    // if($min_engine_size != "min-engine-size")
    //   $cars->where('cars.engine_size', '>=', $min_engine_size);
    // if($max_engine_size != "max-engine-size")
    //   $cars->where('cars.engine_size', '<=', $max_engine_size);
    if($fuel_type != "fuel-type")
      $cars->where('fuel_type', '=', $fuel_type_name);
    if($gearbox_type != "gearbox-type")
      $cars->where('gearbox_type', '=', $gearbox_type_name);
    if($min_year != "min-year")
      $cars->where('model_year', '>=', $model_year_name);
    if($max_year != "max-year")
      $cars->where('model_year', '<=', $model_year_name);
    if($number_of_doors != "number-of-doors")
      $cars->where('number_of_doors', '=', $number_of_doors_name);

    $cars = $cars->where('engine_size', '<=', $value)
    ->get()
    ->toArray();
    $arrayEngineSize = array();
    for ($i=0; $i < count($cars); $i++) {
      array_push($arrayEngineSize, $value);
    }
    return $arrayEngineSize;
  }

  public function roundUp($num, $divisor, $category_name) {
    $diff = $num % $divisor;
    if ($diff == 0)
      return $num;
    else
      $actual_unum = $num - $diff + $divisor;
      $cars = DB::table('cars')
              ->where('price', '<=', $actual_unum)
              ->get()
              ->toArray();
      $arrayPrice = array();
      for ($i=0; $i < count($cars); $i++) {
        array_push($arrayPrice, $actual_unum);
      }
      return $arrayPrice;
  }

  public function roundUpMileage($num, $divisor, $category_name) {
    $diff = $num % $divisor;
    if ($diff == 0)
      return $num;
    else
      $actual_unum = $num - $diff + $divisor;
      $cars = DB::table('cars')
              ->where('mileage', '<=', $actual_unum)
              ->get()
              ->toArray();
      $arrayMileage = array();
      for ($i=0; $i < count($cars); $i++) {
        array_push($arrayMileage, $actual_unum);
      }
      return $arrayMileage;
  }

  public function roundDown($num, $divisor, $category_name) {
    $diff = $num % $divisor;
    $actual_num = $num - $diff;
    $cars = DB::table('cars')
    ->where('price', '>=', $actual_num)
    ->get()
    ->toArray();
    $arrayPrice = array();
    for ($i=0; $i < count($cars); $i++) {
      array_push($arrayPrice, $actual_num);
    }
    return $arrayPrice;
  }

  public function modelYearUp($value)
  {
    $cars = DB::table('cars')
            ->where('model_year', '<=', $value)
            ->get()
            ->toArray();
    $arrayYear = array();
    for ($i=0; $i < count($cars); $i++) {
      array_push($arrayYear, $value);
    }
    return $arrayYear;
  }

  public function modelYearDown($value)
  {
    $cars = DB::table('cars')
            ->where('model_year', '>=', $value)
            ->get()
            ->toArray();
    $arrayYear = array();
    for ($i=0; $i < count($cars); $i++) {
      array_push($arrayYear, $value);
    }
    return $arrayYear;
  }

  public function engineSizeMin($value) {
    $cars = DB::table('cars')
    ->where('engine_size', '>=', $value)
    ->get()
    ->toArray();
    $arrayEngineSize = array();
    for ($i=0; $i < count($cars); $i++) {
      array_push($arrayEngineSize, $value);
    }
    return $arrayEngineSize;
  }

  public function engineSizeMax($value) {
    $cars = DB::table('cars')
    ->where('engine_size', '<=', $value)
    ->get()
    ->toArray();
    $arrayEngineSize = array();
    for ($i=0; $i < count($cars); $i++) {
      array_push($arrayEngineSize, $value);
    }
    return $arrayEngineSize;
  }

  public function array_insert (&$array, $position, $insert_array) {
    $first_array = array_splice ($array, 0, $position);
    $array = array_merge ($first_array, $insert_array, $array);
  }

  public function search_car_results(Request $request)
  {
    $sort_type = 'price';
    $sort = "asc";
    if($request->sort == ""){
      $sort = "asc";
    }elseif ($request->sort == "desc") {
      $sort_type = 'price';
      $sort = "desc";
    }elseif ($request->sort == "age") {
      $sort_type = 'model_year';
      $sort = "desc";
    }elseif ($request->sort == "mileage") {
      $sort_type = 'mileage';
      $sort = "asc";
    }else {
      $sort_type = 'price';
      $sort = "asc";
    }

    if($request->make == ""){
      $make = "make";
    }else {
      $make = str_replace("-", " ", $request->make);
    }

    if($request->model == ""){
      $model = "model";
    }else {
      $model = str_replace("-", " ", $request->model);
    }

    if($request->min_price == ""){
      $min_price = "min-price";
    }else {
      $min_price = str_replace("-", " ", $request->min_price);
    }

    if($request->max_price == ""){
      $max_price = "max-price";
    }else {
      $max_price = str_replace("-", " ", $request->max_price);
    }

    if($request->body_style == ""){
      $body_style = "body-type";
    }else {
      $body_style = str_replace("-", " ", $request->body_style);
    }

    if($request->mileage == ""){
      $mileage = "mileage";
    }else {
      $mileage = str_replace("-", " ", $request->mileage);
    }

    if($request->min_engine_size == ""){
      $min_engine_size = "min-engine-size";
    }else {
      $min_engine_size = str_replace("-", " ", $request->min_engine_size);
    }

    if($request->max_engine_size == ""){
      $max_engine_size = "max-engine-size";
    }else {
      $max_engine_size = str_replace("-", " ", $request->max_engine_size);
    }

    if($request->fuel_type == ""){
      $fuel_type = "fuel-type";
    }else {
      $fuel_type = str_replace("-", " ", $request->fuel_type);
    }

    if($request->gearbox_type == ""){
      $gearbox_type = "gearbox-type";
    }else {
      $gearbox_type = str_replace("-", " ", $request->gearbox_type);
    }

    if($request->min_year == ""){
      $min_year = "min-year";
    }else {
      $min_year = str_replace("-", " ", $request->min_year);
    }

    if($request->max_year == ""){
      $max_year = "max-year";
    }else {
      $max_year = str_replace("-", " ", $request->max_year);
    }

    if($request->number_of_doors == ""){
      $number_of_doors = "number-of-doors";
    }else {
      $number_of_doors = str_replace("-", " ", $request->number_of_doors);
    }

    $category = Category::where('category_name', '=', $make)->first();
    $cars = DB::table('cars')
            ->leftJoin('categories', 'categories.id', '=', 'cars.category_id')
            ->select('cars.*', 'categories.category_name');
    if($make != "make")
      $cars->where('cars.category_id', '=', $category->id);
    if($model != "model")
      $cars->where('cars.model', '=', $model);
    if($min_price != "min-price")
      $cars->where('cars.price', '>', $min_price);
    if($max_price != "max-price")
      $cars->where('cars.price', '<', $max_price);
    if($body_style != "body-type")
      $cars->where('cars.body_style', '=', $body_style);
    if($mileage != "mileage")
      $cars->where('cars.mileage', '<=', $mileage);
    if($min_engine_size != "min-engine-size")
      $cars->where('cars.engine_size', '>=', $min_engine_size);
    if($max_engine_size != "max-engine-size")
      $cars->where('cars.engine_size', '<=', $max_engine_size);
    if($fuel_type != "fuel-type")
      $cars->where('cars.fuel_type', '=', $fuel_type);
    if($gearbox_type != "gearbox-type")
      $cars->where('cars.gearbox_type', '=', $gearbox_type);
    if($min_year != "min-year")
      $cars->where('cars.model_year', '>=', $min_year);
    if($max_year != "max-year")
      $cars->where('cars.model_year', '<=', $max_year);
    if($number_of_doors != "number-of-doors")
      $cars->where('cars.number_of_doors', '=', $number_of_doors);

    $list_cars = $cars->orderBy($sort_type, $sort)->get();

    $total_cars = DB::table('cars')
          ->leftJoin('categories', 'categories.id', '=', 'cars.category_id')
          ->select('cars.*', 'categories.category_name')
          ->count();

    if(count($list_cars) == $total_cars){
      $list_cars = DB::table('cars')
            ->leftJoin('categories', 'categories.id', '=', 'cars.category_id')
            ->select('cars.*', 'categories.category_name')
            ->orderBy($sort_type, $sort)
            ->get()
            ->toArray();
            $cars = $this->car_attributes_count($list_cars);
    }else {
      $cars = $this->car_attributes_counted($list_cars, $make, $model, $min_price, $max_price, $body_style, $mileage, $min_engine_size, $max_engine_size, $fuel_type, $gearbox_type, $min_year, $max_year, $number_of_doors);
    }

    $categories = Category::orderBy('category_name','asc')->get();

    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $itemCollection = collect($list_cars);
    $perPage = 10;
    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
    $paginatedItems->setPath($request->url());
    return view('website.search_engine', [
      'sort' => $sort,
      'sort_type' => $sort_type,
      'make' => $make,
      'model' => $model,
      'min_price' => $min_price,
      'max_price' => $max_price,
      'body_style' => $body_style,
      'mileage' => $mileage,
      'min_engine_size' => $min_engine_size,
      'max_engine_size' => $max_engine_size,
      'fuel_type' => $fuel_type,
      'gearbox_type' => $gearbox_type,
      'min_year' => $min_year,
      'max_year' => $max_year,
      'number_of_doors' => $number_of_doors,
      'list_cars' => $paginatedItems,
      'cars' => $cars
    ]);
  }

  public function car_details_page($name)
  {
    $arr = explode('_', $name);
    $car_id = $arr[1];
    $car_detail = DB::table('cars')
    ->leftJoin('categories', 'categories.id', '=', 'cars.category_id')
    ->select('cars.*', 'categories.category_name')
    ->where('cars.id', '=', $car_id)
    ->first();

    $vehicle_summaries = DB::table('vehicle_summaries')->where('car_id', '=', $car_id)->first();
    if($vehicle_summaries != null){
      foreach ($vehicle_summaries as $key => $value) {
        $vehicle_summaries_array[$key] = $value;
      }
    }else {
      $vehicle_summaries_array = null;
    }

    $performance_economies = DB::table('performance_economies')->where('car_id', '=', $car_id)->first();
    if($performance_economies != null){
      foreach ($performance_economies as $key => $value) {
        $performance_economies_array[$key] = $value;
      }
    }else {
      $performance_economies_array = null;
    }

    $dimension = DB::table('dimensions')->where('car_id', '=', $car_id)->first();
    if($dimension != null){
      foreach ($dimension as $key => $value) {
        $dimension_array[$key] = $value;
      }
    }else {
      $dimension_array = null;
    }

    $exterior_features = DB::table('exterior_features')->select('exterior_features.exterior_feature_list')->where('car_id', '=', $car_id)->get()->toArray();
    if(count($exterior_features) == 0){
      $exterior_features_array = null;
    }else {
      foreach ($exterior_features as $key => $value) {
        $exterior_features_array[] = $value->exterior_feature_list;
      }
    }

    $interior_features = DB::table('interior_features')->select('interior_features.interior_feature_list')->where('car_id', '=', $car_id)->get()->toArray();
    if(count($interior_features) == 0){
      $interior_features_array = null;
    }else {
      foreach ($interior_features as $key => $value) {
        $interior_features_array[] = $value->interior_feature_list;
      }
    }

    $safeties = DB::table('safeties')->select('safeties.safety_list')->where('car_id', '=', $car_id)->get()->toArray();
    if(count($safeties) == 0){
      $safeties_array = null;
    }else {
      foreach ($safeties as $key => $value) {
        $safeties_array[] = $value->safety_list;
      }
    }

    $car_images = DB::table('car_images')->select('car_images.image_url')->where('car_id', '=', $car_id)->get()->toArray();
    if(count($car_images) == 0){
      $car_images_array = null;
    }else {
      foreach ($car_images as $key => $value) {
        $car_images_array[] = $value->image_url;
      }
    }

    $car_detail->dimension = $dimension_array;
    $car_detail->performance_economies = $performance_economies_array;
    $car_detail->exterior_features = $exterior_features_array;
    $car_detail->interior_features = $interior_features_array;
    $car_detail->safeties = $safeties_array;
    $car_detail->vehicle_summaries = $vehicle_summaries_array;
    $car_detail->car_images = $car_images_array;

    return view('website.car_detail_page', ['car_detail' => $car_detail]);
  }

  public function send_test_email()
  {
    $data = ['message' => 'triple apple', 'useremail' => 'hworkpk@gmail.com', 'username' => 'Jason Doe', 'subject' => 'Autohaven Contact'];

    Mail::to('hworkpk@gmail.com')->queue(new TestEmail($data));
    // Mail::send('emails.test', ['data' => $data], function ($message) use ($data) {
    //     $message->from($data['useremail'], $data['username']);
    //     $message->to('fayyaz@cospace.pk' , 'Autohaven Motors')->subject($data['subject']);
    // });

    return "mail send successfully";
  }

  public function sell_your_car()
  {
    return view('website.sell_your_car');
  }

  public function store_sell_your_car(Request $request)
  {
    $rules = array(
      'vehicle_reg' => 'required',
      'mileage' => 'required',
      'full_name' => 'required',
      'email_address' => 'required',
      'phone_number' => 'required',
    );

    $error = Validator::make($request->all(), $rules);
    if($error->fails()){
      return response()->json(['errors' => $error->errors()->all()]);
    }else{
      $id = uniqid();

      $form_data = array(
        'id' => $id,
        'vehicle_type' => $request->vehicle_type,
        'company' => $request->company,
        'model' => $request->model,
        'vehicle_reg' => $request->vehicle_reg,
        'mileage' => $request->mileage,
        'service_history' => $request->service_history,
        'vehicle_come_with_specify' => $request->vehicle_come_with_specify,
        'vehicle_condition' => $request->vehicle_condition,
        'vehicle_damage_condition_description' => $request->vehicle_damage_condition_description,
        'full_name' => $request->full_name,
        'phone_number' => $request->phone_number,
        'email_address' => $request->email_address
      );
      $sell_your_car = SellYourVehicle::create($form_data);

      Mail::to('hworkpk@gmail.com')->queue(new SellYourVehicleEmail($form_data));

      if( count(Mail::failures()) > 0 ) {
        $failures_array = array();
        foreach(Mail::failures as $email_address) {
          $failures_array[] = $email_address;
          return response()->json(['failure' => $failures_array], 500);
        }
      } else {
        return response()->json(['success' => 'Thanks for contact with us.'], 200);
      }
    }
  }

  public function store_part_exchange(Request $request)
  {
    $rules = array(
      'vehicle_reg' => 'required',
      'mileage' => 'required',
      'full_name' => 'required',
      'email_address' => 'required',
      'phone_number' => 'required',
    );

    $error = Validator::make($request->all(), $rules);
    if($error->fails()){
      return response()->json(['errors' => $error->errors()->all()]);
    }else{
      $id = uniqid();

      $form_data = array(
        'id' => $id,
        'vehicle_type' => $request->vehicle_type,
        'company' => $request->company,
        'model' => $request->model,
        'vehicle_reg' => $request->vehicle_reg,
        'mileage' => $request->mileage,
        'condition' => $request->condition,
        'full_name' => $request->full_name,
        'phone_number' => $request->phone_number,
        'email_address' => $request->email_address,
        'best_time_to_call' => $request->best_time_to_call
      );
      $sell_your_car = PartExchange::create($form_data);

      Mail::to('hworkpk@gmail.com')->queue(new PartExchangeEmail($form_data));

      if( count(Mail::failures()) > 0 ) {
        $failures_array = array();
        foreach(Mail::failures as $email_address) {
          $failures_array[] = $email_address;
          return response()->json(['failure' => $failures_array], 500);
        }
      } else {
        return response()->json(['success' => 'Thanks for contact with us.'], 200);
      }
    }
  }

  public function store_contact_us_form(Request $request)
  {
    $rules = array(
      'name' => 'required',
      'email' => 'required',
      'phone' => 'required',
    );

    $error = Validator::make($request->all(), $rules);
    if($error->fails()){
      return response()->json(['errors' => $error->errors()->all()]);
    }else{
      $id = uniqid();

      $form_data = array(
        'id' => $id,
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
        'info_message' => $request->info_message
      );
      $contact = Contact::create($form_data);

      Mail::to('hworkpk@gmail.com')->queue(new ContactEmail($form_data));

      if( count(Mail::failures()) > 0 ) {
        $failures_array = array();
        foreach(Mail::failures as $email_address) {
          $failures_array[] = $email_address;
          return response()->json(['failure' => $failures_array], 500);
        }
      } else {
        return response()->json(['success' => 'Thank you for contacting us!'], 200);
      }
    }
  }

  public function store_finance_form(Request $request)
  {
    $rules = array(
      'name' => 'required',
      'email' => 'required',
      'phone' => 'required',
    );

    $error = Validator::make($request->all(), $rules);
    if($error->fails()){
      return response()->json(['errors' => $error->errors()->all()]);
    }else{
      $id = uniqid();

      $form_data = array(
        'id' => $id,
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
        'info_message' => $request->info_message
      );
      $finance = Finance::create($form_data);

      Mail::to('hworkpk@gmail.com')->queue(new FinanceEmail($form_data));

      if( count(Mail::failures()) > 0 ) {
        $failures_array = array();
        foreach(Mail::failures as $email_address) {
          $failures_array[] = $email_address;
          return response()->json(['failure' => $failures_array], 500);
        }
      } else {
        return response()->json(['success' => 'Thank you for contacting us!'], 200);
      }
    }
  }

  public function store_enquiry_form(Request $request)
  {
    $rules = array(
      'car_id' => 'required',
      'name' => 'required',
      'email' => 'required',
      'phone' => 'required',
    );

    $error = Validator::make($request->all(), $rules);
    if($error->fails()){
      return response()->json(['errors' => $error->errors()->all()]);
    }else{
      $id = uniqid();

      $form_data = array(
        'id' => $id,
        'car_id' => $request->car_id,
        'category_name' => $request->category_name,
        'model' => $request->model,
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
        'info_message' => $request->info_message
      );
      $enquiry = CarEnquiry::create($form_data);

      Mail::to('hworkpk@gmail.com')->queue(new EnquiryEmail($form_data));

      if( count(Mail::failures()) > 0 ) {
        $failures_array = array();
        foreach(Mail::failures as $email_address) {
          $failures_array[] = $email_address;
          return response()->json(['failure' => $failures_array], 500);
        }
      } else {
        return response()->json(['success' => 'Thank you for contacting us!'], 200);
      }
    }
  }

  public function store_review_form(Request $request)
  {
    $rules = array(
      'rating_number' => 'required',
      'rating_title' => 'required',
      'rating_desc' => 'required',
      'email' => 'required',
      'full_name' => 'required',
    );

    $error = Validator::make($request->all(), $rules);
    if($error->fails()){
      return response()->json(['errors' => $error->errors()->all()]);
    }else{
      $id = uniqid();

      $confirmed = 0;
      if($request->confirmed == 'confirmed'){
        $confirmed = 1;
      }

      $form_data = array(
        'id' => $id,
        'rating_number' => $request->rating_number,
        'rating_title' => $request->rating_title,
        'rating_desc' => $request->rating_desc,
        'email' => $request->email,
        'full_name' => $request->full_name,
        'confirm' => $confirmed
      );
      $enquiry = Review::create($form_data);

      Mail::to('hworkpk@gmail.com')->queue(new ReviewEmail($form_data));

      if( count(Mail::failures()) > 0 ) {
        $failures_array = array();
        foreach(Mail::failures as $email_address) {
          $failures_array[] = $email_address;
          return response()->json(['failure' => $failures_array], 500);
        }
      } else {
        return response()->json(['success' => 'Thanks for your review!'], 200);
      }
    }
  }
  public function part_exchange()
  {
    return view('website.part_exchange');
  }
  public function contact_us_page()
  {
    return view('website.contact_us');
  }
  public function finance_page()
  {
    return view('website.finance');
  }
  public function reviews_page()
  {
    $reviews = DB::table('reviews')->select('reviews.*')->orderBy('reviews.updated_at', 'desc')->get()->toArray();
    $reviewsAvg = DB::table('reviews')->avg('reviews.rating_number');
    $reviews_avg = round($reviewsAvg);
    return view('website.review', ['reviews' => $reviews, 'reviews_avg' => $reviews_avg]);
  }
  public function car_enquire_finance($name)
  {
    $arr = explode('_', $name);
    $car_id = $arr[1];
    $car_detail = DB::table('cars')
    ->leftJoin('categories', 'categories.id', '=', 'cars.category_id')
    ->select('cars.*', 'categories.category_name')
    ->where('cars.id', '=', $car_id)
    ->first();
    return view('website.enquire_finance', ['car_detail' => $car_detail]);
  }
}
