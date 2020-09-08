<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartExchange extends Model
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
      'id', 'vehicle_type', 'company', 'model', 'vehicle_reg', 'mileage', 'condition', 'full_name', 'phone_number', 'email_address', 'best_time_to_call'
  ];
}
