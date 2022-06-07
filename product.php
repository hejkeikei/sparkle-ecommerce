<?php
$val = $_GET['name'];
$product_name = str_replace('_', ' ', $val);
if (isset($_GET['addtocart'])) {
    if (!isset($_COOKIE['cart'])) {
        $cart = [];
        array_push($cart, $product_name);
        $var = implode(',', $cart);
        setcookie("cart", $var, strtotime("+60 day"));
        header("Location: product.php?name=$val");
    } else {
        $cart = explode(",", $_COOKIE['cart']);
        array_push($cart, $product_name);
        $var = implode(',', $cart);
        setcookie("cart", $var, strtotime("+60 day"));
        header("Location: product.php?name=$val");
    }
}
$val = $_GET['name'];
if (empty($val)) {
    header('Location: products.php');
};
$product_name = str_replace('_', ' ', $val);
$title = $product_name;
require('header.php');

?>
<main id="product_page">
    <?php

    $query = "SELECT * FROM `products` WHERE product_name = '" . $product_name . "'";

    $sql = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($sql);
    $id = $row['id'];
    $img = $row['filename'];
    $category = $row['category'];
    $price = $row['price'];
    $main_material = $row['main_material'];
    $description = $row['description'];
    echo '<div class="img_box center"><img src="image/' . $img . '" alt="' . $product_name . '" width="1200" height="800" data-material="' . $main_material . '"></div>'

    ?>

    <section>
        <h2><?php echo $product_name; ?></h2>
        <p><?php echo $category; ?></p>
        <?php echo $description; ?>
        <p>$ <?php echo $price; ?> CAD</p>
        <div id="color_switch">
            <?php
            if ($main_material == 'gold') {
                echo '<input type="radio" name="colors" id="gold"><label for="gold" class="gold"></label>';
                echo '<input type="radio" name="colors" id="silver"><label for="silver" class="silver"></label>';
            } else if ($main_material == 'brass') {
                echo '<label for="brass" class="brass"></label><input type="radio" name="colors" id="brass">';
            } else if ($main_material == 'embroidery') {
                echo '<label for="embroidery" class="embroidery"></label><input type="radio" name="colors" id="embroidery">';
            } else if ($main_material == 'silver') {
                echo '<label for="silver" class="silver"><input type="radio" name="colors" id="silver"></label>';
            }
            ?>
        </div>
        <div id="buttons">
            <!-- Set cookie for cart -->
            <a href="product.php?name=<?php echo $val . "&addtocart=true"; ?>" class="btn">Add to Cart</a>
            <!-- Set cookie for wish list -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false" id="heart">
                <path d="M16.5,3A6.953,6.953,0,0,0,12,5.051,6.912,6.912,0,0,0,7.5,3C4.364,3,2,5.579,2,9c0,5.688,8.349,12,10,12S22,14.688,22,9C22,5.579,19.636,3,16.5,3Z"></path>
            </svg>
        </div>
    </section>
</main>
<script src="script.js"></script>

</body>

</html>
<?php ob_end_flush(); ?>