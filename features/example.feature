Feature: Testing

  Scenario: Home Page
    Given I am on the homepage
    Then I should see "posts experiment"

  Scenario: Login link leads to login
    When I go to "login"
    Then the url should match "/login"
    Then  I should see "login"