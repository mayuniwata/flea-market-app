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

        <a class="header__logo-link" href="/">
            <img
                class="header__logo"
                src="{{ asset('images/COACHTECHヘッダーロゴ.png') }}"
                alt="COACHTECH"
            >
        </a>

        @if (!request()->is('login') && !request()->is('register') && !request()->is('email/verify'))

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

            <nav class="header__nav">

                @auth

                    <form action="/logout" method="post">
                        @csrf
                        <button class="header__nav-button" type="submit">
                            ログアウト
                        </button>
                    </form>

                    <a class="header__nav-link" href="/mypage">
                        マイページ
                    </a>

                    <a class="header__sell-button" href="/sell">
                        出品
                    </a>

                @else

                    <a class="header__nav-link" href="/login">
                        ログイン
                    </a>

                    <a class="header__nav-link" href="/register">
                        会員登録
                    </a>

                @endauth

            </nav>

        @endif

    </div>

</header>

<main>
    @yield('content')
</main>

</body>
</html>