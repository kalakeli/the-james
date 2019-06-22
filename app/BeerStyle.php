<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BeerStyle extends Model
{

  protected $table = 'beerStyles';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'beerStyle', 'beerColor', 'malts', 'hops', 'bitterness', 'ibu_from', 'ibu_top'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];
}
