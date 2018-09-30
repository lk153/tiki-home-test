<?php
declare(strict_types=1);

namespace App\Model;

class Product {

    private $sku;
    private $name;
    private $color;
    private $price;

    /**
     * @param string $name
     * @param float $price
     * @param string $color
     */
    public function __construct(string $name, string $color, float $price)
    {
        $this->name = $name;
        $this->color = $color;
        $this->price = $price;
        $this->sku = $this->generateSKU();
    }

    //Using version 4 UUID for generating product 's sku
    private function generateSku()
    {
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X',
            mt_rand(0, 65535), mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(16384, 20479),
            mt_rand(32768, 49151),
            mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    /**
     * @return string
     */
    public function getSku() : string
    {
        return $this->sku;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getColor() : string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor($color) : void
    {
        $this->color = $color;
    }

    /**
     * @return float
     */
    public function getPrice() : float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price) : void
    {
        $this->price = $price;
    }

}