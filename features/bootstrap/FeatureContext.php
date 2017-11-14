<?php

use App\Category;
use App\CategoryPost;
use App\Post;
use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Laracasts\Behat\Context\DatabaseTransactions;
use Behat\Mink\Driver\Selenium2Driver;
use PHPUnit_Framework_Assert as PHPUnit;
use Tests\TestCase;
/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
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
        Behat\MinkExtension\Context\MinkContext::visit('/login'),
        Behat\MinkExtension\Context\MinkContext::fillField('email', $email),
        Behat\MinkExtension\Context\MinkContext::fillField("password", $password),
        Behat\MinkExtension\Context\MinkContext::pressButton("Login"),
        Behat\MinkExtension\Context\MinkContext::assertPageContainsText("logout")
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
            'user_id' => $userId
        ]);

        factory(CategoryPost::class)->create([
            'post_id' => 9867462,
            'category_id' => 9992425
        ]);
    }
}
