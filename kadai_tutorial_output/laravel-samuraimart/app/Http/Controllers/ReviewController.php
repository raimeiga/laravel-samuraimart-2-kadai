<?php

namespace App\Http\Controllers;

use App\Models\Review;  
// ↑　ターミナル上で「php artisan make:controller ReviewController --model=Review」というように
// 　「--model=Reviewオ」プションを追記することで、使用するモデルを指定した状態でコントローラが生成される
use Illuminate\Support\Facades\Auth;
/* ↑ Authファサードを利用することで、「現在ログイン中のユーザー」を取得
     Authファサードは、クラスをインスタンス化しなくても、Auth::user()を記述することで、
     現在ログイン中のユーザー（Userモデルのインスタンス）を取得できる。
*/
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  レビューの投稿のみを行うため、storeアクション以外は全て削除
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $review = new Review();
        $review->content = $request->input('content');
        $review->product_id = $request->input('product_id');
        $review->user_id = Auth::user()->id;  //ログインしたユーザーのidを取得
        $review->score = $request->input('score');  //☆印のscoreを取得
        $review->save();  

        return back();
    }

   
}
