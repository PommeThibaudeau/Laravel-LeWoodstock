<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Article
 *
 * @mixin \Eloquent
 */
class Article extends Model
{
  // fields
  protected $id;
  protected $description;
  protected $designation;
  protected $stock;
  protected $price;

  // 1..N
  public function type(){
    return $this->belongsTo(Type::class);
  }
  // N..1
  public function images(){
    return $this->hasMany(Image::class);
  }
  // N..N
  public function matters(){
      return $this->belongsToMany(Article::class);
  }
}
