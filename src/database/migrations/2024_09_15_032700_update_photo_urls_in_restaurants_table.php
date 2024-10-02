<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePhotoUrlsInRestaurantsTable extends Migration
{
    public function up()
    {
        \DB::table('restaurants')->where('restaurant_name', '仙人')->update(['photo_url' => 'photos/sushi.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '牛助')->update(['photo_url' => 'photos/yakiniku.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '戦慄')->update(['photo_url' => 'photos/izakaya.jpg']);
        \DB::table('restaurants')->where('restaurant_name', 'ルーク')->update(['photo_url' => 'photos/italian.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '志摩屋')->update(['photo_url' => 'photos/ramen.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '香')->update(['photo_url' => 'photos/yakiniku.jpg']);
        \DB::table('restaurants')->where('restaurant_name', 'JJ')->update(['photo_url' => 'photos/italian.jpg']);
        \DB::table('restaurants')->where('restaurant_name', 'らーめん極み')->update(['photo_url' => 'photos/ramen.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '鳥雨')->update(['photo_url' => 'photos/izakaya.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '築地色合')->update(['photo_url' => 'photos/sushi.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '晴海')->update(['photo_url' => 'photos/yakiniku.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '三子')->update(['photo_url' => 'photos/yakiniku.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '八戒')->update(['photo_url' => 'photos/izakaya.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '福助')->update(['photo_url' => 'photos/sushi.jpg']);
        \DB::table('restaurants')->where('restaurant_name', 'ラー北')->update(['photo_url' => 'photos/ramen.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '翔')->update(['photo_url' => 'photos/izakaya.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '経緯')->update(['photo_url' => 'photos/sushi.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '漆')->update(['photo_url' => 'photos/yakiniku.jpg']);
        \DB::table('restaurants')->where('restaurant_name', 'THE TOOL')->update(['photo_url' => 'photos/italian.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '木船')->update(['photo_url' => 'photos/sushi.jpg']);
        \DB::table('restaurants')->where('restaurant_name', 'ルーク大阪')->update(['photo_url' => 'photos/italian.jpg']);
        \DB::table('restaurants')->where('restaurant_name', 'ルーク福岡')->update(['photo_url' => 'photos/italian.jpg']);
        \DB::table('restaurants')->where('restaurant_name', 'ルーク東京')->update(['photo_url' => 'photos/italian.jpg']);

    }

    public function down()
    {
        \DB::table('restaurants')->where('restaurant_name', '仙人')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '牛助')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '戦慄')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg']);
        \DB::table('restaurants')->where('restaurant_name', 'ルーク')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '志摩屋')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '香')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg']);
        \DB::table('restaurants')->where('restaurant_name', 'JJ')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg']);
        \DB::table('restaurants')->where('restaurant_name', 'らーめん極み')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '鳥雨')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '築地色合')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '晴海')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '三子')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '八戒')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '福助')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg']);
        \DB::table('restaurants')->where('restaurant_name', 'ラー北')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '翔')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '経緯')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '漆')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg']);
        \DB::table('restaurants')->where('restaurant_name', 'THE TOOL')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg']);
        \DB::table('restaurants')->where('restaurant_name', '木舟')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg']);
        \DB::table('restaurants')->where('restaurant_name', 'ルーク大阪')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg']);
        \DB::table('restaurants')->where('restaurant_name', 'ルーク福岡')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg']);
        \DB::table('restaurants')->where('restaurant_name', 'ルーク東京')->update(['photo_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg']);
    }
}
