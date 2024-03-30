<?php
    include "../config.php";

    $id = $_GET['edit'];
    $sql = "DELETE FROM provider WHERE provider_id=$id";
    mysqli_query($dbConn, $sql);

    header('Location: http://localhost/StoreUpdated/corrections/corr_provider.php?');
?>