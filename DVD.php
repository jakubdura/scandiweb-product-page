<?php
require_once 'Product.php';

class DVD extends Product
{
    public $size;
    private static $type = 'DVD';

    public function __construct($sku, $name, $price, $size)
    {
        $this->size = $size;
        parent::__construct($sku, $name, $price, self::$type);
    }

    public function getSize(){
        return $this->size;
    }

    public function getAttribute() {
        return $this->size;
    }

    public function getUnit()
    {
        return "MB";
    }

    public function getAttributeDescription()
    {
        return "Size";
    }

}

?>