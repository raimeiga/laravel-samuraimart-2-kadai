<div class="container">
@foreach ($major_categories as $major_category)
         <h2>{{ $major_category->name }}</h2>
         @foreach ($categories as $category)
             @if ($category->major_category_id === $major_category->id)
             <label class="samuraimart-sidebar-category-label"><a href="{{ route('products.index', ['category' => $category->id]) }}">{{ $category->name }}</a></label>             
             @endif                                                 
         @endforeach                                                 
@endforeach
 </div>
 <!--  ↑ 呼び出すルーティングの後に連想配列[ ]で変数を渡すことで、コントローラー側（今回はindexアクション）へ値を渡している -->