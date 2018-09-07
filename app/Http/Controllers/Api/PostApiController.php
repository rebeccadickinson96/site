<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostApiController extends ApiController
{

    /**
     * @api {get} /posts Get Posts
     * @apiDescription Retrieve all posts
     * @apiGroup Posts
     *
     * @apiParam {String} api_token Token received when user logged in
     *
     * @apiSuccess {Boolean} error Indication of whether the call threw an error
     * @apiSuccess {String} message Message Result
     * @apiSuccess {Object[]} posts Array of posts
     * @apiSuccess {Integer} posts.id ID of post
     * @apiSuccess {String} posts.title Title of post
     * @apiSuccess {String} posts.body Body of post
     * @apiSuccess {String} posts.date_published Date post was published
     * @apiSuccess {Boolean} posts.published Flag if post is published
     * @apiSuccess {Object[]} posts.published_by Object to show the publishers details
     * @apiSuccess {Integer} posts.published_by.id ID of publisher
     * @apiSuccess {String} posts.published_by.name Name of post publisher
     * @apiSuccess {Object[]} posts.tags Object to show the tags of the post
     * @apiSuccess {Integer} posts.tags.id ID of tag
     * @apiSuccess {String} posts.tags.tag Name of tag
     * @apiSuccess {Object[]} posts.comments Object to show the comments on the post
     * @apiSuccess {Integer} posts.comments.id ID of comment
     * @apiSuccess {String} posts.comments.body Comment text
     * @apiSuccess {String} posts.comments.date Date of comment
     * @apiSuccess {String} posts.comments.commenter_name Name of commenter
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "error": false,
     *          "message": "All posts bought down"
     *          "posts": [
     *              {
     *                  "id": 2,
     *                  "title": "I am the title",
     *                  "body": "I am the body",
     *                  "date_published": "2018-09-07 12:00:00",
     *                  "published": 0,
     *                  "published_by": {
     *                      "id": "1",
     *                      "name": "Rebecca Dickinson",
     *                  },
     *                  "tags": {
     *                      "id": 1,
     *                      "tag":"Entertainment"
     *                  },
     *                  "comments": {
     *                      "id": 1,
     *                      "body": "I am a comment",
     *                      "date": "2018-09-07 13:00:00"
     *                      "commenter_name": "Charlotte"
     *                 }
     *              }
     *          ]
     *      }
     */
    public function index()
    {

        $posts = Post::with('User', 'comments', 'categories')->get()->map(function ($project) {
            return $project->transform();
        });

        return $this->respondOK('All posts bought down', ['posts' => $posts]);
    }
}
