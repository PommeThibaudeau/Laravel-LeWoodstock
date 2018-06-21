<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Matter
 *
 * @mixin \Eloquent
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
