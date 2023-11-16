<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\CustomVerifyEmail;
use App\Notifications\CustomResetPassword;
use Overtrue\LaravelFavorite\Traits\Favoriter; //お気に入りするモデル（今回は商品のUser）にuse Favoriterとすることで、お気に入り機能使用可に。
use Illuminate\Database\Eloquent\SoftDeletes;  //論理削除を有効にするには、モデルにSoftDeletesトレイトを追加する必要があるらしい

class User extends Authenticatable implements MustVerifyEmail
{   //お気に入りするモデル（今回は商品のUser）にuse Favoriterとすることで、お気に入り機能使用可に。
    use HasApiTokens, HasFactory, Notifiable, Favoriter, SoftDeletes;  
 
    protected $dates = ['deleted_at'];  // ← 論理削除カラム(deleted_at)が日付(Datetime型)であることを宣言するためのもの

    public function sendEmailVerificationNotification()
     {
         $this->notify(new CustomVerifyEmail());
     }

    public function sendPasswordResetNotification($token) {
        $this->notify(new CustomResetPassword($token));
    }
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'postal_code',
        'address',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reviews()
     {
         return $this->hasMany('App\Models\Review');
     }
}
