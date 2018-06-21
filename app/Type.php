<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    // 1..1
    public function image(){
      return $this->hasOne(Image::class);
    }
    // 1..N
    public function articles(){
      return $this->hasMany(Article::class);
    }
}
