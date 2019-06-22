<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
  protected $table = 'beers';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'beer', 'breweryID', 'beerStyleID', 'iconPath', 'iconCredits', 
      'alcohol', 'fermentation', 'hops', 'malts', 'beerColour', 'beerAroma',
      'flagCask', 'flagKeg', 'flagBottle', 'flagShow', 'flagLastCask',
      'availableSoon', 'flagSoon'
  ];
}
