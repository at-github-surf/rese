#アプリケーション名  
Rese  
ある企業のグループ会社の飲食店予約サービス  
  
##作成した目的  
競合他社の機能や画面が複雑で使いづらいため、
差別化のためユーザーフレンドリーな予約サービスの提供を目指す  
  
##リポジトリ  
https://github.com/at-github-surf/rese  
  
##機能一覧  
会員登録  
ログイン  
ログアウト  
ユーザー情報取得  
ユーザー飲食店お気に入り一覧取得  
ユーザー飲食店予約情報取得  
飲食店一覧取得  
飲食店詳細取得  
飲食店お気に入り追加  
飲食店お気に入り解除  
飲食店予約  
飲食店予約キャンセル  
飲食店評価  
エリアで検索する  
ジャンルで検索する  
店名で検索する  
  
店舗代表者追加  
店舗代表一覧取得  
利用者向けお知らせメール一斉配信  
  
自店舗取得  
自店舗登録  
自店舗編集  
自店舗予約情報取得  
自店舗来店確認  
  
##使用技術  
laravel 8.83.8  
nginx1.21.1  
php8.1  
mysql8.0.26  
milon/barcode（composer require milon/barcode）  
  
##テーブル設計  
https://github.com/at-github-surf/rese/blob/main/src/rese_table1.png  
https://github.com/at-github-surf/rese/blob/main/src/rese_table2.png  
  
##ER図  
https://github.com/at-github-surf/rese/blob/main/src/rese_er.png  
  
#環境構築  
git clone https://github.com/at-github-surf/rese.git  
docker-compose up -d --build  
curl -sS https://getcomposer.org/installer | php  
sudo mv composer.phar /usr/local/bin/composer  
コンテンツディレクトリに移動  
composer update  
composer install  
php artisan key:generate  
php artisan migrate  
php artisan db:seed  
  
##その他  
画像のパスに環境変数を使用。本番環境時にURLを書き換える  
IMG_PATH="http://localhost/storage/img/stores-img/"  
/src/storage/app/public/img/stores-img/内にテスト用の店舗画像をpngで格納してください。