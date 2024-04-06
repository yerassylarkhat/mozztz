<?php

namespace Database\Seeders;

use App\Enums\PostStatus;
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
        for($i = 0; $i<5; $i++){
            $post = new Post();
            $post->author_id = rand(2, 11); // Генерируем случайный author_id от 2 до 11
            $post->title = "Тестовый пост " . ($i + 1);
            $post->content = "Это содержание тестового поста " . ($i + 1);
            $post->status = PostStatus::PUBLISHED; // Генерируем случайный статус
            $post->save();
        }
    }
}
