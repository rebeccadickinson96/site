Feature: Tests for subscriber role

  @sub
  Scenario: Logging in as a subscriber
    Given I am not logged in
    And I am on "/login"
    When I fill in "email" with "blogsitesub@hotmail.com"
    And I fill in "password" with "password"
#    And I press "Login"
   Then I am logged in as Subscriber
#    And I am on the homepage