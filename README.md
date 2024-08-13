# アプリケーション名：Rese

飲食店の予約システムを作成。会員登録後、会員情報を用いたログインにより店舗予約やお気に入りの追加が可能。

![alt text](images/home.png)

## 作成した目的

模擬案件を通して実践に近い開発経験をつむ

## アプリケーション URL

ログイン時は本書記載のユーザー情報を用いてログインする

## 他のリポジトリ

無

## 機能一覧

会員登録機能、ログイン機能、お気に入り追加/削除、予約追加/削除、検索、並び替え

## 仕様技術

docker、Laravel 8.x、PHP 7.4、laravel-fortify

## テーブル設計及び ER 図

![alt text](images/table.png)

## 環境構築

### コマンドライン上

```
$ git clone https://github.com/bokazuya25/ReservationSystem_restaurant.git
```

```php
$ docker compose up -d --build
$ docker compose exec php bash
```

### PHP コンテナ内

```php
$ composer install
```

### src 上

```php
$ cp .env.local .env
```

### PHP コンテナ内

```php
$ php artisan key:generate
$ php artisan migrate --seed
```

### src 上

```php
$ sudo chmod -R 775 storage
$ sudo chmod -R 775 bootstrap/cache
```

## ダミーデータの説明

### ユーザー情報（ログイン時に使用するデータ）

email: taichi.tsuda@example.org
パスワード：password
# resev_20240813
