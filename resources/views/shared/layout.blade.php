<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ToDo APP</title>
    @yield('styles')
    <link rel="stylesheet" href="/css/styles.css">
  </head>
  <body>
  <header>
    <nav class="my-navbar">
      <a class="my-navbar-band" href="/">ToDo APP</a>
    </nav>
  </header>

  <main>
    @yield('content')
  </main>
    @yield('scripts')
  </body>
</html>
