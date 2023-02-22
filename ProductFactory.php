<?php
class ProductFactory {
    public static function createProduct($type, $sku, $name, $price, $attributes) {
        switch ($type) {
            case 'Book':
                $product = new Book($sku, $name, $price, $attributes['weight']);
                break;
            case 'DVD':
                $product = new DVD($sku, $name, $price, $attributes['size']);
                break;
            case 'Furniture':
                $product = Furniture::__constructWithDimension($sku, $name, $price,  $attributes['height'],  $attributes['width'],  $attributes['length']);
                break;
            default:
                throw new Exception("Invalid product type.");
        }
        return $product;
    }
}

