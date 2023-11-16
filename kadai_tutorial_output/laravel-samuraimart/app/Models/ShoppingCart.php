<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShoppingCart extends Model
{
    use HasFactory;
    // モデルにするテーブルにshoppingcartテーブルを指定
    protected $table = 'shoppingcart';
    // getCurrentUserOrdersは、この場合、ユーザーIDを指定すると、該当ユーザーの注文一覧を取得するらしい
    public static function getCurrentUserOrders($user_id)
     {
         $shoppingcarts = DB::table('shoppingcart')->where("instance", "{$user_id}")->get();
 
         $orders = [];
 
         foreach ($shoppingcarts as $order) {
             $orders[] = [
                 'id' => $order->number,                                //注文ID
                 'created_at' => $order->updated_at,                    //購入日時
                 'total' => $order->price_total,                        //金額
                 'user_name' => User::find($order->instance)->name,     //ユーザー名
                 'code' => $order->code                                 //注文番号
             ];
         }
 
         return $orders;
     }
}
