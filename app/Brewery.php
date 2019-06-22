<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brewery extends Model
{
  protected $table = 'breweries';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'brewery', 'breweryLong', 'breweryAddress', 'breweryUrl', 'country', 'region', 'regionalInformation'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];
}
