<header class="header">
    <div class="header-inner">

        <div class="logo">
            COACHTECH
        </div>

        <div class="header-menu">
            <a href="/mypage">マイページ</a>

            @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
            @endauth
        </div>

    </div>
</header>