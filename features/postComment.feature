Feature: Commenting on a post

  Background: Post is created and on that posts page
    Given I add category "baking123" to the database
    And post adds to database with title "Lorem Ipsum" body "I am the post body" and  user id "1"



  Scenario: commenting not logged in
    Given I am not logged in
    And I am on "/posts/9867461/"
    And I should see "Add a comment"
    When I fill in the following:
      | commenter_name | Bob            |
      | body           | I am a Comment |
    And the "commenter_name" field should contain "Bob"
    And the "body" field should contain "I am a Comment"
    And I press "Submit"
    And I add the comment "I am a comment" by "Bob"
    Then I should see "I am a Comment"

  Scenario: commenting logged in
    Given I am logged in as Rebecca Dickinson
    And I am on "/posts/9867461/"
    And I should see "Add a comment"
    When I fill in the following:
      | body           | I am a Comment |
    And the "body" field should contain "I am a Comment"
    And I press "Submit"
    And I add the comment "I am a comment" by Rebecca Dickinson
    Then I should see "I am a Comment"
