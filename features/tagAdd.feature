Feature: Adding a tag

  Background: Logged in
    Given I am logged in as Admin


  Scenario: Accessing the tags page
    Given I am on the homepage
    And I should see "Tags"
    When I follow "Tags"
    Then I should be on "/categories"


  Scenario: opening the category modal
    Given I am on "/categories"
    When I follow "Add Tag +"
    Then I should see "Add Tag"
    And I should see "Tag*"
    And I should see "Description (Optional)"

  Scenario: Adding the categories to the database
    Given I am on "/categories"
    When I follow "Add Tag +"
    And I fill in the following:
      | category    | Entertainment   |
      | description | I am Entertainment |
    #test for the submit button
    And I add category "Entertainment" and description "I am Entertainment" to the database
    Then I am on "/categories"
    And I should see "Entertainment"