<?php
    include "../config.php";

    $id = $_GET['edit'];
    $sql = "DELETE FROM product WHERE product_id=$id";
    mysqli_query($dbConn, $sql);

    header('Location: http://localhost/StoreUpdated/corrections/corr_product.php?');
?>