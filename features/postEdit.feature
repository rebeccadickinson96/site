Feature: Editing a post

  Background: Logged in and post exists
    Given I am logged in as Rebecca Dickinson
    And I add category "baking123" to the database
    And post adds to database with title "Lorem Ipsum" body "I am the post body" and  user id "1"

  Scenario: Accessing the editing page
    Given I am on "/posts"
    When I follow "edit9867461"
    Then I am on "/posts/9867461/edit"
    And the "title" field should contain "Lorem Ipsum"
    And the "body" field should contain "I am the post body"
    And the "baking123" checkbox should be checked

  Scenario: Updating the fields values
    Given I am on "/posts/9867461/edit"
    When I fill in the following:
      | title | annemarie           |
      | body  | I have been edited. |
    Then the "title" field should contain "annemarie"
    And the "title" field should not contain "Lorem Ipsum"
    And the "body" field should contain "I have been edited."
    And the "body" field should not contain "I am the post body"

  Scenario: Update the categories of the post
    Given I add category "cooking" to the database with an id of "9992426"
    And I am on "/posts/9867461/edit"
    And the "baking123" checkbox should be checked
    And I should see "cooking"
    When I check "cooking"
    And I uncheck "baking123"
    Then the "cooking" checkbox should be checked
    Then the "baking123" checkbox should not be checked

  Scenario: Update the post
    Given I am on "/posts/9867461/edit"
    And I add category "cooking" to the database with an id of "9992426"
    When I press "Submit"
    And I update the post with title "annemarie" body "I have been edited"
    And I am on "/posts/9867461"
    Then I should see "annemarie"
    And I should see "I have been edited"