<?php

use App\Category;
use App\CategoryPost;
use App\Comment;
use App\Post;
use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext as Mink;
use Carbon\Carbon;
use Laracasts\Behat\Context\DatabaseTransactions;
use Behat\Mink\Driver\Selenium2Driver;
use PHPUnit_Framework_Assert as PHPUnit;
use Tests\TestCase;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends Mink implements Context
{
    use DatabaseTransactions;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {

    }

    /**
     * @Given I am logged in as email :email and password :password
     */
    public function iAmLoggedInAsEmailAndPassword($email, $password)
    {
        return array(
            Mink::visit('/login'),
            Mink::fillField('email', $email),
            Mink::fillField("password", $password),
            Mink::pressButton("Login"),
            Mink::assertPageContainsText("logout")
        );
    }


    /**
     * @Then I add category :category to the database
     */
    public function iAddCategoryToTheDatabase($category)
    {
        factory(Category::class)->create([
            'id' => 9992425,
            'category' => $category
        ]);
    }

    /**
     * @Then post adds to database with title :title body :body date :date and  user id :userId
     */
    public function postAddsToDatabaseWithTitleBodyDateAndUserId($title, $body, $date, $userId)
    {
        factory(Post::class)->create([
            'id' => 9867462,
            'title' => $title,
            'body' => $body,
            'date_published' => $date,
            'user_id' => $userId,
            'published' => 1
        ]);

        factory(CategoryPost::class)->create([
            'post_id' => 9867462,
            'category_id' => 9992425
        ]);
    }

    /**
     * @Given I am logged in as Admin
     */
    public function iAmLoggedInAsAdmin()
    {
        return array(
            Mink::visit('/login'),
            Mink::fillField('email', 'bexy-d@hotmail.com'),
            Mink::fillField("password", "rebecca1996"),
            Mink::pressButton("Login"),
            Mink::assertPageContainsText("logout")
        );
    }

    /**
     * @Given I am not logged in
     */
    public function iAmNotLoggedIn()
    {
        return Auth::guest();
    }

    /**
     * @Then post adds to database with title :title body :body and  user id :userId
     */
    public function postAddsToDatabaseWithTitleBodyAndUserId($title, $body, $userId)
    {
        $date = Carbon::now()->subMinutes(1)->format('Y-m-d H:i:s');
        factory(Post::class)->create([
            'id' => 9867461,
            'title' => $title,
            'body' => $body,
            'date_published' => $date,
            'user_id' => $userId,
            'published' => 1
        ]);

        factory(CategoryPost::class)->create([
            'post_id' => 9867461,
            'category_id' => 9992425
        ]);
    }

    /**
     * @Given I add category :category to the database with an id of :id
     */
    public function iAddCategoryToTheDatabaseWithAnIdOf($category, $id)
    {
        factory(Category::class)->create([
            'id' => $id,
            'category' => $category
        ]);
    }

    /**
     * @Then I update the post with title :title body :body
     */
    public function iUpdateThePostWithTitleBody($title, $body)
    {
        $post = Post::find(9867461);
        $post->update([
            'id' => 9867461,
            'title' => $title,
            'body' => $body,
        ]);
        $categories = [
            9992426 => [
                'category' => 9992426
            ]
        ];
        $post->addCategories($categories);
    }

    /**
     * @When I add the comment :comment by :name
     */
    public function iAddTheCommentBy($comment, $name)
    {
        factory(Comment::class)->create([
            'post_id' => "9867461",
            'body' => $comment,
            'user_id' => null,
            "commenter_name" => $name
        ]);
    }

    /**
     * @When I add the comment :comment by Rebecca Dickinson
     */
    public function iAddTheCommentByRebeccaDickinson($comment)
    {
        factory(Comment::class)->create([
            'post_id' => "9867461",
            'body' => $comment,
            'user_id' => 1,
            "commenter_name" => 'Rebecca Dickinson'
        ]);
    }

    /**
     * @When I add category :category and description :description to the database
     */
    public function iAddCategoryAndDescriptionToTheDatabase($category, $description)
    {
        factory(Category::class)->create([
            'id' => 9992425,
            'category' => $category,
            'description' => $description
        ]);
    }

    /**
     * @When I update the category to category :category and description :description
     */
    public function iUpdateTheCategoryToCategoryAndDescription($category, $description)
    {
        $cat = Category::find(9992425);
        $cat->update([
            'id' => 9867461,
            'category' => $category,
            'description' => $description
        ]);
    }

    /**
     * @When I fill in :field with todays date and time
     */
    public function iFillInWithTodaysDateAndTime($field)
    {
        $field = Mink::fixStepArgument($field);
        $value = Mink::fixStepArgument(Carbon::now()->format('Y-m-d H:i:s'));
        Mink::getSession()->getPage()->fillField($field, $value);
    }

    /**
     * @When I add the draft post to the database
     */
    public function iAddTheDraftPostToTheDatabase()
    {
        factory(Post::class)->create([
            'id' => 9867461,
            'title' => 'Lorem Ipsum',
            'body' => 'I am a draft post',
            'date_published' => Carbon::now()->format('Y-m-d H:i:s'),
            'user_id' => 1,
            'published' => 0
        ]);
    }

    /**
     * @When I fill in :field with the date a month after today
     */
    public function iFillInWithTheDateAMonthAfterToday($field)
    {
        $field = Mink::fixStepArgument($field);
        $value = Mink::fixStepArgument(Carbon::now()->addMonth(1)->format('Y-m-d H:i:s'));
        Mink::getSession()->getPage()->fillField($field, $value);
    }

    /**
     * @When I add the scheduled post to the database
     */
    public function iAddTheScheduledPostToTheDatabase()
    {
        factory(Post::class)->create([
            'id' => 9867461,
            'title' => 'Lorem Ipsum',
            'body' => 'I am a scheduled post',
            'date_published' => Carbon::now()->addMonth(1)->format('Y-m-d H:i:s'),
            'user_id' => 1,
            'published' => 0
        ]);
    }

    /**
     * @When I update the post to published status
     */
    public function iUpdateThePostToPublishedStatus()
    {
        $post = Post::find(9867461);
        $post->update([
            'published' => 1
        ]);
    }

    /**
     * @When I update the post to draft status
     */
    public function iUpdateThePostToDraftStatus()
    {
        $post = Post::find(9867461);
        $post->update([
            'published' => 0
        ]);
    }

    /**
     * @Given I add a post with title :title body :body and  user id :userId
     */
    public function iAddAPostWithTitleBodyAndUserId($title, $body, $userId)
    {
        $date = Carbon::now()->subMinutes(1)->format('Y-m-d H:i:s');
        factory(Post::class)->create([
            'id' => 9867461,
            'title' => $title,
            'body' => $body,
            'date_published' => $date,
            'user_id' => $userId,
            'published' => 1
        ]);
    }
}
