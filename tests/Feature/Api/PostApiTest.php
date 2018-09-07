<?php

namespace Tests\Feature\Api;

use App\Category;
use App\CategoryPost;
use App\Comment;
use App\Post;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostApiTest extends TestCase
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
    public function it_shows_all_posts()
    {
        $post = factory(Post::class)->create([
            'user_id' => $this->user->id
        ]);

        $comment = factory(Comment::class)->create([
            'post_id' => $post->id,
            'user_id' => null
        ]);

        $tag = factory(Category::class)->create(['category' => str_random()]);

        factory(CategoryPost::class)->create([
            'post_id'     => $post->id,
            'category_id' => $tag->id
        ]);

        $this->json('get', 'api/posts/?api_token=' . $this->user->api_token)
            ->assertJsonStructure([
                'error',
                'message',
                'posts' => [
                    [
                        'id',
                        'title',
                        'body',
                        'date_published',
                        'published',
                        'published_by' => [
                            'id',
                            'name'
                        ],
                        'tags'         => [
                            [
                                'id',
                                'tag'
                            ]
                        ],
                        'comments'     => [
                            [
                                'body',
                                'commenter_name',
                                'date',
                                'id',

                            ]
                        ]
                    ]
                ]
            ]);
    }

}
