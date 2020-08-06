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
use App\CarImage;
use App\VehicleSummary;
use App\PerformanceEconomy;
use App\Dimension;
use App\InteriorFeature;
use App\ExteriorFeature;
use App\Safety;
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

public function upload_car_images($id)
{
    $images = CarImage::where('car_id', '=', $id)->orderBy('updated_at', 'desc')->get();
    return view('admins.car_images', ['id' => $id, 'images' => $images]);
}

public function view_cars()
{
    $categories = Category::orderBy('category_name','asc')->get();
    $cars = DB::table('cars')
            ->leftJoin('categories', 'categories.id', '=', 'cars.category_id')
            ->select('categories.category_name', 'cars.*')
            ->orderBy('cars.updated_at', 'desc')
            ->paginate(10);

    return view('admins.view_cars', ['categories' => $categories, 'cars' => $cars]);
}

public function view_car_details(Request $request, $name, $id)
{
  $categories = Category::orderBy('category_name','asc')->get();
  $vehicle_summary = VehicleSummary::where('car_id', '=', $id)->first();
  $performance_economy = PerformanceEconomy::where('car_id', '=', $id)->first();
  $dimension = Dimension::where('car_id', '=', $id)->first();
  $interior_feature = InteriorFeature::where('car_id', '=', $id)->orderBy('updated_at','desc')->get();
  $exterior_feature = ExteriorFeature::where('car_id', '=', $id)->orderBy('updated_at','desc')->get();
  $safety_list = Safety::where('car_id', '=', $id)->orderBy('updated_at','desc')->get();

  $car = DB::table('cars')
          ->leftJoin('categories', 'categories.id', '=', 'cars.category_id')
          ->select('categories.category_name', 'cars.*')
          ->where('cars.id', '=', $id)
          ->first();

  return view('admins.view_car_details', [
      'car_details' => $car,
      'categories' => $categories,
      'vehicle_summary' => $vehicle_summary,
      'performance_economy' => $performance_economy,
      'dimension' => $dimension,
      'interior_feature' => $interior_feature,
      'exterior_feature' => $exterior_feature,
      'safety_list' => $safety_list
    ]);
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

public function update_car_details(Request $request)
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
    'description' => 'required'
  );

  $error = Validator::make($request->all(), $rules);
  if($error->fails()){
    return response()->json(['errors' => $error->errors()->all()]);
  }else{
    if($request->hasFile('featured_image')){
      $file=$request->file('featured_image')->store('public');
      $image=Storage::get($file);
      Storage::put($file,$image);
      $image_path=explode('/', $file);
      $image_path=$image_path[1];
      $car_image = Car::find($request->edit_fid);
      $car_image->featured_image = $image_path;
      $car_image->save();
    }
    $price = "";
    $mileage = "";
    if($request->price != "" || $request->mileage != ""){
      $price = str_replace(',', '', $request->price);
      $mileage = str_replace(',', '', $request->mileage);
    }
    $car = Car::find($request->edit_fid);
    $car->category_id = $request->category_id;
    $car->model = $request->model;
    $car->model_year = $request->model_year;
    $car->colour = $request->colour;
    $car->price = $price;
    $car->mileage = $mileage;
    $car->number_of_doors = $request->number_of_doors;
    $car->number_of_seats = $request->number_of_seats;
    $car->engine_size = $request->engine_size;
    $car->body_style = $request->body_style;
    $car->fuel_type = $request->fuel_type;
    $car->gearbox_type = $request->gearbox_type;
    $car->description = $request->description;
    $car->car_type = $request->car_type;
    $car->sale_status = $request->sale_status;
    $car->status = $request->status;
    $car->save();

    return response()->json($car, 200);
  }
}

public function store_car_vehicle_summary(Request $request)
{
  $rules = array(
    'co2_emissions' => 'required'
  );

  $error = Validator::make($request->all(), $rules);
  if($error->fails()){
    return response()->json(['errors' => $error->errors()->all()]);
  }else{
    $id = uniqid();
    $form_data = array(
      'id' => $id,
      'car_id' => $request->car_id,
      'co2_emissions' => $request->co2_emissions,
      'insurance_group' => $request->insurance_group,
      'standard_manufacturers_warranty_miles' => $request->standard_manufacturers_warranty_miles,
      'standard_manufacturers_warranty_years' => $request->standard_manufacturers_warranty_years,
      'standard_paintwork_guarantee' => $request->standard_paintwork_guarantee
    );
    $vehicle_summary = VehicleSummary::create($form_data);
    return response()->json($vehicle_summary, 200);
  }
}

