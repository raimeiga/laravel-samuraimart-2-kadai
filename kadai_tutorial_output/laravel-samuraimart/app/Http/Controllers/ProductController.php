<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;  //Categoryのインスタンスを使用できるようになる
use App\Models\MajorCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
        {
        if ($request->category !== null) {
            // ↓ 絞り込んだカテゴリーidをもつ商品データを取得し、且つソート(sortable)とページネーション(paginate)を設定
            $products = Product::where('category_id', $request->category)->sortable()->paginate(15);
            // ↓ 絞り込んだカテゴリーidをもつ商品の数を取得
            $total_count = Product::where('category_id', $request->category)->count();
            // ↓ 絞り込んだカテゴリー名を取得
            $category = Category::find($request->category);
            // ↓ 絞り込んだ親カテゴリーidを取得
            $major_category = MajorCategory::find($category->major_category_id);
        } else {
            $products = Product::sortable()->paginate(15);    // ソート(sortable)とページネーション(paginate)を設定
            $total_count = "";
            $category = null;
            $major_category = null; 
        }
         $categories = Category::all();     // 全てのカテゴリーを取得
         $major_categories = MajorCategory::all();
        //上記で取得したデータ（$products,$categoryなど）をindex.blade.phpに渡す
        return view('products.index', compact('products', 'category', 'major_category', 'categories', 'major_categories', 'total_count'));
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(); //選択するカテゴリをcompact関数で渡して新規登録ページに反映
  
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  storeアクションはデータを受け取り、新しいデータを保存するアクション
    public function store(Request $request)  //$requestにはフォームから送信されたデータが格納されている
    {
        $product = new Product();                                // Productモデルをインスタンス化
        $product->name = $request->input('name');                //productsテーブルのnameカラムに保存
        $product->description = $request->input('description');  //productsテーブルのdescriptionカラムに保存
        $product->price = $request->input('price');              //productsテーブルのpriceカラムに保存
        $product->category_id = $request->input('category_id');  //productsテーブルのcategoriesカラムに保存
        $product->save();                                        //←このコードで、name、description、priceのデータをデータベースに保存

        return to_route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $reviews = $product->reviews()->get();  //商品の全てのレビューを取得して$reviewsに保存し、↓のcompact関数でビューに渡す
  
        return view('products.show', compact('product', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all(); //選択したカテゴリを取得し、下のcompact関数で渡して編集ページに反映
  
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id'); 
        $product->update();  //←このコードで、データベースから指定の商品のデータを更新
 
        return to_route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();  //←このコードで、データベースから指定の商品のデータを削除
  
        return to_route('products.index'); // URL「/products」にリダイレクト   

    }

    // favoriteアクション=商品のお気に入り登録・解除を制御するアクション
    public function favorite(Product $product)
     {
         Auth::user()->togglefavorite($product);  
           // Auth::userで、現在のユーザーの情報を取得
           //  togglefavorite($product)で、ユーザーがその商品をお気に入り登録していなければ登録し、お気に入り登録していれば解除
         return back();
     }
}
