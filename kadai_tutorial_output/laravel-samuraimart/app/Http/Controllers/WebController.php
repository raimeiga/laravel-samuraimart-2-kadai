<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\MajorCategory;
use App\Models\Product;

class WebController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $major_categories = MajorCategory::all();
        // 商品の登録日時（created_at）でソートして、新しい順に4つ取得し、下のcompactでビューに渡す
        $recently_products = Product::orderBy('created_at', 'desc')->take(4)->get();
        // おすすめフラグがONの商品を3つ取得し、下のcompactでビューに渡す
        $recommend_products = Product::where('recommend_flag', true)->take(3)->get();

        return view('web.index', compact('major_categories', 'categories', 'recently_products', 'recommend_products'));
    }
}


