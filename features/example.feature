Feature: Testing

  Scenario: Home Page
    Given I am on the homepage
    Then I should see "posts experiment"

  Scenario: Login link leads to login
    When I go to "login"
    Then the url should match "/login"
    Then  I should see "login"
    And  I should see "e-mail address"
    And  I should see "password"
    When I fill in "email" with "bexy-d@hotmail.com"
    When I fill in "password" with "rebecca1996"
    When I press "Login"
    Then the url should match "/"
    And I am on the homepage
    Then  I should see "Rebecca Dickinson"