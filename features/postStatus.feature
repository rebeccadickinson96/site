Feature: Testing Post Statuses

  Background: Logged in
    Given I am logged in as Admin

  Scenario: Accessing the posts index page from the homepage
    Given I am on the homepage
    When I follow "Posts"
    And I follow "All"
    Then I am on "/posts"
    And I should see "Posts Index"

  Scenario: Accessing the published posts page from the homepage
    Given I am on the homepage
    When I follow "Posts"
    And I follow "Published"
    Then I am on "/posts/published"
    And I should see "Published Posts"

  Scenario: Accessing the scheduled posts page from the homepage
    Given I am on the homepage
    When I follow "Posts"
    And I follow "Scheduled"
    Then I am on "/posts/scheduled"
    And I should see "Scheduled Posts"

  Scenario: Accessing the draft posts page from the homepage
    Given I am on the homepage
    When I follow "Posts"
    And I follow "Drafts"
    Then I am on "/posts/drafts"
    And I should see "Draft Posts"

  Scenario: Accessing the posts page from the posts page
    Given I am on "/posts"
    When I follow "All"
    Then I am on "/posts"
    And I should see "Posts Index"

  Scenario: Accessing the published posts page from the posts page
    Given I am on "/posts"
    When I follow "Published"
    Then I am on "/posts/published"
    And I should see "Published Posts"

  Scenario: Accessing the scheduled posts page from the posts page
    Given I am on "/posts"
    When I follow "Scheduled"
    Then I am on "/posts/scheduled"
    And I should see "Scheduled Posts"

  Scenario: Accessing the draft posts page from the posts page
    Given I am on "/posts"
    When I follow "Drafts"
    Then I am on "/posts/drafts"
    And I should see "Draft Posts"

  Scenario: Uploading a draft post
    Given I am on "posts/create"
    When I fill in the following:
      | title | Lorem Ipsum        |
      | body  | I am a draft post |
    And I fill in "date_published" with todays date and time
    And I select "Draft" from "published"
    And I press "Submit"
    And I add the draft post to the database
    Then I am on "/posts"
    And I should see "Lorem Ipsum"

  Scenario: The draft post is not on the homepage
    Given I add the draft post to the database
    And I am on "/posts"
    When I follow "Posts Experiment"
    Then I should not see "Lorem Ipsum"
    And I should not see "I am a draft post"

  Scenario: Uploading a scheduled post
    Given I am on "posts/create"
    When I fill in the following:
      | title | Lorem Ipsum        |
      | body  | I am a scheduled post |
    And I fill in "date_published" with the date a month after today
    And I select "Draft" from "published"
    And I press "Submit"
    And I add the scheduled post to the database
    Then I am on "/posts"
    And I should see "Lorem Ipsum"

  Scenario: The scheduled post is not on the homepage
    Given I add the scheduled post to the database
    And I am on "/posts"
    When I follow "Posts Experiment"
    Then I should not see "Lorem Ipsum"
    And I should not see "I am a scheduled post"



