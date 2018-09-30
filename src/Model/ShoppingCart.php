<?php
declare(strict_types=1);

namespace App\Model;

class ShoppingCart
{
    private $cartItems;
    private $user;
    private $grandTotal;

    /**
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->cartItems = [];
    }

    /**
     * @return array
     */
    public function getCartItems() : array
    {
        return $this->cartItems;
    }

    /**
     * Add cart item into shopping cart
     * @param CartItem $cartItem
     * @return ShoppingCart
     */
    public function addCartItem(CartItem $cartItem) : ShoppingCart
    {
        $this->cartItems[$cartItem->getProduct()->getSku()] = $cartItem;

        return $this;
    }

    /**
     * Remove cart item from shopping cart
     * @param CartItem $cartItem
     * @return ShoppingCart
     */
    public function removeCartItem($cartItem) : ShoppingCart
    {
        unset($this->cartItems[$cartItem->getProduct()->getSku()]);

        return $this;
    }

    /**
     * @return User
     */
    public function getUser() : User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user) : void
    {
        $this->user = $user;
    }

    /**
     * Get total price in Shopping Cart
     *
     * @return float
     */
    public function calculateTotalPrice() : float
    {
        $totalPrice = 0.0;
        foreach ($this->cartItems as $cartItem) {
            if ($cartItem instanceof CartItem) {
                $totalPrice += $cartItem->getSubTotal();
            }
        }
        return $totalPrice;
    }

    /**
     * Get total price in Shopping Cart after discount
     *
     * @return float
     */
    public function getGrandTotal() : float
    {
        $this->grandTotal = $this->calculateTotalPrice();
        foreach (ShoppingCartPriceRule::getDiscountRules() as $discountRule)
        {
            $this->applyRule($discountRule);
        }

        return $this->grandTotal;
    }

    /**
     * @param float $grandTotal
     * @return ShoppingCart
     */
    public function setGrandTotal(float $grandTotal) : ShoppingCart
    {
        $this->grandTotal = $grandTotal;

        return $this;
    }

    /**
     * Apply discount by Shopping Cart Price rule
     *
     * @param ShoppingCartPriceRule $discountRule
     * @return ShoppingCart
     */
    public function applyRule(ShoppingCartPriceRule $discountRule)
    {
        $isValid = $discountRule->validateRule($this);
        $grandTotal = $isValid ? $this->calculateTotalPrice() - $discountRule->getDiscount() : $this->calculateTotalPrice();
        $this->setGrandTotal($grandTotal);

        return $this;
    }

}