Feature: Tests for subscriber role

  @sub
  Scenario: Logging in as a subscriber
    Given I am on "/login"
    When I fill in "email" with "blogsitesub@hotmail.com"
    And I fill in "password" with "password"
    Then I am logged in as Subscriber
    And I am on the homepage
    And I should see "Jane Doe"
    But I should not see "Login"
    And I should not see "Register"

  @sub
  Scenario: Subscriber can't see certain items of dropdown menu
    Given I am logged in as Subscriber
    And I am on the homepage
    When I follow "Posts"
    Then I should see "All"
    But I should not see "Published"
    And I should not see "Scheduled"
    And I should not see "Drafts"


  @sub
  Scenario: Subscriber can't get onto published page
    Given I am logged in as Subscriber
    When I am on "/posts/published"
    Then I should see "403"

  @sub
  Scenario: Subscriber can't get onto scheduled page
    Given I am logged in as Subscriber
    When I am on "/posts/scheduled"
    Then I should see "403"

  @sub
  Scenario: Subscriber can't get onto drafts page
    Given I am logged in as Subscriber
    When I am on "/posts/drafts"
    Then I should see "403"