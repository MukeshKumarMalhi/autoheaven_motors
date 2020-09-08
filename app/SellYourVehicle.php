<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellYourVehicle extends Model
{
  protected $primaryKey='id';
  public $incrementing = false;
  protected $keyType = 'string';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id', 'vehicle_type', 'company', 'model', 'vehicle_reg', 'mileage', 'service_history', 'vehicle_come_with_specify', 'vehicle_condition', 'vehicle_damage_condition_description', 'full_name', 'phone_number', 'email_address'
  ];
}
