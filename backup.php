<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/design.css">
</head>
<body>
    <?php
        include "config.php";
        include "functions.php";

        backup('client', 'clients.sql', $dbConn);
        backup('employee', 'employees.sql', $dbConn);
        backup('gp', 'groups.sql', $dbConn);
        backup('product', 'products.sql', $dbConn);
        backup('provider', 'providers.sql', $dbConn);
        backup('purchase', 'purchases.sql', $dbConn);
        backup('delivery', 'deliveries.sql', $dbConn);
        backup('pos', 'positions.sql', $dbConn);
        backup('admin', 'admins.sql', $dbConn);

        echo "<h1 style='margin-top: 270px; font-size: 35px;'>
            Backed-up data successfully!<br>Може да намерите файловете \backups в директорията.
        </h1>";
    ?>
    <form align="center" action="index/index_admin.php">
        <input class="two" type="submit" value="Назад" />
    </form>
</body>
</html>