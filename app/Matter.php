<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Matter
 *
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Matter[] $articles
 */
class Matter extends Model
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

  // N..N
  public function articles(){
      return $this->belongsToMany(
          Article::class,
          'article_matter',
          'matter_id',
          'article_id'
      )->withTimestamps();
  }
}
