<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MajorCategory extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->hasMany(Category::class); //親カテゴリーは複数カテゴリーに紐づけられるので、hasMany(Category）とする
    }
}
