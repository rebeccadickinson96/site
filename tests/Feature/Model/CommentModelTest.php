<?php

namespace Tests\Feature\Model;

use App\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentModelTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_returns_pending_if_approved_0() {
        $comment = factory(Comment::class)->create([
            'approved' => 0
        ]);

        $this->assertEquals('pending', $comment->status);
    }

    /**
     * @test
     */
    public function it_returns_declined_if_approved_1() {
        $comment = factory(Comment::class)->create([
            'approved' => 1
        ]);

        $this->assertEquals('declined', $comment->status);
    }

    /**
     * @test
     */
    public function it_returns_approved_if_approved_2() {
        $comment = factory(Comment::class)->create([
            'approved' => 2
        ]);

        $this->assertEquals('approved', $comment->status);
    }
}
