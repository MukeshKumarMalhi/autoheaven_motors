<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExteriorFeature extends Model
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
      'id', 'car_id', 'exterior_feature_list'
  ];
}
