<?php

$title = "Order Sent";
require('header.php');

$order = $_COOKIE['cart'];
$pcs_list =  explode(",", $_POST['pcs_list']);
$order_pcs = mysqli_real_escape_string($connection, $_POST['pcs_list']);
$subtotal = mysqli_real_escape_string($connection, $_POST['subtotal']);
$email = mysqli_real_escape_string($connection, $_POST['email']);
$mobile = mysqli_real_escape_string($connection, $_POST['mobile']);
$firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
$lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
$address = mysqli_real_escape_string($connection, $_POST['address']);
$address2 = mysqli_real_escape_string($connection, $_POST['address2']);
$city = mysqli_real_escape_string($connection, $_POST['city']);
$province = mysqli_real_escape_string($connection, $_POST['province']);
$postalcode = mysqli_real_escape_string($connection, $_POST['postalcode']);


$shipping = 4;
$GST = 0.05;
$PST = 0;
switch ($province) {
    case "BC":
        $PST = 0.07;
        break;
    case "MB":
        $PST = 0.07;
        break;
    case "NB":
        $PST = 0.1;
        break;
    case "NL":
        $PST = 0.1;
        break;
    case "NS":
        $PST = 0.1;
        break;
    case "PE":
        $PST = 0.1;
        break;
    case "ON":
        $PST = 0.08;
        break;
    case "QC":
        $PST = 0.0975;
        break;
    case "SK":
        $PST = 0.06;
        break;
}

$grandtotal = ($subtotal + $shipping) * (1 + $GST + $PST);
$grandtotal = number_format($grandtotal, 2, '.', '');

$query = "INSERT INTO `orders`(`email`, `mobile`, `firstname`, `lastname`, `address1`, `address2`, `city`, `province_territory`, `postalcode`, `order_list`, `amount`, `cost`) VALUES ('$email','$mobile','$firstname','$lastname','$address','$address2','$city','$province','$postalcode','$order','$order_pcs','$grandtotal')";
$sql = mysqli_query($connection, $query);



?>
<main id="handle_main">
    <a href="products.php" class="sidebar">
        <h3>Continue Shopping</h3>
    </a>
    <section>
        <h3>Your Order</h3>
        <p>Your Name: <?php echo $firstname . " " . $lastname; ?></p>
        <p>Comfirmation email:<?php echo $email; ?> </p>
        <p>Shipping Address: <?php echo $address2 . " " . $address . " " . $city . " " . $province . " " . $postalcode; ?></p>
        <table>
            <tr>
                <th>Title</th>
                <th>Amount</th>
                <th>Price</th>
            </tr>
            <?php
            foreach ($cart as $key => $name) {
                echo '<tr>';
                echo "<td>$name</td>";
                echo "<td>" . $pcs_list[$key] . "</td>";
                echo "<td>" . $price_list[$key] * $pcs_list[$key] . "</td>";
                echo '</tr>';
            }
            ?>
        </table>
        <hr>
        <p>Item(s) Subtotal: $ <?php echo $subtotal; ?> CAD</p>
        <p>Shipping & Handling: $ <?php echo $shipping; ?> CAD</p>
        <p>Total before tax: $ <?php echo $subtotal + $shipping; ?> CAD</p>
        <p>Estimated GST/HST: $ <?php echo ($subtotal + $shipping) * $GST; ?> CAD</p>
        <p>Estimated PST/RST/QST: $ <?php echo ($subtotal + $shipping) * $PST; ?> CAD</p>
        <hr>
        <h4>Grand Total: $ <?php echo $grandtotal; ?> CAD</h4>
        <a href="products.php" class="btn">Back to Main Page</a>
    </section>
    <?php
    if (isset($_COOKIE['cart'])) {
        setcookie("cart", "checkout", strtotime("-60 day"));
    }
    ?>

</main>
<script src="script.js"></script>
</body>

</html>
<?php ob_end_flush(); ?>