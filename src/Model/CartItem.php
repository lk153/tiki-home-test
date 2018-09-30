<?php
declare(strict_types=1);

namespace App\Model;

class CartItem
{
    private $product;
    private $qty;

    /**
     *
     * @param Product $product
     * @param int $qty
     */
    public function __construct(Product $product, $qty)
    {
        $this->product = $product;
        $this->qty = $qty;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @return int
     */
    public function getQty(): int
    {
        return $this->qty;
    }

    /**
     * @param int $qty
     */
    public function setQty(int $qty): void
    {
        $this->qty = $qty;
    }

    /**
     * Get subtotal for specific product be added into cart
     * @return float
     */
    public function getSubTotal()
    {
        return $this->product->getPrice() * $this->qty;
    }

}