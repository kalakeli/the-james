<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spirit extends Model
{
  protected $table = 'spirits';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'drinkType', 'drinkName', 'drinkDescription', 'country', 'flagshow'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];
}
