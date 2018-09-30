# Tiki Corporation - Home Test For Backend Developer

#### Description:

Write a basic eCommerce program in PHP that models a User, Product, ShoppingCart and
Promotion Rule.

* Products have a name, color and price.
* Users have a name, email, group (UNREGISTER, REGISTER, SLIVER, GOLD), and
associated ShoppingCart.
* ShoppingCarts have an associated User and list of Products.
* A User can add or remove a Product from their ShoppingCart.
* A ShoppingCart must be able to provide a total price for its list of Products.
* ShoppingCart price rules create discounts for carts based on a set of conditions. The
discount can be applied automatically when the conditions are met.
* A ShoppingCart price rule condition contains:
    * From Date: the start date for the promotion.
    * To Date: the end date for the promotion.
    * User Group: which user group the rule should apply to.
    * Color & Subtotal: if specified, the rule is met if all products with the Rule Color
have the total price greater than the Rule Subtotal.
    * Discount: the amount of the discount on the ShoppingCart

The code must pass two tests:
1) Create a User "John Doe 1", Group GOLD with email address "john.doe@example.com",
then add 2 "Iphone Sliver" Products for $999 each and 1 "Iphone Black" Product for
$899. Check that the ShoppingCart total price is correct.
2) Create a Rule with From Date, To Date, User Group GOLD, Color Black, Subtotal 1500$,
Discount: 50$
3) Check the ShoppingCart total after applying the promotion rule.
You may either use unit tests to run the tests or a simple script which can be run via the
command line.

Notes:

    * You should NOT use a full-featured framework, just plain code.
    * No database, user interaction or other functionality is required (so no HTML/CSS/JavaScript);
    it just needs to be the code which runs and passes the tests

# Installation

#### Requirements
* Docker: php, composer

#### Setup steps
1) Run install.sh file at root folder of this project.

#### Run Test

1) Access running docker container.


    docker exec -it tiki-home-test-container bash
2) Run command for executing test suite.


    ./vendor/bin/phpunit --bootstrap vendor/autoload.php --testdox tests
#### Run on Browser
    
    http://localhost
    
# Note of Assumption

* Product Model have sku property for identification purpose and cart item use it for manage added product.
* Per cart item manage only one product with added quantity
* Per user use only one shopping cart.
* Shopping cart manage added product through cart item for below purpose:
    * Make cart manage and calculate cart total easier.
    * Can extend with other discount type like Catalog Price Rule.
* Total price after discount will calculate automatically when cart instance call action to get grand total.

    

    