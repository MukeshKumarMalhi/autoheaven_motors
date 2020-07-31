<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dimension extends Model
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
      'id', 'car_id', 'height', 'height_inclusive_of_roof_rails', 'length', 'wheelbase', 'width', 'width_including_mirrors', 'fuel_tank_capacity', 'minimum_kerb_weight'
  ];
}
