<?php
if (isset($_GET['addtocart'])) {
    $val = $_GET['name'];
    $product_name = str_replace('_', ' ', $val);
    if (!isset($_COOKIE['cart'])) {
        $cart = [];
        array_push($cart, $product_name);
        $var = implode(',', $cart);
        setcookie("cart", $var, strtotime("+60 day"));
    } else {
        $cart = explode(",", $_COOKIE['cart']);
        array_push($cart, $product_name);
        $var = implode(',', $cart);
        setcookie("cart", $var, strtotime("+60 day"));
    }
    header("Location: wishlist.php");
}

if (isset($_GET['addall'])) {
    $wishlist = explode(",", $_COOKIE['wishlist']);
    $length = count($wishlist);
    if (!isset($_COOKIE['cart'])) {
        $cart = [];
        for ($i = 1; $i < $length; $i++) {
            array_push($cart, $wishlist[$i]);
        }
        $var = implode(',', $cart);
        setcookie("cart", $var, strtotime("+60 day"));
    } else {
        $cart = explode(",", $_COOKIE['cart']);
        for ($i = 1; $i < $length; $i++) {
            array_push($cart, $wishlist[$i]);
        }
        $var = implode(',', $cart);
        setcookie("cart", $var, strtotime("+60 day"));
    }
    header("Location: wishlist.php");
}
$title = "Wishlist";
require('header.php');
?>
<main id="wishlist_main">
    <a href="products.php" class="sidebar">
        <h3>Continue Shopping</h3>
    </a>

    <section>
        <h2 class="headings">Wishlist</h2>
        <a class="btn" href="wishlist.php?addall=true">Add All to Cart</a>
        <div id="wishlist_items">
            <?php
            if (isset($_COOKIE['wishlist'])) {
                $wishlist = explode(",", $_COOKIE['wishlist']);
                foreach ($wishlist as $key => $item) {
                    if ($item != "") {
                        echo '<div class="card">';
                        $query = "SELECT product_name,thumbnail,price FROM `products` WHERE product_name = '" . $item . "'";
                        $sql = mysqli_query($connection, $query);
                        $row = mysqli_fetch_array($sql);
                        $title = $row['product_name'];
                        $thumbnail = $row['thumbnail'];
                        $link = str_replace(' ', '_', $title);
                        echo '<a href="product.php?name=' . $link . '">';
                        echo '<img src="thumbnail/' . $thumbnail . '" alt="' . $title . '" width="350" height="350">';
                        echo '</a>';
                        echo '<a href="wishlist.php?name=' . $link . '&addtocart=true" class="btn">Add to Cart</a>';
                        echo '</div>';
                    }
                }
            } else {
                echo "<p>Your wishlist is empty;(</p>";
            }
            ?>
        </div>
    </section>
    <a href="checkout.php" class="sidebar">
        <h3>Go to Cart</h3>
    </a>
</main>
<script src="script.js"></script>
</body>

</html>