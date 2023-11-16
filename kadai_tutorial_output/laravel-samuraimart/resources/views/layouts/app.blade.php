<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/0d8153b09a.js" crossorigin="anonymous"></script>
    
     <!-- Styles public\css\samuraimart.cssを読み込むためのコード-->
     <link href="{{ asset('css/samuraimart.css') }}" rel="stylesheet">
     <!--↑ asset()関数を使用することで、publicディレクトリ配下のファイルにアクセスできる -->
</head>
<body>
    <div id="app">
          @component('components.header')   <!-- ヘッダーファイル（header.blade.php）の呼び出し -->
          @endcomponent
        <main class="py-4 mb-5">
          @yield('content')<!--main部分は、このトップページのファイルの可読性向上のため、
                               login.blade.phpのatマークsection('content')～atマークendsectionに記述-->
        </main>
          @component('components.footer')  <!-- フッターファイル（footer.blade.php）の呼び出し -->
          @endcomponent
    </div>
</body>
</html>
