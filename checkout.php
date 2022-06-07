<?php

if (isset($_GET['save'])) {
    $val = $_GET['save'];
    $product_name = str_replace('_', ' ', $val);
    if (isset($_COOKIE['cart'])) {
        $cart = explode(",", $_COOKIE['cart']);

        if (($key = array_search($product_name, $cart)) !== false) {
            if (isset($_COOKIE['wishlist'])) {
                // echo "is set";
                $wishlist = explode(",", $_COOKIE['wishlist']);
                array_push($wishlist, $cart[$key]);
                $str2 = implode(',', $wishlist);
                setcookie("wishlist", $str2, strtotime("+365 day"), '/');
            } else {
                // echo "is not set";
                $wishlist = [];
                array_push($wishlist, $cart[$key]);
                $str2 = implode(',', $wishlist);
                setcookie("wishlist", $str2, strtotime("+365 day"));
            }
            unset($cart[$key]);
            $str1 = implode(',', $cart);
            setcookie("cart", $str1, strtotime("+60 day"));
            header("Location: checkout.php");
        }
    }
}
$title = "Checkout";
require('header.php');
?>
<main id="checkout_main">
    <a href="products.php" class="sidebar">
        <h3>Continue Shopping</h3>
    </a>
    <form action="shipping.php" method="post">
        <section>
            <h2 class="headings">Checkout</h2>
            <div id="checkout_items">
                <?php
                if (isset($_COOKIE['cart'])) {
                    $subtotal = 0;
                    $arr_len = count($cart);
                    echo '<input type="hidden" name="pcs" id="pcs" value="' . $arr_len . '">';
                    foreach ($cart as $key => $item) {
                        echo '<div class="item">';
                        $cart_query = "SELECT product_name,thumbnail,price FROM `products` WHERE product_name = '" . $item . "'";
                        $cart_sql = mysqli_query($connection, $cart_query);
                        $cart_row = mysqli_fetch_array($cart_sql);
                        $cart_item = $cart_row['product_name'];
                        $cart_price = $cart_row['price'];
                        $cart_thumbnail = $cart_row['thumbnail'];
                        $subtotal += $cart_price;
                        $product_link = str_replace(' ', '_', $cart_item);
                        echo '<img src="thumbnail/' . $cart_thumbnail . '" alt="' . $cart_item . '" width="350" height="350">';
                        echo '<div>';
                        echo '<h3>' . $cart_item . '</h3>';
                        echo '<p>$ ' . $cart_price . ' CAD</p>';
                        echo '<select name="' . $key . '" id="' . $key . '">';
                        for ($num = 1; $num <= 5; $num++) {
                            echo '<option value="' . $num . '">' . $num . '</option>';
                        }
                        echo '</select>';
                        echo '<a href="checkout.php?save=' . $product_link . '">Save for later</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>Your cart is empty;(</p>";
                }
                ?>
            </div>
        </section>
        <section class="order">
            <h3>Order</h3>
            <?php
            $shipping = 4;
            $total = $subtotal + $shipping;
            ?>

            <p>Item(s) Subtotal: $ <?php echo $subtotal; ?> CAD</p>
            <p>Shipping & Handling: $ <?php echo $shipping; ?> CAD</p>
            <p>Total before tax: $ --.-- CAD</p>
            <p>Estimated GST/HST: $ --.-- CAD</p>
            <p>Estimated PST/RST/QST: $ --.-- CAD</p>
            <hr>
            <h4>Grand Total: $ <?php echo $total; ?> CAD</h4>
            <input type="submit" value="Continue to Shipping" class="btn">
        </section>
    </form>
</main>
<script src="script.js"></script>
</body>

</html>