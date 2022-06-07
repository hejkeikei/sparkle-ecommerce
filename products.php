<?php
$title = "Shop All";
require('header.php');
?>
<main id="products_main">
    <div class="pagewrap">


        <section>
            <?php
            $category = $_GET['category'];
            if ($category == 'earring') {
                $query = "SELECT * FROM `products` WHERE category = 'earring'";
                echo '<h2 class="headings">Earring</h2>';
                echo '<p>Shop All / Earring</p>';
            } else if ($category == 'necklace') {
                $query = "SELECT * FROM `products` WHERE category = 'necklace'";
                echo '<h2 class="headings">Necklace</h2>';
                echo '<p>Shop All / Necklace</p>';
            } else if ($category == 'brooch') {
                $query = "SELECT * FROM `products` WHERE category = 'brooch'";
                echo '<h2 class="headings">Brooch</h2>';
                echo '<p>Shop All / Brooch</p>';
            } else if ($category == 'new_arrival') {
                $query = "SELECT * FROM `products`  
    ORDER BY `products`.`id`  DESC LIMIT 20";
                echo '<h2 class="headings">New Arrival</h2>';
                echo '<p>Shop All / New Arrival</p>';
            } else {
                $query = "SELECT * FROM `products`";
                echo '<h2 class="headings">Shop All</h2>';
                echo '<p>Shop All / All</p>';
            }
            ?>
            <div id="sort_box">
                <p>SORT BY</p>
                <select name="product_sort" id="product_sort">
                    <option value="">--Please Select One--</option>
                    <option value="new">New Arrival</option>
                    <option value="price_low">Price: Low to High</option>
                    <option value="price_high">Price: High to Low</option>
                </select>
            </div>
        </section>
        <div id="product_gallery">
            <?php
            // $query = "SELECT * FROM `products`";
            $sql = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_array($sql)) {
                $id = $row['id'];
                $thumbnail = $row['thumbnail'];
                $main_material = $row['main_material'];
                $sec_material = $row['secondary_material'];
                $product_name = $row['product_name'];
                $price = $row['price'];
                $product_link = str_replace(' ', '_', $product_name);
                echo '<div class="card" data-id="' . $id . '" data-price="' . $price . '" data-main="' . $main_material . '" data-sec="' . $sec_material . '">';
                echo '<a href="product.php?name=' . $product_link . '">';
                echo '<img src="thumbnail/' . $thumbnail . '" alt="' . $product_name . '" width="350" height="350">';
                echo '</a>';
                echo '<div class="colors">';
                if ($main_material == 'gold') {
                    echo '<div class="circle gold"></div>';
                    echo '<div class="circle silver"></div>';
                } else if ($main_material == 'brass') {
                    echo '<div class="circle brass"></div>';
                } else if ($main_material == 'embroidery') {
                    echo '<div class="circle embroidery"></div>';
                } else if ($main_material == 'silver') {
                    echo '<div class="circle silver"></div>';
                }
                echo '</div>';

                echo "<h3>$product_name</h3>";
                echo '<p>$ ' . $price . ' CAD</p>';
                echo '</div>';
            }
            ?>



        </div>
        <a href="#" id="back_btn">Back to top</a>


    </div>
    <footer>
        <p>Sparkle Accessory co., Ltd</p>
        <p>2018 33 Ave SW, Calgary, AB T2T 1Z4</p>
        <div>
            <a href="#">Privacy</a> / <a href="#">Term of Use</a> / <a href="#">Cookie Setting</a>
        </div>
    </footer>
</main>
<script src="script.js"></script>
</body>

</html>
<?php ob_end_flush(); ?>