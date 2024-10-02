<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenresTableSeeder extends Seeder
{
    public function run()
    {
        $genres = [
            '寿司',
            '焼肉',
            '居酒屋',
            'イタリアン',
            'ラーメン',
        ];

        foreach ($genres as $genre) {
            Genre::create([
                'genre_name' => $genre,
            ]);
        }
    }
}
