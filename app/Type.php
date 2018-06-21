<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Type
 *
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Article[] $articles
 * @property mixed $image
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

  // Surcouche Accesseur set
  public function setImageAttribute($property){
      $this->attributes['image_url'] = $property;
  }

  // Surcouche Accesseur get
  public function getImageAttribute(){
      return $this->attributes['image_url'];
  }

  // 1..N
  public function articles(){
    return $this->hasMany(Article::class);
  }
}
