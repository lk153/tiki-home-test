<?php
namespace Tests;

use PHPUnit\Framework\TestCase;

use App\Model\User;
use App\Model\UserGroup;
use App\Model\Product;
use App\Model\CartItem;
use App\Model\ShoppingCart;
use App\Model\ShoppingCartPriceRule;

class HomeTest extends TestCase
{
    /** @var ShoppingCart $cart */
    protected $cart;

    public function setUp()
    {
        parent::setUp();
        $iphoneSilver = new Product('Iphone', 'Silver', '999');
        $iphoneBlack = new Product('Iphone', 'Black', '899');
        $user = new User('John Doe 1', 'john.doe@example.com', UserGroup::GOLD);
        $this->cart = $user->initCart();

        $cartItem1 = new CartItem($iphoneSilver, 2);
        $this->cart->addCartItem($cartItem1);

        $cartItem2 = new CartItem($iphoneBlack, 1);
        $this->cart->addCartItem($cartItem2);
    }


    public function testTotalPriceBeforeDiscount()
    {
        $actual = $this->cart->calculateTotalPrice();
        $expected = 2897;
        $this->assertEquals($expected, $actual);
    }

    public function testTotalPriceAfterDiscount()
    {
        $discountRule = new ShoppingCartPriceRule(UserGroup::GOLD, new \DateTime('2018-08-31'), new \DateTime('2018-09-31'), 50, 'Black', 1500);
        $actual = $this->cart->getGrandTotal();
        $expected = 2897;
        $this->assertEquals($expected, $actual);
    }
}