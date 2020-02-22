<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title')</title>
  </head>
  <body>
    @section('menu')
      <a href="/createBoard">Создать запись</a>
      <a href="/showSinglePage">Показать одну запись</a>
      <a href="">Показать все записи</a>
    @show
    <div class="wrapper">
      @yield('content')
    </div>
  </body>
</html>
