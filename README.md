# 基礎学習ターム 確認テスト_お問い合わせフォーム

## プロジェクト概要
複数カテゴリ対応のお問い合わせフォームと管理画面を備えた Laravel アプリケーション。
ユーザーがお問い合わせを送信でき、認証済み管理者が全件を一覧表示・検索・削除できます。

## 主な機能
- **フロントエンド**
  - カテゴリ選択付きお問い合わせフォーム
  - 送信前確認画面
  - バリデーション検証

- **管理画面（認証必須）**
  - お問い合わせ一覧表示（ページネーション対応、7件/ページ）
  - カテゴリ別検索
  - お問い合わせ削除機能

## 使用技術とバージョン
- PHP 8.1‑fpm 
- Laravel 8.75
- MySQL	8.0.26
- Nginx	1.21.1
  
### 依存ライブラリ		
- Laravel Fortify	^1.19	
- Laravel Sanctum	^2.11	
- Livewire	^2.12	
- Guzzle	^7.0.1	
- その他は composer.json 参照

## 環境構築

### 前提条件
- Docker／Docker Compose がインストール済みであること

### Dockerビルドからマイグレーション、シーディングまでを記載
- git clone <リポジトリURL>
- docker-compose up -d --build
- docker-compose exec php bash
- composer install
- cp .env.example .env（設定変更：DB_HOST=mysql）
- php artisan key:generate
- php artisan migrate
- php artisan db:seed

## データベース構成

### categories テーブル
- お問い合わせのカテゴリを管理

### contacts テーブル
- 送信されたお問い合わせデータを保存
- category_id との関連付け

### users テーブル
- 管理画面へのアクセス権限を持つユーザー

## ER図
![ER図](/er.png )

## URL（開発環境）
- http://localhost/

## API ルート

| メソッド | エンドポイント | 説能 | 認証 |
|---|---|---|---|
| GET | `/` | フォーム表示 | 不要 |
| POST | `/confirm` | 確認画面表示 | 不要 |
| POST | `/store` | データ保存 | 不要 |
| GET | `/admin` | 管理画面 | 必須 |
| GET | `/search` | 検索実行 | 必須 |
| DELETE | `/delete` | お問い合わせ削除 | 必須 |
