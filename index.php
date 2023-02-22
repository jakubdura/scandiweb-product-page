<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scandiweb</title>

    <!-- =============== CSS ================ -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    require 'database/db_connection.php';
    require 'Book.php';
    require 'DVD.php';
    require 'Furniture.php';
    ?>
    <!-- -------------- header ----------------- -->
    <header class="header">
        <nav class="nav container">
            <div class="nav__title" onclick="window.location.href=window.location.href">
                <h1>Product List</h1>
            </div>
            <div class="nav__buttons">
                <button id="add-product-btn">ADD</button>
                <button id="delete-product-btn">MASS DELETE</button>
            </div>
        </nav>
        <hr class="horizontal-line container">
    </header>

    <!-- -------------- product grid ----------------- -->
    <main class="main container">

        <form id="delete_form" action="delete_products.php" method="post">
            <div class="list__grid">

                <?php
                $products = selectAllProducts();

                if (count($products) > 0) {
                    foreach ($products as $product) {
                        echo " <div class='list__item'>";
                        echo "<input type='checkbox' class='delete-checkbox' name='ids[]' value=" . $product->getSku() . ">
                    <div class='list__item-content'>";
                        echo "<div class='list__item-sku'> " . $product->getSku() . "</div>";
                        echo "<div class='list__item-name'>" . $product->getName() . "</div>";
                        echo "<div class='list__item-price'>" . $product->getPrice() . "</div>";
                        echo "<div class='list__item-attribute'> ".$product->getAttributeDescription().":<br>" . $product->getAttribute() ." ". $product->getUnit(). " </div>";
                        echo "</div></div>";
                    }
                } else {
                    echo "<div class='list__error'>Database is empty. </div>";
                }

                ?>
            </div>
        </form>


    </main>

    <!-- -------------- footer ----------------- -->
    <footer class="footer">
        <div class="footer__content container">
            <hr class="horizontal-line">
            <div class="footer__text">
                Scandiweb Test assigment by
                <a href="https://www.linkedin.com/in/jakub-dura/">Jakub Dura</a>
            </div>
        </div>
    </footer>

    <!-- ============== JS scripts ============== -->
    <script src="js/productList.js"></script>
</body>

</html>