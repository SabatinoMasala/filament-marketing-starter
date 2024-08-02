<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Artisan::call('app:ensure-default-settings');
        DB::table('pages')->insert([
            [
                'title' => '{"en": "Home", "fr": "Home"}',
                'slug' => '{"en": "home", "fr": "home"}',
                'content' => file_get_contents(base_path('data/home.json')),
                'created_at' => now()->timestamp,
                'updated_at' => now()->timestamp,
            ],
            [
                'title' => '{"en": "Blog", "fr": "Blog"}',
                'slug' => '{"en": "blog", "fr": "blog"}',
                'content' => file_get_contents(base_path('data/blog.json')),
                'created_at' => now()->timestamp,
                'updated_at' => now()->timestamp,
            ]
        ]);
        DB::table('posts')->insert([
            [
                'title' => '{"en": "Hello World!", "fr": "Bonjour Monde!"}',
                'slug' => '{"en": "hello-world", "fr": "bonjour-monde"}',
                'published_at' => now()->startOfDay()->startOfYear()->timestamp,
                'short_description' => '{"en": "This is an example article", "fr": "Ceci est un exemple d\'article"}',
                'content' => file_get_contents(base_path('data/helloworld.json')),
                'created_at' => now()->timestamp,
                'updated_at' => now()->timestamp,
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \App\Models\Setting::all()->each->delete();
        \App\Models\Page::all()->each->delete();
    }
};
