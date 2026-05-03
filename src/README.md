#　フリマアプリ

##　環境構築
    Dockerビルド
        git clone https://github.com/Naru412/laravel-flea-market.git
        cd laravel-flea-market
        docker-compose up -d --build

    laravel環境構築
        docker-compose exec php bash
        composer install
        cp .env.example .env
        php artisan key:generate

    .env設定
        DB_CONNECTION=mysql
        DB_HOST=mysql
        DB_PORT=3306
        DB_DATABASE=laravel_db
        DB_USERNAME=root
        DB_PASSWORD=root

    マイグレーション
        php artisan migrate --seed

    ストレージリンク
        php artisan storage:link

##　開発環境
    ・商品一覧画面（トップ画面                 http://localhost/
    ・商品一覧画面（トップ画面）_マイリスト     http://localhost/?tab=mylist
    ・会員登録画面                            http://localhost/register
    ・ログイン画面                            http://localhost/login
    ・商品詳細画面                            http://localhost/item/1
    ・商品購入画面                            http://localhost/purchase/1
    ・住所変更ページ                          http://localhost/purchase/address/6
    ・商品出品画面                            http://localhost/sell
    ・プロフィール画面                        http://localhost/mypage
    ・プロフィール編集画面                    http://localhost/mypage/profile
    ・プロフィール画面_購入した商品一覧        http://localhost/mypage?tab=buy
    ・プロフィール画面_出品した商品一覧        http://localhost/mypage?tab=sell
    ・phpMyAdmin                            http://localhost:8080/index.php?route=/sql&pos=0&db=laravel_db&table=users

## 使用技術
    ・nginx:1.21.1
    ・mysql:8.0.26
    ・php:8.1-fpm
    ・Laravel 8
    ・Laravel Fortify（認証）

## トラブルシューティング
    ログファイル権限エラー
        chmod -R 777 storage bootstrap/cache

    初期状態（welcome画面）のみ表示される
        git checkout feature/item-list

## ER図
    ![ER図](/DIAGRMS.NET/index.png)