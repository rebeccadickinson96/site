<?php

namespace Tests\Feature\Api;

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
                    ]
                ]
            ])->assertJsonFragment([
                'id'             => $post->id,
                'title'          => $post->title,
                'body'           => $post->body,
                'date_published' => $post->date_published->format('Y-m-d H:i:s'),
                'published'      => $post->published,
                'published_by'   => [
                    'id'   => $post->User->id,
                    'name' => $post->User->name
                ],
            ]);
    }

}
