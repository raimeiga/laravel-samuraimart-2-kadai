<nav class="navbar navbar-expand-md navbar-light shadow-sm samuraimart-header-container">
   <div class="container">
     <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{asset('img/logo.jpg')}}">  <!-- asset関数を使い、publicディレクトリ配下の画像ファイルなどにアクセスできる -->
     </a>
     <form class="row g-1">
       <div class="col-auto">
         <input class="form-control samuraimart-header-search-input">
       </div>
       <div class="col-auto">
         <button type="submit" class="btn samuraimart-header-search-button"><i class="fas fa-search samuraimart-header-search-icon"></i></button>
       </div>
     </form>
     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
       <span class="navbar-toggler-icon"></span>
     </button>
 
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <!-- Right Side Of Navbar -->
       <ul class="navbar-nav ms-auto mr-5 mt-2">

         <!-- Authentication Links ログインしていない場合の処理を、atマークguest~elseに記述。
         　　　href="{{ route('login') }}とすることでログイン画面に遷移させている-->
         @guest  
         <li class="nav-item mr-5">
           <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
         </li>
         <li class="nav-item mr-5">
           <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
         </li>
         <hr>
         <li class="nav-item mr-5">
           <a class="nav-link" href="{{ route('login') }}"><i class="far fa-heart"></i></a>
         </li>
         <li class="nav-item mr-5">
           <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-shopping-cart"></i></a>
         </li>
         @else  <!--ログインしている場合の処理を、atマークelse~endguestに記述 -->
        <li class="nav-item mr-5">
             <a class="nav-link" href="{{ route('mypage') }}">   <!--マイページへのリンクを表示 -->
             <i class="fas fa-user mr-1"></i><label>マイページ</label>
           </a>
         </li>
         
          <li class="nav-item mr-5">  
             <a class="nav-link" href="{{ route('mypage.favorite') }}"> <!--お気に入りページへのリンク -->
             <i class="far fa-heart"></i>  <!-- "far fa-heart"はFont Awesomeで提供されているclassで、お気に入りマーク（ハート）のアイコンを作っている -->
             </a> 
         </li>
         <li class="nav-item mr-5">
           <a class="nav-link" href="{{ route('carts.index') }}">   <!--ヘッダーにカートへのリンク -->
             <i class="fas fa-shopping-cart"></i>  <!--カートのアイコンを作っているclassだろう（上記のお気に入りマーク（ハート）と同様） -->
           </a>
         </li>
         @endguest
       </ul>
     </div>
   </div>
 </nav>