public function update_car_vehicle_summary(Request $request)
{
  $rules = array(
    'edit_co2_emissions' => 'required'
  );

  $error = Validator::make($request->all(), $rules);
  if($error->fails()){
    return response()->json(['errors' => $error->errors()->all()]);
  }else{
    $vehicle_summary = VehicleSummary::find($request->edit_fid);
    $vehicle_summary->co2_emissions = $request->edit_co2_emissions;
    $vehicle_summary->insurance_group = $request->edit_insurance_group;
    $vehicle_summary->standard_manufacturers_warranty_miles = $request->edit_standard_manufacturers_warranty_miles;
    $vehicle_summary->standard_manufacturers_warranty_years = $request->edit_standard_manufacturers_warranty_years;
    $vehicle_summary->standard_paintwork_guarantee = $request->edit_standard_paintwork_guarantee;
    $vehicle_summary->save();
    return response()->json($vehicle_summary, 200);
  }
}

public function store_car_performance_economy(Request $request)
{
  $rules = array(
    'fuel_consumption_urban' => 'required'
  );

  $error = Validator::make($request->all(), $rules);
  if($error->fails()){
    return response()->json(['errors' => $error->errors()->all()]);
  }else{
    $id = uniqid();
    $form_data = array(
      'id' => $id,
      'car_id' => $request->car_id,
      'fuel_consumption_urban' => $request->fuel_consumption_urban,
      'fuel_consumption_extra_urban' => $request->fuel_consumption_extra_urban,
      'fuel_consumption_combined' => $request->fuel_consumption_combined,
      'zero_sixty_mph' => $request->zero_sixty_mph,
      'top_speed' => $request->top_speed,
      'cylinders' => $request->cylinders,
      'valves' => $request->valves,
      'engine_power' => $request->engine_power,
      'engine_torque' => $request->engine_torque
    );
    $performance_economy = PerformanceEconomy::create($form_data);
    return response()->json($performance_economy, 200);
  }
}

public function update_car_performance_economy(Request $request)
{
  $rules = array(
    'edit_fuel_consumption_urban' => 'required'
  );

  $error = Validator::make($request->all(), $rules);
  if($error->fails()){
    return response()->json(['errors' => $error->errors()->all()]);
  }else{
    $performance_economy = PerformanceEconomy::find($request->edit_fid);
    $performance_economy->fuel_consumption_urban = $request->edit_fuel_consumption_urban;
    $performance_economy->fuel_consumption_extra_urban = $request->edit_fuel_consumption_extra_urban;
    $performance_economy->fuel_consumption_combined = $request->edit_fuel_consumption_combined;
    $performance_economy->zero_sixty_mph = $request->edit_zero_sixty_mph;
    $performance_economy->top_speed = $request->edit_top_speed;
    $performance_economy->valves = $request->edit_valves;
    $performance_economy->engine_power = $request->edit_engine_power;
    $performance_economy->engine_torque = $request->edit_engine_torque;
    $performance_economy->save();
    return response()->json($performance_economy, 200);
  }
}

public function store_car_dimensions(Request $request)
{
  $rules = array(
    'height' => 'required'
  );

  $error = Validator::make($request->all(), $rules);
  if($error->fails()){
    return response()->json(['errors' => $error->errors()->all()]);
  }else{
    $id = uniqid();
    $form_data = array(
      'id' => $id,
      'car_id' => $request->car_id,
      'height' => $request->height,
      'height_inclusive_of_roof_rails' => $request->height_inclusive_of_roof_rails,
      'length' => $request->length,
      'wheelbase' => $request->wheelbase,
      'width' => $request->width,
      'width_including_mirrors' => $request->width_including_mirrors,
      'fuel_tank_capacity' => $request->fuel_tank_capacity,
      'minimum_kerb_weight' => $request->minimum_kerb_weight
    );
    $dimension = Dimension::create($form_data);
    return response()->json($dimension, 200);
  }
}


public function update_car_dimensions(Request $request)
{
  $rules = array(
    'edit_height' => 'required'
  );

  $error = Validator::make($request->all(), $rules);
  if($error->fails()){
    return response()->json(['errors' => $error->errors()->all()]);
  }else{
    $dimension = Dimension::find($request->edit_fid);
    $dimension->height = $request->edit_height;
    $dimension->height_inclusive_of_roof_rails = $request->edit_height_inclusive_of_roof_rails;
    $dimension->length = $request->edit_length;
    $dimension->wheelbase = $request->edit_wheelbase;
    $dimension->width = $request->edit_width;
    $dimension->width_including_mirrors = $request->edit_width_including_mirrors;
    $dimension->fuel_tank_capacity = $request->edit_fuel_tank_capacity;
    $dimension->minimum_kerb_weight = $request->edit_minimum_kerb_weight;
    $dimension->save();
    return response()->json($dimension, 200);
  }
}

