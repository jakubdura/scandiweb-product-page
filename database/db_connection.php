<?php

function openConn()
{
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "scandiweb";

    $connection = new mysqli($servername, $username, $password, $db);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    return $connection;
}

function closeConn($conn)
{
    $conn->close();
}


function selectAllProducts()
{
    $sql = "SELECT * FROM product";
    $connection = openConn();
    $result = $connection->query($sql);
    $products = array();

    while ($row = $result->fetch_assoc()) {
        if ($row['type'] === "Book") {
            $product = new Book($row["sku"], $row["name"], $row["price"], $row["attribute"]);
        } else if ($row['type'] === "DVD") {
            $product = new DVD($row["sku"], $row["name"], $row["price"], $row["attribute"]);
        } else if ($row['type'] === "Furniture") {
            $product = new Furniture($row["sku"], $row["name"], $row["price"], $row["attribute"]);
        } else {
            $product = null;
        }

        if ($product !== null)
            $products[] = $product;
    }

    closeConn($connection);

    return $products;
}

function insertProduct(Product $product)
{
    $sku = $product->getSku();
    $name = $product->getName();
    $price = $product->getPrice();
    $type = $product->getType();
    $attribute = $product->getAttribute();

    $sql = "INSERT INTO product(sku, name, price, type, attribute)
            VALUES ('$sku', '$name', '$price', '$type', '$attribute')
            ";

    $connection = openConn();
    $connection->query($sql);

    if ($connection->affected_rows == 1) {
        closeConn($connection);
        return true;
    } else {
        closeConn($connection);
        return false;
    }
}

function deleteProduct(string $sku)
{
    $sql = "DELETE FROM product WHERE sku ='" . $sku . "'";
    $connection = openConn();
    $connection->query($sql);
    closeConn($connection);
}

function skuExists(string $sku)
{
    $sql = "SELECT sku FROM product WHERE sku ='" . $sku . "'";
    $connection = openConn();
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        closeConn($connection);
        return true;
    } else {
        closeConn($connection);
        return false;
    }
}
