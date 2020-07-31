<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DB;
use App\User;
use App\Category;
use App\Car;
use DateTime;

class AdminController extends Controller
{
  public function __construct()
{
    $this->middleware('auth');
    $this->middleware('admin');
}

//////////////// dashboard ///////////////////

public function admin_dashboard()
{
    return view('admins.dashboard');
}

public function view_cars()
{
    $categories = Category::orderBy('category_name','asc')->get();
    $cars = DB::table('cars')
            ->leftJoin('categories', 'categories.id', '=', 'cars.category_id')
            ->select('categories.category_name', 'cars.*')
            ->orderBy('cars.updated_at', 'desc')
            ->paginate(10);
            // dd($cars);

    // $cars = Car::orderBy('updated_at','DESC')->paginate(10);
    return view('admins.view_cars', ['categories' => $categories, 'cars' => $cars]);
}

public function store_car_data(Request $request)
{
  $rules = array(
    'category_id' => 'required',
    'model' => 'required',
    'model_year' => 'required',
    'colour' => 'required',
    'price' => 'required',
    'mileage' => 'required',
    'number_of_doors' => 'required',
    'number_of_seats' => 'required',
    'engine_size' => 'required',
    'body_style' => 'required',
    'fuel_type' => 'required',
    'gearbox_type' => 'required',
    'description' => 'required',
    'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
  );

  $error = Validator::make($request->all(), $rules);
  if($error->fails()){
    return response()->json(['errors' => $error->errors()->all()]);
  }else{
    $price = "";
    $mileage = "";
    if($request->price != "" || $request->mileage != ""){
      $price = str_replace(',', '', $request->price);
      $mileage = str_replace(',', '', $request->mileage);
    }
    $id = uniqid();
    if($request->hasFile('featured_image')){
      $file=$request->file('featured_image')->store('public');
      $image=Storage::get($file);
      Storage::put($file,$image);
      $image_path=explode('/', $file);
      $image_path=$image_path[1];
    }
    else{
      $image_path="";
    }
    $form_data = array(
      'id' => $id,
      'category_id' => $request->category_id,
      'model' => $request->model,
      'model_year' => $request->model_year,
      'colour' => $request->colour,
      'price' => $price,
      'mileage' => $mileage,
      'number_of_doors' => $request->number_of_doors,
      'number_of_seats' => $request->number_of_seats,
      'engine_size' => $request->engine_size,
      'body_style' => $request->body_style,
      'fuel_type' => $request->fuel_type,
      'gearbox_type' => $request->gearbox_type,
      'car_type' => $request->car_type,
      'sale_status' => $request->sale_status,
      'description' => $request->description,
      'featured_image' => $image_path
    );
    $car = Car::create($form_data);
    return response()->json($car, 200);
  }
}

public function view_categories()
{
    $categories = Category::orderBy('updated_at','DESC')->paginate(10);
    if (request()->ajax()) {
      $view = view('admins.categories_listing', ['categories' => $categories]);
      return Response()->json(['status' => 'ok', 'listing' => $view->render()]);
    }
    return view('admins.view_categories', compact('categories'));
}

public function store_category(Request $request)
{
  $rules = array(
    'category_name' => 'required',
    'category_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
  );

  $error = Validator::make($request->all(), $rules);
  if($error->fails()){
    return response()->json(['errors' => $error->errors()->all()]);
  }else{
    $id = uniqid();
    if($request->hasFile('category_icon')){
      $file=$request->file('category_icon')->store('public');
      $image=Storage::get($file);
      Storage::put($file,$image);
      $image_path=explode('/', $file);
      $image_path=$image_path[1];
    }
    else{
      $image_path="";
    }
    $form_data = array(
      'id' => $id,
      'category_name' => $request->category_name,
      'category_icon' => $image_path
    );
    $category = Category::create($form_data);
    return response()->json($category, 200);
  }
}

public function update_category(Request $request)
{
  $rules = array(
    'edit_category_name' => 'required'
  );

  $error = Validator::make($request->all(), $rules);
  if($error->fails()){
    return response()->json(['errors' => $error->errors()->all()]);
  }else{
    if($request->hasFile('edit_category_icon')){
      $file=$request->file('edit_category_icon')->store('public');
      $image=Storage::get($file);
      Storage::put($file,$image);
      $image_path=explode('/', $file);
      $image_path=$image_path[1];
      $category_image = Category::find($request->edit_fid);
      $category_image->category_icon = $image_path;
      $category_image->save();
    }
    $category = Category::find($request->edit_fid);
    $category->category_name = $request->edit_category_name;
    $category->save();

    return response()->json($category, 200);
  }
}

public function delete_category(Request $request)
{
  $category = Category::find($request->id)->delete();
  return response()->json("Category Deleted Succssfully", 200);
}

//////////////// dashboard end ///////////////////
}
