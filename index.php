<?php
require_once 'vendor/autoload.php';

use App\Model\User;
use App\Model\UserGroup;
use App\Model\Product;
use App\Model\CartItem;
use App\Model\ShoppingCartPriceRule;

echo "Thanks Tiki Coporation for this home test.<hr>";

//Define notify message for action
$createdProductMsg = "%s %s $%d is created <br>";
$createdUserMsg = "%s is created with email: %s in User Group: %s<br>";
$createdCartMsg = "Shopping Cart is initialized<br>";
$createdDiscountRule = "Shopping Cart Price rule is created<br>";
$buyMsg = "Bought %d %s %s<br>";

//Create products
$iphoneSilver = new Product('Iphone', 'Silver', '999');
printf($createdProductMsg, $iphoneSilver->getName(), $iphoneSilver->getColor(), $iphoneSilver->getPrice());

$iphoneBlack = new Product('Iphone', 'Black', '899');
printf($createdProductMsg, $iphoneBlack->getName(), $iphoneBlack->getColor(), $iphoneBlack->getPrice());

//Create user
$user = new User('John Doe 1', 'john.doe@example.com', UserGroup::GOLD);
printf($createdUserMsg, $user->getName(), $user->getEmail(), (new UserGroup())->getGroupNameById($user->getGroup()));

//Go shopping
$cart = $user->initCart();
printf($createdCartMsg);

//Create shopping cart price rule
$discountRule = new ShoppingCartPriceRule(UserGroup::GOLD, new \DateTime('2018-08-30'), new \DateTime('2018-10-30'), 50, 'Black', 1500);
printf($createdDiscountRule);

//User buy some products
$cartItem1 = new CartItem($iphoneSilver, 2);
$cartItem2 = new CartItem($iphoneBlack, 1);
$cart->addCartItem($cartItem1)
    ->addCartItem($cartItem2);

printf($buyMsg, $cartItem1->getQty(), $cartItem1->getProduct()->getName(), $cartItem1->getProduct()->getColor());
printf($buyMsg, $cartItem2->getQty(), $cartItem2->getProduct()->getName(), $cartItem2->getProduct()->getColor());

//Get Total Price
printf("Total Price before discount: %d <br>", $cart->calculateTotalPrice());

//Get Total Price after discount
printf("Total Price after discount: %d <br>", $cart->getGrandTotal());


