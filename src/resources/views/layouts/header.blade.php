<header class="header">
    <div class="header-inner">

        <div class="logo">
            COACHTECH
        </div>

        <div class="header-search">
            <form action="/" method="GET">
                <input 
                type="text" 
                name="keyword"
                value="{{ request('keyword') }}"
                placeholder="商品名で検索">

                <input 
                type="hidden" 
                name="tab" 
                value="{{ request('tab') }}">
            </form>
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