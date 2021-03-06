<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', 'Sample') - Laravel 新手入门教程</title>
    <!-- <link rel="stylesheet" href="/css/app.css"> -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  </head>
  <body>
@include('layouts._header')

    <div class="container">
      @include('shared._messages')
      <!-- 输出错误信息 -->
      @yield('content')
      @include('layouts._footer')
    </div>

    <script href="{{ mix('js/app.js') }}"></script>
  </body>
</html>