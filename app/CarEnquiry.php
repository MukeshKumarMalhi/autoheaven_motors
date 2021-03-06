<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarEnquiry extends Model
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
      'id', 'car_id', 'name', 'email', 'phone', 'info_message'
  ];
}
