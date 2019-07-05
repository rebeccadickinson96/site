<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Post::class, 3)->create(['user_id' => 1, 'published' => 1, 'status' => 2]);
        factory(App\Post::class, 2)->create(['user_id' => 1, 'published' => 1, 'status' => 0]);
        factory(App\Post::class, 2)->create(['user_id' => 2, 'published' => 1, 'status' => 0]);
        factory(App\Post::class, 3)->create(['user_id' => 2, 'published' => 1, 'status' => 2]);
        factory(App\Post::class, 2)->create(['user_id' => 1, 'published' => 0]);
        factory(App\Post::class, 2)->create(['user_id' => 2, 'published' => 0]);
    }
}
