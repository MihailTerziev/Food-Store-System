<?php
    include "../config.php";

    $id = $_GET['edit'];
    $sql = "DELETE FROM single_purchase WHERE product_id=$id";
    mysqli_query($dbConn, $sql);

    header('Location: http://localhost/StoreUpdated/purchasing/cart.php?');
?>