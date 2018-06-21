<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Image
 *
 * @mixin \Eloquent
 */
class Image extends Model
{
  // fields
  protected $id;
  protected $src;
  protected $article_id;

  protected $fillable = [
    'src',
    'article_id',
  ];

  // 1..N
  public function article(){
    return $this->belongsTo(Article::class);
  }
}
