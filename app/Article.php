<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Article
 *
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Image[] $images
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Article[] $matters
 * @property-read \App\Type $type
 */
class Article extends Model
{
  // fields
  protected $id;
  protected $description;
  protected $designation;
  protected $stock;
  protected $price;
  protected $type_id;

  protected $fillable = [
    'description',
    'designation',
    'stock',
    'price',
    'type_id',
  ];

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
      return $this->belongsToMany(
          Matter::class,
          'article_matter',
          'article_id',
          'matter_id'
      )->withTimestamps();
  }
}
