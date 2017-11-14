Feature: Testing

  Scenario: Home Page
    Given I am on the homepage
    Then I should see "posts experiment"

  Scenario: Login link leads to login
    When I go to "login"
    Then the url should match "/login"
    Then  I should see "login"
    And  I should see "e-mail address"
    And  I should see "password"
    Then I fill in "email" with "bexy-d@hotmail.com"
    Then I fill in "password" with "rebecca1996"
    When I press "Login"
    Then the url should match "/"
    And I am on the homepage
    Then  I should see "Rebecca Dickinson"
    And I should not see "Login"
    And I should not see "Register"

  Scenario: Creating a Post
    Given I am on "/posts/"
    And I am logged in as email "bexy-d@hotmail.com" and password "rebecca1996"

    When I follow "New Post +"
    Then I am on "/posts/create"
    When I fill in "title" with "Lorem Ipsum"
    And  I fill in "body" with "I am the post body"
    And  I fill in "date_published" with "14/11/2017 10:30"

    When I follow "Add Tag"
    Then I should see "Add Tag"
    And  I should see "Tag*"
    Then I fill in "category" with "baking123"
    And the "category" field should contain "baking123"

    When I am on "/posts/create/categories"
    Then I add category "baking123" to the database
    Then I am on "posts/create"
    Then I should see "baking123"

    When I check "baking123"
    And the "baking123" checkbox should be checked

    When I press "Submit"
    Then post adds to database with title "Lorem Ipsum" body "I am the post body" date "2017-11-14 10:30:00" and  user id "1"
    Then I am on "/posts"
    Then the url should match "/posts"
    And I should see "Posts List"
    And I should see "Lorem Ipsum"
    And I should see "I am the post body"
    Then I follow "Posts Experiment"
    Then the url should match "/"
    And I am on the homepage
    And I should see "Lorem Ipsum"
    And I should see "I am the post body"
    And I should see "baking123"


