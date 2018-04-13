<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostApiController extends ApiController
{
    public function index() {

        $posts = Post::with('User')->get()->map(function ($project) {
                return $project->transform();
            });

        return $this->respondOK('All posts bought down', ['posts' => $posts]);
    }
}
