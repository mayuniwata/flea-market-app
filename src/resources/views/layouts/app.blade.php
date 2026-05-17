<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>COACHTECH</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/common.css') }}">

    @yield('css')
</head>
<body>
    <header class="header">
    <div class="header__inner">
        <a href="/">
            <img src="{{ asset('images/COACHTECHヘッダーロゴ.png') }}" alt="COACHTECH" class="header__logo">
        </a>

        <div class="header__nav">
            @auth
                <form action="/logout" method="POST">
                    @csrf
                    <button class="header__logout">ログアウト</button>
                </form>
            @endauth
        </div>
    </div>
    <form class="header__search" action="/" method="get">
    @if(request('tab') === 'mylist')
        <input type="hidden" name="tab" value="mylist">
    @endif

    <input
        class="header__search-input"
        type="text"
        name="keyword"
        value="{{ request('keyword') }}"
        placeholder="なにをお探しですか？"
    >
</form>
</header>

    <main>
        @yield('content')
    </main>
</body>
</html>