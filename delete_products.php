<?php
require 'database/db_connection.php';

$product_ids = isset($_POST['ids']) ? $_POST['ids'] : array();

foreach ($product_ids as $product_id) {
    deleteProduct($product_id);
}

$url = "/scandiweb/";
header("Location: " . $url);
exit;
