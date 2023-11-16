<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   // ←ページネーションの措置。自動的に「データベース内の商品の数 / 表示件数」で計算したページ数分のリンクを作成してくれる
        Paginator::useBootstrap(); 
    }
}
