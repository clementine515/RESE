<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class SaveRestaurantPhotos extends Command
{
    protected $signature = 'photos:save';
    protected $description = 'Save restaurant photos from URLs to storage';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $restaurants = Restaurant::whereNotNull('photo_url')->get();

        foreach ($restaurants as $restaurant) {
            $photoUrl = $restaurant->photo_url;
            $photoContents = Http::get($photoUrl)->body();

            if ($photoContents) {
                $filename = basename($photoUrl);
                $path = 'public/photos/' . $filename;

                Storage::put($path, $photoContents);

                $restaurant->photo_url = Storage::url($path);
                $restaurant->save();

                $this->info("Saved photo for restaurant ID {$restaurant->id} to {$path}");
            } else {
                $this->error("Failed to fetch photo from URL: {$photoUrl}");
            }
        }

        $this->info('All photos have been processed.');
    }
}
