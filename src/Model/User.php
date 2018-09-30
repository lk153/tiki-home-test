<?php
declare(strict_types=1);

namespace App\Model;

class User {

    private $name;
    private $email;
    private $group;
    private $shoppingCart;

    /**
     *
     * @param string $name
     * @param string $email
     * @param integer $group
     */
    public function __construct($name, $email, $group)
    {
        $this->name = $name;
        $this->email = $email;
        $this->group = $group;
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
     * @return User
     */
    public function setName(string $name) : User
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email) : User
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return int
     */
    public function getGroup() : int
    {
        return $this->group;
    }

    /**
     * @param int $group
     * @return User
     */
    public function setGroup(int $group) : User
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Initialize shopping cart
     * @return ShoppingCart
     */
    public function initCart() : ShoppingCart
    {
        $this->shoppingCart = new ShoppingCart($this);

        return $this->shoppingCart;
    }

    /**
     * @return ShoppingCart
     */
    public function getShoppingCart()
    {
        return $this->shoppingCart;
    }

}