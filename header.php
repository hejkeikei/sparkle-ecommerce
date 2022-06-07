<?php
ob_start();
$sever = "localhost";
$database = "tchen_mmda225_ecommerce";
$user = "tchen_tchen";
$pass = "keikei3957";
$connection = mysqli_connect($sever, $user, $pass, $database);
if (!$connection) {
    die(mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sparkle | <?php echo $title; ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <input type="checkbox" name="toggle" id="toggle">
        <label for="toggle">
            <span class="shape"></span>
            <span class="shape"></span>
            <span class="shape"></span>
        </label>
        <h1><a href="index.php"><img src="logo.svg" alt="Sparkle Accessories"></a></h1>
        <nav>
            <a href="products.php">Shop All</a>
            <a href="products.php?category=earring">Earrings</a>
            <a href="products.php?category=necklace">Necklace</a>
            <a href="products.php?category=brooch">Brooch</a>
            <a href="products.php?category=new_arrival">New Arrival</a>

            <div id="filter">
                <h2>Material</h2>
                <div class="filter_item">
                    <label for="brass_filter">Brass</label>
                    <input type="checkbox" name="brass_filter" id="brass_filter">
                </div>
                <div class="filter_item">
                    <label for="embroidery_filter">Embroidery</label>
                    <input type="checkbox" name="embroidery_filter" id="embroidery_filter">
                </div>
                <div class="filter_item">
                    <label for="gold_filter">Gold</label>
                    <input type="checkbox" name="gold_filter" id="gold_filter">
                </div>
                <div class="filter_item">
                    <label for="gemstone_filter">Gemstone</label>
                    <input type="checkbox" name="gemstone_filter" id="gemstone_filter">
                </div>
                <div class="filter_item">
                    <label for="silver_filter">Silver</label>
                    <input type="checkbox" name="silver_filter" id="silver_filter">
                </div>
            </div>
            <div id="menu_logo"></div>

            <a href="#">About Us</a>
            <a href="#">Shipping</a>
            <a href="#">FAQ</a>
            <a href="#">Customer Service</a>

        </nav>


        <input type="checkbox" name="cart_btn" id="cart_btn">
        <label for="cart_btn"><img src="cart.svg" alt="cart icon" width="50" height="50" class="icon"></label>
        <a href="wishlist.php"><img src="wishlist.svg" alt="wishlist icon" width="50" height="50" class="icon"></a>

        <!-- side cart -->
        <aside>
            <h2>Cart</h2>

            <?php
            if (isset($_COOKIE['cart'])) {
                $cart = explode(",", $_COOKIE['cart']);
                $price_list = [];
                echo '<div id="cart_items">';
                foreach ($cart as $item) {
                    $cart_query = "SELECT product_name,thumbnail,price FROM `products` WHERE product_name = '" . $item . "'";

                    $cart_sql = mysqli_query($connection, $cart_query);
                    $cart_row = mysqli_fetch_array($cart_sql);
                    $cart_item = $cart_row['product_name'];
                    $cart_price = $cart_row['price'];
                    array_push($price_list, $cart_price);
                    $cart_thumbnail = $cart_row['thumbnail'];
                    echo '<div class="item">';
                    echo '<img src="thumbnail/' . $cart_thumbnail . '" alt="' . $cart_item . '" width="350" height="350">';
                    echo '<div><h4>' . $cart_item . '</h4>';
                    echo '<p>$ ' . $cart_price . ' CAD</p></div>';
                    echo '</div>';
                }
            } else {
                echo "<p>The cart is empty;(</p>";
            }
            ?>
            <a href="products.php" class="line_btn">Continue Shopping</a>
            <a href="checkout.php" class="btn">Checkout</a>
        </aside>
    </header>