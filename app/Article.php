<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // 1..N
    public function images(){
      return $this->hasMany(Image::class);
    }
    // 1..N
    public function type(){
      return $this->belongsTo(Type::class);
    }
    // N..N
    public function matters(){
      return $this->belongsToMany(Matter::class);
    }
}
