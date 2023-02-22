<?php
require_once 'Product.php';

class Furniture extends Product
{
    public $dimensions;
    private static $type = 'Furniture';

    //constructor with 4 parameters
    public function __construct($sku, $name, $price, $dimensions)
    {
        $this->dimensions = $dimensions;
        parent::__construct($sku, $name, $price, self::$type);
    }

    //constructor with 6 parameters
    public static function __constructWithDimension($sku, $name, $price, $height, $width, $length)
    {
        $concatenateDimensions = $height.' x '. $width. ' x ' . $length;
        return new Furniture($sku, $name, $price, $concatenateDimensions);
    }

    public function getDimensions(){
        return $this->dimensions;
    }

    public function getAttribute() {
        return $this->dimensions;
    }

    public function getUnit()
    {
        return "CM";
    }

    public function getAttributeDescription()
    {
        return "Dimensions";
    }
}

?>