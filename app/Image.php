<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Image
 *
 * @mixin \Eloquent
 * @property-read \App\Article $article
 * @property int $id
 * @property string $src
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $article_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereSrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereUpdatedAt($value)
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
