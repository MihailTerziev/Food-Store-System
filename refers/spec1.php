<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/spec1.css">
</head>
<body>
    <h2>Въведете дати за период във формат (ДД/ММ/ГГ)</h2>
    <form id="form" name="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <table align="center">
            <tr>
                <td>От</td>
                <td><input class="one" name="from" type="text" /></td>
            </tr>
            <tr>
                <td>До</td>
                <td><input class="one" name="to" type="text" /></td>
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
            $date1 = $_POST["from"];
            $date2 = $_POST["to"];

            if (!empty($date1) && !empty($date2))
            {
                $sql = "SELECT * FROM purchase WHERE datetime BETWEEN DATE('$date1') AND DATE('$date2');";
                $result = mysqli_query($dbConn, $sql);
                if (!$result) die('<h1>Error!</h1>');

                if (mysqli_num_rows($result) != 0) {
                    echo "
                    <table id='one' align='center'>
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
                             <td>". $row['total'] . "</td>
                         </tr>";
                    }
                    echo "</table>";
                }
                else echo "<h1>Няма записи за този период! Проверете датите!</h1>";
            }
            else echo "<h1>Не сте въвели всички данни!!!</h1>";
        }
    ?>
</body>
</html>