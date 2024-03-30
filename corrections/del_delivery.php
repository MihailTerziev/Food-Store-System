<?php
    include "../config.php";

    $id = $_GET['edit'];
    $sql = "DELETE FROM delivery WHERE delivery_id=$id";
    mysqli_query($dbConn, $sql);

    header('Location: http://localhost/StoreUpdated/corrections/corr_delivery.php?');
?>