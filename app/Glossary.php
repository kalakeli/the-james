<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Glossary extends Model
{
  protected $table = 'glossary';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'term', 'explanation', 'furtherInfoLink', 'furtherInfoName', 'flagShow'
  ];
}
