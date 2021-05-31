<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'title' => "Percobaan data",
            'content' => "ini Content",
            'slug' => "percobaan-data"
        ]);
        Post::create([
            'title' => "Percobaan data API",
            'content' => "ini Content API",
            'slug' => "percobaan-data-api"
        ]);
    }
}
