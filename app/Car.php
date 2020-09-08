<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{

  protected $primaryKey='id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function category()
  {
      return $this->belongsTo('App\Category','category_id');
  }

  public function car_image()
  {
      return $this->hasMany('App\CarImage','car_id');
  }

  public function dimension()
  {
      return $this->hasMany('App\Dimension','car_id');
  }

  public function vehicle_summary()
  {
      return $this->hasMany('App\VehicleSummary','car_id');
  }

  public function performance_economy()
  {
      return $this->hasMany('App\PerformanceEconomy','car_id');
  }

  public function safety()
  {
      return $this->hasMany('App\Safety','car_id');
  }

  public function exterior_feature()
  {
      return $this->hasMany('App\ExteriorFeature','car_id');
  }

  public function interior_feature()
  {
      return $this->hasMany('App\InteriorFeature','car_id');
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id', 'category_id', 'name', 'model', 'model_year', 'colour', 'price', 'mileage', 'number_of_doors', 'number_of_seats', 'engine_size', 'engine_size_cc', 'body_style', 'description', 'fuel_type', 'gearbox_type', 'car_type', 'status', 'sale_status', 'featured_image'
  ];
}
