<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matter extends Model
{
    // 1..1
    public function image(){
      return $this->hasOne(Image::class);
    }
    // N..N
    public function articles(){
      return $this->belongsToMany(Article::class);
    }
}
