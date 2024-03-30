<?php
    include "../config.php";

    $id = $_GET['edit'];
    $sql = "DELETE FROM purchase WHERE purchase_id=$id";
    mysqli_query($dbConn, $sql);

    header('Location: http://localhost/StoreUpdated/corrections/corr_purchase.php?');
?>