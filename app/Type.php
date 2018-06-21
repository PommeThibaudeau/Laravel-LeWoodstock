<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Type
 *
 * @mixin \Eloquent
 */
class Type extends Model
{
  // fields
  protected $id;
  protected $designation;
  protected $image_url;

  protected $fillable = [
    'designation',
    'image_url',
  ];

  // 1..N
  public function articles(){
    return $this->hasMany(Article::class);
  }
}
