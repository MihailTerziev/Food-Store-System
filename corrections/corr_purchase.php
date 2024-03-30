<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/corr_purchase.css">
</head>
<body>
    <?php
        include "../config.php";
        include "../functions.php";

        $sql = "SELECT * FROM purchase";
        $result = mysqli_query($dbConn, $sql);
        if (!$result) die('<h1>Error!</h1>');

        if (mysqli_num_rows($result) != 0) {
            echo
            "<table id='one' align='center'>
                <tr align='centre'>
                    <th>Номер</th>
                    <th>Продукт</th>
                    <th>Кол. (кг./бр.)</th>
                    <th>Клиент</th>
                    <th>Служител</th>
                    <th>Дата</th>
                    <th>Общо (лв.)</th>
                </tr>";
            while($row = mysqli_fetch_assoc($result)) {
                echo 
                "<tr>
                    <td>". $row['purchase_id'] . "</td>
                    <td>". getValue($row['product_id'], 'product', $dbConn) . "</td>
                    <td>". $row['quantity'] . "</td>
                    <td>". getValue($row['client_id'], 'client', $dbConn) . "</td>
                    <td>". getValue($row['employee_id'], 'employee', $dbConn) . "</td>
                    <td>". $row['datetime'] . "</td>
                    <td>". $row['total'] . "</td>"; ?>
                    <td>
                        <a href="upd_purchase.php?edit=<?php echo $row['purchase_id'] ?>"><button class="button">Коригирай</button></a>
                    </td>  
                    <td>
                        <a href="del_purchase.php?edit=<?php echo $row['purchase_id'] ?>"><button class="button">Изтрий</button></a>
                    </td>
                <?php echo "</tr>";
            }
            echo "</table>";
        }
        else echo "<h1 style='margin-top: 200px; font-size: 40px;'>Таблицата е празна! Добавете записи.</h1>";
    ?>
    <form align="center" action="../index/index_corr.php">
        <input style="margin-bottom: 50px;" class="two" type="submit" value="Назад" />
    </form>
</body>
</html>