public function store_car_interior_features(Request $request)
{
  $rules = array(
    'interior_feature_list' => 'required'
  );

  $error = Validator::make($request->all(), $rules);
  if($error->fails()){
    return response()->json(['errors' => $error->errors()->all()]);
  }else{
    $id = uniqid();
    $form_data = array(
      'id' => $id,
      'car_id' => $request->car_id,
      'interior_feature_list' => $request->interior_feature_list
    );
    $interior_feature = InteriorFeature::create($form_data);
    return response()->json($interior_feature, 200);
  }
}

public function store_car_exterior_features(Request $request)
{
  $rules = array(
    'exterior_feature_list' => 'required'
  );

  $error = Validator::make($request->all(), $rules);
  if($error->fails()){
    return response()->json(['errors' => $error->errors()->all()]);
  }else{
    $id = uniqid();
    $form_data = array(
      'id' => $id,
      'car_id' => $request->car_id,
      'exterior_feature_list' => $request->exterior_feature_list
    );
    $exterior_feature = ExteriorFeature::create($form_data);
    return response()->json($exterior_feature, 200);
  }
}

public function store_car_safety_features(Request $request)
{
  $rules = array(
    'safety_list' => 'required'
  );

  $error = Validator::make($request->all(), $rules);
  if($error->fails()){
    return response()->json(['errors' => $error->errors()->all()]);
  }else{
    $id = uniqid();
    $form_data = array(
      'id' => $id,
      'car_id' => $request->car_id,
      'safety_list' => $request->safety_list
    );
    $safety_list = Safety::create($form_data);
    return response()->json($safety_list, 200);
  }
}

public function update_car_interior_features(Request $request)
{
  $rules = array(
    'edit_interior_feature_list' => 'required'
  );

  $error = Validator::make($request->all(), $rules);
  if($error->fails()){
    return response()->json(['errors' => $error->errors()->all()]);
  }else{
    $interior_feature = InteriorFeature::find($request->edit_interior_fid);
    $interior_feature->interior_feature_list = $request->edit_interior_feature_list;
    $interior_feature->save();

    return response()->json($interior_feature, 200);
  }
}

public function update_car_exterior_features(Request $request)
{
  $rules = array(
    'edit_exterior_feature_list' => 'required'
  );

  $error = Validator::make($request->all(), $rules);
  if($error->fails()){
    return response()->json(['errors' => $error->errors()->all()]);
  }else{
    $exterior_feature = ExteriorFeature::find($request->edit_exterior_fid);
    $exterior_feature->exterior_feature_list = $request->edit_exterior_feature_list;
    $exterior_feature->save();

    return response()->json($exterior_feature, 200);
  }
}

public function update_car_safety_features(Request $request)
{
  $rules = array(
    'edit_safety_list' => 'required'
  );

  $error = Validator::make($request->all(), $rules);
  if($error->fails()){
    return response()->json(['errors' => $error->errors()->all()]);
  }else{
    $safety_list = Safety::find($request->edit_safety_fid);
    $safety_list->safety_list = $request->edit_safety_list;
    $safety_list->save();

    return response()->json($safety_list, 200);
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

public function store_car_images(Request $request)
{
  $rules = array(
    'images' => 'required'
  );
  $error = Validator::make($request->all(), $rules);
  if($error->fails()){
    return response()->json(['errors' => $error->errors()->all()]);
  }else{
    if($request->has('images')){
      $files = $request->file('images');
      foreach ($files as $file) {
        $name=$file->getClientOriginalName();
        $file1=$file->store('public');
        $image=Storage::get($file1);
        Storage::put($file1,$image);
        $image_path=explode('/', $file1);
        $image_path=$image_path[1];
        $type=$file->getClientOriginalExtension();
        $size=$file->getSize();
        $id = uniqid();

        $image = new CarImage();
        $image->id = $id;
        $image->car_id = $request->car_id;
        $image->image_url = $image_path;
        $image->image_name = $name;
        $image->image_type = $type;
        $image->image_size = $size;
        $image->save();
      }
    }
    return response()->json(['success' => 'Images Uploaded Successfully'],200);
  }
}

public function delete_car_image(Request $request)
{
  $CarImage = CarImage::find($request->id)->delete();
  return response()->json("Image Deleted Succssfully", 200);
}

//////////////// dashboard end ///////////////////
}
