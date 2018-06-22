<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Matter
 *
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Matter[] $articles
 * @property int $id
 * @property string $designation
 * @property string|null $image_url
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Matter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Matter whereDesignation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Matter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Matter whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Matter whereUpdatedAt($value)
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

    // N..N
    public function articles(){
        return $this->belongsToMany(Matter::class);
    }
}
