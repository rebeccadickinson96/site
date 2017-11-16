Feature: Handling Posts

  Background: Checking that a user is logged in
    Given I am logged in as Rebecca Dickinson

  Scenario: Accessing the create posts page
    Given I am on "/posts"
    When I follow "New Post +"
    Then I am on "/posts/create"

  Scenario: Filling out the posts create form
    Given I am on "/posts/create"
    When I fill in "title" with "Lorem Ipsum"
    And  I fill in "body" with "I am the post body"
    And  I fill in "date_published" with "14/11/2017 10:30"
    Then the "title" field should contain "Lorem Ipsum"
    And the "body" field should contain "I am the post body"
    And the "date_published" field should contain "14/11/2017 10:30"

  Scenario: Opening the add categories modal
    Given I am on "/posts/create"
    When I follow "Add Tag"
    Then I should see "Add Tag"
    And I should see "Tag*"

  Scenario: Adding a category from the create post page
    Given I am on "/posts/create"
    When I follow "Add Tag"
    And I fill in "category" with "baking123"
    And the "category" field should contain "baking123"
    Then I am on "/posts/create/categories"
    And I add category "baking123" to the database
    And I am on "posts/create"
    And I should see "baking123"

  Scenario: Checking the category checkbox
    Given I add category "baking123" to the database
    And I am on "/posts/create"
    When I check "baking123"
    Then the "baking123" checkbox should be checked

  Scenario: adding post to the database
    Given I add category "baking123" to the database
    And I am on "/posts/create"
    When I press "Submit"
    Then post adds to database with title "Lorem Ipsum" body "I am the post body" and  user id "1"
    And I am on "/posts"
    And I should see "Posts List"
    And I should see "Lorem Ipsum"
    And I should see "I am the post body"

  Scenario: The Post should show on the homepage
    Given I add category "baking123" to the database
    And post adds to database with title "Lorem Ipsum" body "I am the post body" and  user id "1"
    And I am on "/posts"
    When I follow "Posts Experiment"
    Then I am on the homepage
    And I should see "Lorem Ipsum"
    And I should see "I am the post body"
    And I should see "baking123"

  Scenario: I can access the posts page
    Given I add category "baking123" to the database
    And post adds to database with title "Lorem Ipsum" body "I am the post body" and  user id "1"
    And I am on the homepage
    When I follow "Lorem Ipsum"
    Then I am on "/posts/9867461"
    And I should see "Lorem Ipsum"
    And I should see "I am the post body"
    And I should see "baking123"
    And I should see "Comment"