<?php
declare(strict_types=1);

namespace App\Model;

class ShoppingCartPriceRule
{
    private $userGroup;
    private $fromDate;
    private $toDate;
    private $color;
    private $subTotal;
    private $discount;
    public static $listDiscountRule = [];
    /**
     *
     * @param int $userGroup
     * @param \DateTime $fromDate
     * @param \DateTime $toDate
     * @param float $discount
     * @param string $color
     * @param float $subTotal
     */
    public function __construct(int $userGroup, $fromDate, $toDate, $discount, $color = '', $subTotal = 0.0)
    {
        $this->userGroup = $userGroup;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->discount = $discount;
        $this->color = $color;
        $this->subTotal = $subTotal;
        self::$listDiscountRule[] = $this;
    }

    /**
     * @return int
     */
    public function getUserGroup(): int
    {
        return $this->userGroup;
    }

    /**
     * @param int $userGroup
     * @return ShoppingCartPriceRule
     */
    public function setUserGroup(int $userGroup): ShoppingCartPriceRule
    {
        $this->userGroup = $userGroup;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getFromDate(): \DateTime
    {
        return $this->fromDate;
    }

    /**
     * @param \DateTime $fromDate
     * @return ShoppingCartPriceRule
     */
    public function setFromDate(\DateTime $fromDate): ShoppingCartPriceRule
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getToDate(): \DateTime
    {
        return $this->toDate;
    }

    /**
     * @param \DateTime $toDate
     * @return ShoppingCartPriceRule
     */
    public function setToDate(\DateTime $toDate): ShoppingCartPriceRule
    {
        $this->toDate = $toDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     * @return ShoppingCartPriceRule
     */
    public function setColor(string $color): ShoppingCartPriceRule
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return float
     */
    public function getSubTotal(): float
    {
        return $this->subTotal;
    }

    /**
     * @param float $subTotal
     * @return ShoppingCartPriceRule
     */
    public function setSubTotal(float $subTotal): ShoppingCartPriceRule
    {
        $this->subTotal = $subTotal;

        return $this;
    }

    /**
     * @return float
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }

    /**
     * @param float $discount
     * @return ShoppingCartPriceRule
     */
    public function setDiscount(float $discount): ShoppingCartPriceRule
    {
        $this->discount = $discount;

        return $this;
    }

    public static function getDiscountRules()
    {
        return self::$listDiscountRule;
    }

    /**
     *
     * @param ShoppingCart $cart
     * @return bool
     */
    public function validateRule(ShoppingCart $cart)
    {
        $currentDate = new \DateTime();
        $currentUser = $cart->getUser();

        switch (true)
        {
            case $this->getFromDate() > $currentDate:
                return false;
            case $this->getToDate() < $currentDate:
                return false;
            case $this->getUserGroup() !== $currentUser->getGroup():
                return false;
            case $this->getColor() && $this->getSubTotal() && !$this->validateColorSubTotal($cart):
                return false;

            default:
                return true;
        }
    }

    /**
     * Validate Color & SubTotal rule if specified
     * @param ShoppingCart $cart
     * @return bool
     */
     private function validateColorSubTotal(ShoppingCart $cart)
     {
         $matchedCartItem = array_filter($cart->getCartItems(), function (CartItem $cartItem) {
            return $cartItem->getProduct()->getColor() == $this->getColor() &&
                $cartItem->getSubTotal() > $this->getSubTotal();
         });

         return count($matchedCartItem) > 0;
     }

}