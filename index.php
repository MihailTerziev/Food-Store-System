<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/index.css">
    <link rel="stylesheet" href="static/nav.css">
</head>
<body>
    <ul>
        <li><a href="forms/admin.php">Admin</a></li>
        <li><a href="forms/login.php">Login</a></li>
        <li><a href="forms/register.php">Register</a></li>
        <li id='home'><a href="index.php">Home</a></li>
    </ul>
    <h2><strong>
        <?php 
            include "config.php";
            include "functions.php";

            setUser('unknown', 'unknown');

            echo date("d/m/Y") . ' (' . dayToBulg(date('l')) . ')';
            truncate("single_purchase", $dbConn);
        ?>
    </strong></h2>
    <h1><b><strong>СОД - Магазин</strong></b></h1>
    <h1 style="font-size: 45px; margin-top: 150px"><b><strong>Добре дошли в нашата система за обслужване!</strong></b></h1>
</body>
</html>