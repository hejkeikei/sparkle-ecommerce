<?php
$title = "Checkout - Shipping";
require('header.php');

$pcs = $_POST['pcs'];
$pcs_list = [];
$subtotal = 0;
// Subtotal counting
for ($i = 0; $i <= $pcs; $i++) {
    array_push($pcs_list, $_POST["$i"]);
}
foreach ($price_list as $key => $val) {
    $pcs_price = $val * $pcs_list[$key];
    $subtotal += $pcs_price;
}


?>
<main id="shipping_main">
    <a href="products.php" class="sidebar">
        <h3>Continue Shopping</h3>
    </a>
    <form action="handle.php" method="post">
        <section>
            <h2 class="headings">Shipping</h2>
            <h3>Contact</h3>
            <div class="inline">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="inline">
                <label for="mobile">Mobile(Optional)</label>
                <input type="tel" name="mobile" id="mobile">
            </div>
            <h3>Shipping Information</h3>
            <div class="inline">
                <label for="firstname">First Name</label>
                <input type="text" name="firstname" id="firstname" required>
            </div>
            <div class="inline">
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" id="lastname" required>
            </div>
            <label for="address">Address</label>
            <input type="text" name="address" id="address" required>
            <label for="address2">Address, suite etc. (Optional)</label>
            <input type="text" name="address2" id="address2">
            <div class="inline">
                <label for="city">city</label>
                <input type="text" name="city" id="city">
            </div>
            <div class="inline">
                <label for="province">Province and Territory</label>
                <select name="province" id="province" required>
                    <option value="">--Choose an option--</option>
                    <option value="AB">AB</option>
                    <option value="BC">BC</option>
                    <option value="MB">MB</option>
                    <option value="NB">NB</option>
                    <option value="NL">NL</option>
                    <option value="NS">NS</option>
                    <option value="ON">ON</option>
                    <option value="PE">PE</option>
                    <option value="QC">QC</option>
                    <option value="SK">SK</option>
                    <option value="YT">YT</option>
                    <option value="NU">NU</option>
                    <option value="NT">NT</option>
                </select>
            </div>
            <div class="inline">
                <label for="postalcode">Postal Code</label>
                <input type="text" name="postalcode" id="postalcode" required>
            </div>
        </section>
        <section class="order">
            <h3>Order</h3>
            <?php
            $shipping = 4;
            $total = $subtotal + $shipping;
            echo '<input type="hidden" name="subtotal" id="subtotal" value="' . $subtotal . '">';
            echo '<input type="hidden" name="pcs_list" id="pcs_list" value="' . implode(',', $pcs_list) . '">';
            ?>
            <p>Item(s) Subtotal: $ <?php echo $subtotal; ?> CAD</p>
            <p>Shipping & Handling: $ <?php echo $shipping; ?> CAD</p>
            <p>Total before tax: $ <?php echo $total; ?> CAD</p>
            <p>Estimated GST/HST: $ --.-- CAD</p>
            <p>Estimated PST/RST/QST: $ --.-- CAD</p>
            <hr>
            <h4>Grand Total: $ <?php echo $total; ?> CAD</h4>
            <input type="submit" value="Place an Order" class="btn">
        </section>
    </form>


</main>
<script src="script.js"></script>
</body>

</html>
<?php ob_end_flush(); ?>