Feature: Testing

  Scenario: Home Page
    Given I am on the homepage
    Then I should see "posts experiment"

  Scenario: Login link leads to login
    Given I am not logged in
    And I am on the homepage
    When I follow "Login"
    Then the url should match "/login"
    And  I should see "login"
    And  I should see "e-mail address"
    And  I should see "password"

  Scenario: Actually logging in
    Given I am on "/login"
    When I fill in "email" with "bexy-d@hotmail.com"
    And I fill in "password" with "rebecca1996"
    And I press "Login"
    Then I am on the homepage
    And I should see "Rebecca Dickinson"
    But I should not see "Login"
    And I should not see "Register"