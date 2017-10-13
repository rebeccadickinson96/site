<?php

namespace Tests\Feature;

use App\Comment;
use App\Post;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostsModelTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;

    protected function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

    }
    /**
     * @test
     */
    public function it_adds_posts_to_database(){
        $title = str_random();
        $body = str_random();
        $datePublished = Carbon::now()->format('Y-m-d H:i:s');

        factory(Post::class)->create([
            'title' => $title,
            'body' => $body,
            'user_id' => $this->user->id,
            'date_published' => $datePublished,

        ]);

        $this->assertDatabaseHas('posts', [
            'title' => $title,
            'body' => $body,
            'user_id' =>  $this->user->id,
            'date_published' => $datePublished,
        ]);

    }

    /**
     * @test
     */
    public function it_comments_on_a_post_signed_in(){
        $post = factory(Post::class)->create();

        $comment = str_random();

        factory(Comment::class)->create([
            'post_id' => $post->id,
            'body' => $comment,
            'user_id' => $this->user->id,
            'commenter_name' => $this->user->name
        ]);
        $this->assertDatabaseHas('comments', [
            'post_id' => $post->id,
            'body' => $comment,
            'user_id' =>  $this->user->id,
            'commenter_name' => $this->user->name
        ]);
    }

    /**
     * @test
     */
    public function it_comments_on_a_post_not_signed_in(){
        $post = factory(Post::class)->create();

        $comment = str_random();

        factory(Comment::class)->create([
            'post_id' => $post->id,
            'body' => $comment,
            'commenter_name' => 'Rebecca'
        ]);
        $this->assertDatabaseHas('comments', [
            'post_id' => $post->id,
            'body' => $comment,
            'user_id' =>  null,
            'commenter_name' => 'Rebecca'
        ]);
    }
}
