Feature: Editing a tag

  Background: Loggedin & category created
    Given I am logged in as Rebecca Dickinson
    And I add category "Entertainment" and description "I am Entertainment" to the database


  Scenario: Opening the edit categories modal
    Given I am on "/categories"
    When I follow "tag9992425"
    Then I should see "Edit Tag"
    And I should see "Tag*"
    And I should see "Description (Optional)"

  Scenario: Updating the category
    Given I am on "/categories"
    When I follow "tag9992425"
    And I fill in the following:
      | category    | Entertainer      |
      | description | I am Entertainer |
    And I am on "/categories"
    And I update the category to category "Entertainer" and description "I am Entertainer"
    Then I am on "/categories"
    And I should see "Entertainer"
    And I should not see "Entertainment"
