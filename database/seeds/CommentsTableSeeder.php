<?php

use Illuminate\Database\Seeder;
use App\Comment;
use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $posts = Post::where('published', 1)->get();

        foreach ($posts as $post) {
            
            for ($i=0; $i < rand(0, 4); $i++) { 
                $newComment = new Comment();

                $newComment->post_id = $post->id;
                // name nullable
                if (rand(0,1)) {
                    $newComment->name = $faker->name();
                }
                $newComment->content = $faker->text();
                $newComment->save();
            }
        }
    }
}
