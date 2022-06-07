<?php
$title = "Home";
require('header.php');
$query = "SELECT filename,category FROM `feature`";
$sql = mysqli_query($connection, $query);

while ($row = mysqli_fetch_array($sql)) {
    if ($row['category'] == "necklace") {
        $necklace_img = $row['filename'];
    } elseif ($row['category'] == "new_arrival") {
        $new_img = $row['filename'];
    } elseif ($row['category'] == "brooch") {
        $brooch_img = $row['filename'];
    } elseif ($row['category'] == "earring") {
        $earring_img = $row['filename'];
    }
}
?>

<main>
    <!-- ACCORDION -->
    <div class="accordion-group" id="accordion">
        <a href="products.php?category=earring">
            <div class="accordion-overlay"></div>
            <h2 class="landding_heading">Earrings</h2>
            <img src="image/<?php echo $earring_img; ?>" alt="featured earrings" width="1200" height="800">
        </a>
        <a href="products.php?category=new_arrival" class="open">
            <div class="accordion-overlay"></div>
            <h2 class="landding_heading">New Arrival</h2>
            <img src="image/<?php echo $new_img; ?>" alt="featured collection" width="1200" height="800">
        </a>
        <a href="products.php?category=necklace">
            <div class="accordion-overlay"></div>
            <h2 class="landding_heading">Necklace</h2>
            <img src="image/<?php echo $necklace_img; ?>" alt="featured necklace" width="1200" height="800">
        </a>
        <a href="products.php?category=brooch">
            <div class="accordion-overlay"></div>
            <h2 class="landding_heading">Brooch</h2>
            <img src="image/<?php echo $brooch_img; ?>" alt="featured brooch" width="1200" height="800">
        </a>
    </div>

</main>
<script src="script.js"></script>
</body>

</html>