<header class="header">
    <div class="header-inner">

        <div class="logo">
            COACHTECH
        </div>

        @auth
        <div class="header-search">
            <form action="/" method="GET">
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="商品名で検索">
                <input type="hidden" name="tab" value="{{ request('tab') }}">
            </form>
        </div>
        @endauth

        <div class="header-menu">

            @auth
            <a href="/mypage">マイページ</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
            
            <a href="/sell">出品</a>
            @endauth
        </div>
    </div>
</header>