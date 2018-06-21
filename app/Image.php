<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    // 1..1
    public function matter(){
      return $this->belongsTo(Matter::class);
    }
    // 1..1
    public function type(){
      return $this->belongsTo(Type::class);
    }
    // 1..N
    public function article(){
      return $this->belongsTo(Article::class);
    }

}
}
