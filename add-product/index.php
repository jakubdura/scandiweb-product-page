<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product</title>

    <!-- =============== CSS ================ -->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
    include '../database/db_connection.php';
    require '../Validator.php';
    require '../Book.php';
    require '../DVD.php';
    require '../Furniture.php';
    require '../ProductFactory.php';


    if (isset($_POST['submit'])) {
        // validate
        $validation = new Validator($_POST);
        $errors = $validation->validateForm();

        if (sizeof($errors) == 0) {
            $type = $_POST['productType'];
            $sku = $_POST['sku'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $attributes = array();
                    
            if (isset($_POST['weight'])) {
                $attributes = array_merge($attributes, array('weight' => $_POST['weight']));
            }
            if (isset($_POST['size'])) {
                $attributes = array_merge($attributes, array('size' => $_POST['size']));
            }
            if (isset($_POST['height'])) {
                $attributes = array_merge($attributes, array('height' => $_POST['height']));
            }
            if (isset($_POST['width'])) {
                $attributes = array_merge($attributes, array('width' => $_POST['width']));
            }
            if (isset($_POST['length'])) {
                $attributes = array_merge($attributes, array('length' => $_POST['length']));
            }

            try {
                $product = ProductFactory::createProduct($type, $sku, $name, $price, $attributes);
            } catch (Exception $e) {
                $errors[] = $e->getMessage();
            }


            // save to db
            if (insertProduct($product)) {
                $url = "/scandiweb/";
                header("Location: " . $url);
                exit;
            } else {
                echo "Error occurred while trying to add a record to database. Try again.";
            }
        }
    }

    ?>
    <!-- -------------- header ----------------- -->
    <header class="header">
        <nav class="nav container">
            <div class="nav__title" onclick="window.location.href=window.location.href">
                <h1>Product add</h1>
            </div>
            <div class="nav__buttons">
                <button id="save-btn" name="submit" type="submit" form="product_form">Save</button>
                <button id="cancel-btn">Cancel</button>
            </div>
        </nav>
        <hr class="horizontal-line container">
    </header>

    <!-- -------------- product form ----------------- -->
    <main class="main container">

        <form id="product_form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

            <div class="form__component">
                <div>
                    <label for="sku">SKU</label>
                    <div class="form__error"> <?php echo $errors['sku'] ?? '' ?></div>
                </div>
                <div class="form__component-sku">
                    <input type="text" id="sku" name="sku" value="<?php echo !empty($_POST['sku']) ? htmlspecialchars($_POST['sku']) : '' ?>">
                    <button id="generate-btn">Generate SKU</button>
                </div>
            </div>

            <div class="form__component">
                <label for="name">Name</label>
                <div class="form__error"> <?php echo $errors['name'] ?? '' ?></div>
                <input type="text" id="name" name="name" value="<?php echo !empty($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">
            </div>

            <div class="form__component">
                <label for="price">Price ($) </label>
                <div class="form__error"> <?php echo $errors['price'] ?? '' ?></div>
                <input type="text" id="price" name="price" value="<?php echo !empty($_POST['price']) ? htmlspecialchars($_POST['price']) : '' ?>">
            </div>

            <div class="form__component">
                <label for="type">Type Switcher:</label>
                <select id="productType" name="productType">
                    <option value='DVD' <?php echo !empty($_POST['productType']) && $_POST['productType'] === 'DVD' ? 'selected' : ''; ?>>DVD</option>
                    <option value='Book' <?php echo !empty($_POST['productType']) && $_POST['productType'] === 'Book' ? 'selected' : ''; ?>>Book</option>
                    <option value='Furniture' <?php echo !empty($_POST['productType']) && $_POST['productType'] === 'Furniture' ? 'selected' : ''; ?>>Furniture</option>
                </select>
            </div>

            <!-- -------- DVD -------->
            <div id="DVD" class="form__attributes active-attribute">
                <div class="form__component">
                    <label for="size">Size (MB) </label>
                    <div class="form__error"> <?php echo $errors['size'] ?? '' ?></div>
                    <input type="text" id="size" name="size" value="<?php echo !empty($_POST['size']) ? htmlspecialchars($_POST['size']) : '' ?>">
                </div>

                <div class="form__attributes_description">
                    <p> Please provide DVD size in megabytes.</p>
                </div>
            </div>

            <!-- -------- Book -------->
            <div id="Book" class="form__attributes">
                <div class="form__component">
                    <label for="weight">Weight (KG) </label>
                    <div class="form__error"> <?php echo $errors['weight'] ?? '' ?></div>
                    <input type="text" id="weight" name="weight" value="<?php echo !empty($_POST['weight']) ? htmlspecialchars($_POST['weight']) : '' ?>">
                </div>

                <div class="form__attributes_description">
                    <p> Please provide weight of the book in kilograms.</p>
                </div>
            </div>

            <!-- -------- Furniture -------->
            <div id="Furniture" class="form__attributes">
                <div class="form__component">
                    <label for="height">Height (CM) </label>
                    <div class="form__error"> <?php echo $errors['height'] ?? '' ?></div>
                    <input type="text" id="height" name="height" value="<?php echo !empty($_POST['height']) ? htmlspecialchars($_POST['height']) : '' ?>">
                </div>

                <div class="form__component">
                    <label for="width">Width (CM) </label>
                    <div class="form__error"> <?php echo $errors['width'] ?? '' ?></div>
                    <input type="text" id="width" name="width" value="<?php echo !empty($_POST['width']) ? htmlspecialchars($_POST['width']) : '' ?>">
                </div>

                <div class="form__component">
                    <label for="length">Length (CM) </label>
                    <div class="form__error"> <?php echo $errors['length'] ?? '' ?></div>
                    <input type="text" id="length" name="length" value="<?php echo !empty($_POST['length']) ? htmlspecialchars($_POST['length']) : '' ?>">
                </div>

                <div class="form__attributes_description">
                    <p> Please provide dimensions in H x W x L format.</p>
                </div>
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
    <script src="../js/productAdd.js"></script>
</body>

</html>