# レストラン予約システムRESE
このプロジェクトは「レストラン予約アプリ」です。
ユーザーが飲食店を検索し、予約やお気に入り登録ができるシステムです。<br>
管理者と店舗代表者もそれぞれの権限で飲食店情報を管理できます。 
Laravelを使用し、Dockerコンテナで開発環境を構築しています。
Stripeによる決済機能やmailtrapを使用したメール認証、
QRコード生成など、様々な機能を追加実装しています。
<img width="1456" alt="上級案件トップページ" src="https://github.com/user-attachments/assets/9fa405de-2171-4841-b328-bd57afd05fbe">

## 作成目的
上級模擬案件として作成

## 機能一覧
＜基本機能＞<br>
新規会員登録、ログイン、ログアウト、<br>
ユーザー情報取得、ユーザー飲食店お気に入り一覧取得、ユーザー飲食店予約情報取得、<br>
飲食店一覧取得、飲食店詳細取得、<br>
飲食店お気に入り追加、飲食店お気に入り削除、<br>
飲食店予約情報追加、飲食店予約情報削除、<br>
エリア検索、ジャンル検索、店名検索<br>

＜追加実装機能＞<br>
予約変更機能、来店後の評価機能、バリデーション、<br>
レスポンシブデザイン(ブレイクポイント768px)、<br>
管理画面(管理者と店舗代表者）、画像のストレージ保存、<br>
メール認証、管理者からユーザーへのメール送信、<br>
利用日当日のリマインダー送信(手動コマンド)、QRコード作成、決済機能

## ログイン用テストアカウント
＜一般ユーザー(role:user)＞<br>
Name：磯野サザエ<br>
Email：becace1869@tiervio.com<br>
Password：12345678<br>

＜管理者(role:adimn)＞<br>
Name：Admin Name<br>
Email：admin@example.com<br>
Password：password<br>

＜店舗代表者(role:manager)＞<br>
Name：ルークのマネージャー<br>
Email：lukemanager@test.com<br>
Password：password

## テーブル設計図
<img width="656" alt="上級案件DB設計１" src="https://github.com/user-attachments/assets/4420e641-e026-406f-b509-5d2533eca292">
<img width="658" alt="上級案件DB設計２" src="https://github.com/user-attachments/assets/3da66d9e-10ce-40a7-907a-8c467308ed28">
<img width="654" alt="上級案件DB設計３" src="https://github.com/user-attachments/assets/108a4960-6906-4f19-b66a-234ecc5f5d8d">

## ER図
<img width="1185" alt="上級案件ER図" src="https://github.com/user-attachments/assets/18eadcdf-93cc-4b0b-9279-53c0910209cf">

## 使用技術
Laravel Framework 8.83.27<br>
PHP 8.3.0<br>
MySQL 8.0.26<br>
Mailtrap<br>
Stripe<br>

注意事項：<br>
Stripe決済機能のテストカードは4242 4242 4242 4242です。<br>
有効期限には任意の未来の日付、CVCには任意の3桁を入力してください。

## 環境構築と注意事項
＜Dockerビルド＞<br>
1 GitHubリポジトリをクローン<br>
	git clone git@github.com:clementine515/RESE.git<br>
2 DockerDesktopアプリを立ち上げる<br>
3 Dockerコンテナをビルドし、起動<br>
	docker-compose up -d —build<br>

注意事項：<br>
MacのM1・M2チップのPCの場合、no matching manifest for linux/arm64/v8 in the manifest list entriesのメッセージが表示されビルドができないことがあります。<br>エラーが発生する場合は、docker-compose.ymlファイルの「mysql」内の一番上に「platform: linux/x86_64」を追加で記載してください。

＜Laravel環境構築＞<br>
1 Dockerコンテナに入る<br>
	docker-compose exec php bash<br>
2 Composerのインストール<br>
	composer install<br>
3 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成<br>
4 .envに以下の環境変数を追加<br>
	DB_CONNECTION=mysql<br>
	DB_HOST=mysql<br>
	DB_PORT=3306<br>
	DB_DATABASE=laravel_db<br>
	DB_USERNAME=laravel_user<br>
	DB_PASSWORD=laravel_pass<br>
5 アプリケーションキーの作成<br>
	php artisan key:generate<br>
6 マイグレーションの実行<br>
	php artisan migrate<br>
7 シーディングの実行<br>
	php artisan db:seed<br>

＜予約当日のリマインドメール送信(手動コマンド)＞<br>
1 docker-compose exec php bash<br>
2 以下のコマンドを実行してリマインダーを送信<br>
	php artisan reservations:send-reminders<br>
3 mailtrap上で送信確認(Email Testing>Inboxes>My Inbox)

## URL
開発環境：http://localhost/<br>
phpMyAdmin:：http://localhost:8080/<br>
ログイン画面：http://localhost/login<br>
新規会員登録画面：http://localhost/register<br>

