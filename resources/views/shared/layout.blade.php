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
    <a class="my-navbar-brand" href="/">ToDo App</a>
    <div class="my-navbar-control">
      @if(Auth::check())
        <span class="my-navbar-item">ようこそ, {{ Auth::user()->name }}さん</span>
        ｜
        <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      @else
        <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
        ｜
        <a class="my-navbar-item" href="{{ route('register') }}">ユーザー登録</a>
      @endif
    </div>
  </nav>
</header>

        {{-- フラッシュ・メッセージ --}}
        @if (session('my_status'))
            <div class="container mt-2">
              <div class="alert alert-success">
                  {{ session('my_status') }}
               </div>
            </div>
        @endif


  <main>
    @yield('content')
  </main>

    @if(Auth::check())
      <script>
        document.getElementById('logout').addEventListener('click', function(event) {
          event.preventDefault();
          document.getElementById('logout-form').submit();
        });
      </script>
      @endif

    @yield('scripts')

  </body>
</html>
