<?php
require_once 'Product.php';

class Book extends Product
{
    public $weight;
    private static $type = 'Book';

    public function __construct($sku, $name, $price, $weight)
    {
        $this->weight = $weight;
        parent::__construct($sku, $name, $price, self::$type);
    }

    public function getWeight(){
        return $this->weight;
    }

    public function getAttribute() {
        return $this->weight;
    }

    public function getUnit()
    {
        return "KG";
    }

    public function getAttributeDescription()
    {
        return "Weight";
    }
}

?>