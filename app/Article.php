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
 * @property int $id
 * @property string $designation
 * @property string|null $description
 * @property int|null $stock
 * @property float|null $price
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $type_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereDesignation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereUpdatedAt($value)
 */
class Article extends Model
{
  // fields
  protected $id;
  protected $description;
  protected $designation;
  protected $stock;
  protected $price;

  protected $fillable = [
    'description',
    'designation',
    'stock',
    'price',
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
      return $this->belongsToMany(Article::class);
  }
}
