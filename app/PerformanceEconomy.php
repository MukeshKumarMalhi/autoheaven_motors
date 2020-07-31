<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformanceEconomy extends Model
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
      'id', 'car_id', 'fuel_consumption_urban', 'fuel_consumption_extra_urban', 'fuel_consumption_combined', 'zero_sixty_mph', 'top_speed', 'cylinders', 'valves', 'engine_power', 'engine_torque'
  ];
}
