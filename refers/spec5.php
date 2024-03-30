<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/spec5.css">
</head>
<body>
    <h2>Въведете дата във формат (ДД/ММ/ГГ)</h2>
    <form id="form" name="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <table align="center">
            <tr>
                <td>Дата</td>
                <td><input class="one" name="date" type="text" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Въведи" /> <input type="reset" name="reset" value="Изчисти" /></td>
            </tr>
        </table>
    </form>
    
    <form align="center" action="../references.php">
        <input class="two" type="submit" value="Назад" />
    </form>
    <?php
        include "../config.php";
        include "../functions.php";

        if (isset($_POST['submit'])) {
            $date = $_POST["date"];

            if (!empty($date))
            {
                $sql = "SELECT * FROM delivery WHERE datetime='$date'";
                $result = mysqli_query($dbConn, $sql);
                if (!$result) die('<h1>Error!</h1>');

                if (mysqli_num_rows($result) != 0) {
                    echo 
                    "<table id='one' align='center'>
                        <tr align='centre'>
                            <th>Номер</th>
                            <th>Продукт</th>
                            <th>Група</th>
                            <th>Кол. (кг./бр.)</th>
                            <th>Дост. (лв.)</th>
                            <th>Доставчик</th>
                        </tr>";
                    while($row = mysqli_fetch_assoc($result)) {
                        echo 
                        "<tr>
                             <td>". $row['delivery_id'] . "</td>
                             <td>". getValue($row['product_id'], 'product', $dbConn) . "</td>
                             <td>". getValue($row['gp_id'], 'gp', $dbConn) . "</td>
                             <td>". $row['quantity'] . "</td>
                             <td>". $row['del_price'] . "</td>
                             <td>". getValue($row['provider_id'], 'provider', $dbConn) . "</td>
                         </tr>";
                    }
                    echo "</table>";
                }
                else echo "<h1>Няма записи за тази дата!</h1>";
            }
            else echo "<h1>Не сте въвели всички данни!!!</h1>";
        }
    ?>
</body>
</html>