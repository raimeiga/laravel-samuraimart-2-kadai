<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable;   
// ↑ お気に入りされるモデル（今回は商品のProduct）にuse Favoriteableとすることで、お気に入り機能を使えるようになる
use Kyslik\ColumnSortable\Sortable;
// ↑ Kyslik/column-sortable(というライブラリ)の使用宣言  Kyslik/column-sortableによりソート機能が使えるようになる
class Product extends Model
{
    use HasFactory, Favoriteable, Sortable; 
    // ↑ useにFavoriteableを指定することで、Productモデルに、お気に入り機能を使えるようになる
    // ↑ useにSortableを指定することで、Productモデルに、ソート機能を使えるようになる
    
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image',
        'recommend_flag',
        'carriage_flag',
    ];
    
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

     public function reviews()
     {
         return $this->hasMany('App\Models\Review');
     }
}
