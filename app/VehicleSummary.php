<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleSummary extends Model
{
  protected $primaryKey='id';
  public $incrementing = false;
  protected $keyType = 'string';

  public function car()
  {
      return $this->belongsTo('App\Car','car_id');
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id', 'car_id', 'engine_size_cc', 'co2_emissions', 'insurance_group', 'standard_manufacturers_warranty_miles', 'standard_manufacturers_warranty_years', 'standard_paintwork_guarantee'
  ];
}
