<?php

namespace Tests\Feature;

use App\Category;
use App\CategoryPost;
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
    public function it_adds_published_post_to_database()
    {
        $title = str_random();
        $body = str_random();
        $datePublished = Carbon::now()->format('Y-m-d H:i:s');

        factory(Post::class)->create([
            'title' => $title,
            'body' => $body,
            'user_id' => $this->user->id,
            'date_published' => $datePublished,
            'published' => 1

        ]);

        $this->assertDatabaseHas('posts', [
            'title' => $title,
            'body' => $body,
            'user_id' => $this->user->id,
            'date_published' => $datePublished,
            'published' => 1
        ]);

    }

    /**
     * @test
     */
    public function it_adds_draft_post_to_database()
    {
        $title = str_random();
        $body = str_random();
        $datePublished = Carbon::now()->format('Y-m-d H:i:s');

        factory(Post::class)->create([
            'title' => $title,
            'body' => $body,
            'user_id' => $this->user->id,
            'date_published' => $datePublished,
            'published' => 0

        ]);

        $this->assertDatabaseHas('posts', [
            'title' => $title,
            'body' => $body,
            'user_id' => $this->user->id,
            'date_published' => $datePublished,
            'published' => 0
        ]);

    }

    /**
     * @test
     */
    public function it_comments_on_a_post_signed_in()
    {
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
            'user_id' => $this->user->id,
            'commenter_name' => $this->user->name
        ]);
    }

    /**
     * @test
     */
    public function it_comments_on_a_post_not_signed_in()
    {
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
            'user_id' => null,
            'commenter_name' => 'Rebecca'
        ]);
    }

    /**
     * @test
     */
    public function it_adds_tags_to_a_post()
    {
        $post = factory(Post::class)->create();

        $cat1 = factory(Category::class)->create(['category' => str_random()]);

        $cat2 = factory(Category::class)->create(['category' => str_random()]);

        $cat3 = factory(Category::class)->create(['category' => str_random()]);

        $categories = [
            $cat1->id => [
                'category' => $cat1->id
            ],
            $cat2->id => [
                'category' => $cat2->id
            ],
            $cat3->id => [
                'category' => $cat3->id
            ]
        ];

        $post->addCategories($categories);

        $this->assertDatabaseHas('category_posts', ['post_id' => $post->id, 'category_id' => $cat1->id]);
        $this->assertDatabaseHas('category_posts', ['post_id' => $post->id, 'category_id' => $cat2->id]);
        $this->assertDatabaseHas('category_posts', ['post_id' => $post->id, 'category_id' => $cat3->id]);
    }

    /**
     * @test
     */
    public function it_removes_a_tag_from_a_post()
    {
        $post = factory(Post::class)->create();

        $cat1 = factory(Category::class)->create(['category' => str_random()]);

        $cat2 = factory(Category::class)->create(['category' => str_random()]);

        $cat3 = factory(Category::class)->create(['category' => str_random()]);

        factory(CategoryPost::class)->create([
            'post_id' => $post->id, 'category_id' => $cat1->id
        ]);
        factory(CategoryPost::class)->create([
            'post_id' => $post->id, 'category_id' => $cat2->id
        ]);
        factory(CategoryPost::class)->create([
            'post_id' => $post->id, 'category_id' => $cat3->id
        ]);

        $categories = [
            $cat1->id => [
                'category' => $cat1->id
            ],
            $cat3->id => [
                'category' => $cat3->id
            ]
        ];

        $post->addCategories($categories);

        $this->assertDatabaseHas('category_posts', ['post_id' => $post->id, 'category_id' => $cat1->id]);
        $this->assertDatabaseMissing('category_posts', ['post_id' => $post->id, 'category_id' => $cat2->id]);
        $this->assertDatabaseHas('category_posts', ['post_id' => $post->id, 'category_id' => $cat3->id]);
    }

    /**
     * @test
     */
    public function it_adds_a_tag_to_a_post()
    {
        $post = factory(Post::class)->create();

        $cat1 = factory(Category::class)->create(['category' => str_random()]);

        $cat2 = factory(Category::class)->create(['category' => str_random()]);

        $cat3 = factory(Category::class)->create(['category' => str_random()]);

        factory(CategoryPost::class)->create([
            'post_id' => $post->id, 'category_id' => $cat1->id
        ]);
        factory(CategoryPost::class)->create([
            'post_id' => $post->id, 'category_id' => $cat2->id
        ]);
        factory(CategoryPost::class)->create([
            'post_id' => $post->id, 'category_id' => $cat3->id
        ]);

        $cat4 = factory(Category::class)->create(['category' => str_random()]);
        $categories = [
            $cat1->id => [
                'category' => $cat1->id
            ],
            $cat2->id => [
                'category' => $cat2->id
            ],
            $cat3->id => [
                'category' => $cat3->id
            ],
            $cat4->id => [
                'category' => $cat4->id
            ]
        ];

        $post->addCategories($categories);

        $this->assertDatabaseHas('category_posts', ['post_id' => $post->id, 'category_id' => $cat1->id]);
        $this->assertDatabaseHas('category_posts', ['post_id' => $post->id, 'category_id' => $cat2->id]);
        $this->assertDatabaseHas('category_posts', ['post_id' => $post->id, 'category_id' => $cat3->id]);
        $this->assertDatabaseHas('category_posts', ['post_id' => $post->id, 'category_id' => $cat4->id]);
    }

    /**
     * @test
     */
    public function it_returns_published_on_a_published_post()
    {
        $post = factory(Post::class)->create([
            'date_published' => Carbon::now()->format('Y-m-d H:i:s'),
            'published' => 1
        ]);

        $this->assertEquals('Published', $post->status());
    }

    /**
     * @test
     */
    public function it_returns_scheduled_on_a_scheduled_post()
    {
        $post = factory(Post::class)->create([
            'date_published' => Carbon::now()->addDays(2)->format('Y-m-d H:i:s'),
            'published' => 1
        ]);

        $this->assertEquals('Scheduled', $post->status());
    }

    /**
     * @test
     */
    public function it_returns_draft_on_a_draft_post()
    {
        $post = factory(Post::class)->create([
            'published' => 0
        ]);

        $this->assertEquals('Draft', $post->status());
    }

}
