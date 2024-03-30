<?php
    $host = 'localhost'; 
    $dbUser = 'root'; 
    $dbPass = ''; 
    $dbName = 'updated_store_db';
    $dbConn = mysqli_connect($host, $dbUser, $dbPass);

    if(!$dbConn) {
        die('Не може да се осъществи връзка със сървъра!');
    }

    $sql = "CREATE DATABASE IF NOT EXISTS $dbName";
    if (!($queryResource = mysqli_query($dbConn, $sql))) 
        echo "Грешка при създаване на базата данни!<br>";

    if (!mysqli_select_db($dbConn, $dbName)) {
        die('Не може да се селектира базата от данни!');
    }

    mysqli_query($dbConn, "SET NAMES 'UTF8'");
?>