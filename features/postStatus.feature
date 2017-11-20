Feature: Testing Post Statuses

  Background: Logged in
    Given I am logged in as Admin

    #accessing the different pages

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

# this is the same on all pages

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

#




