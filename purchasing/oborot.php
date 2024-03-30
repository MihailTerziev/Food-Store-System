<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/oborot.css">
</head>
<body>
    <?php
        include "../functions.php";
        include "../config.php";

        $arr = loadContent("date_and_money.txt");
        $today = $arr[0];
        $oborot = $arr[1];
        
        if ($today != date('d/m/y')) {
            $oborot = 0;
            $today = date('d/m/y');
            saveDateAndMoney("date_and_money.txt", $oborot, $today);
        }

        echo "<h1>Оборот за деня: " . sprintf('%.2f', $oborot) . " лв.</h1>";

        $arr1 = getUser();
        $userType = $arr1[count($arr1)-1];

        if ($userType == 'admin') {
            echo '<form align="center" action="../index/index_admin.php">
                    <input class="two" type="submit" value="Назад" />
                 </form>';
        }
        else {
            echo '<form align="center" action="../index/index_employee.php">
                    <input class="two" type="submit" value="Назад" />
                 </form>';
        }
        
        $sql = "SELECT * FROM purchase WHERE datetime='$today'";
        $result = mysqli_query($dbConn, $sql);
        $id = 0;

        if (mysqli_num_rows($result) != 0)
        {
            echo
            "<table id='one' align='center'>
                <tr align='centre'>
                    <th>Номер</th>
                    <th>Продукт</th>
                    <th>Кол. (кг./бр.)</th>
                    <th>Дата</th>
                    <th>Общо (лв.)</th>
                    <th>Клиент</th>
                    <th>Работник</th>
                </tr>";
            while($row = mysqli_fetch_assoc($result)) {
                echo 
                "<tr>
                    <td>". ++$id . "</td>
                    <td>". getValue($row['product_id'], "product", $dbConn) . "</td>
                    <td>". sprintf('%.2f', $row['quantity']) . "</td>
                    <td>". $row['datetime'] . "</td>
                    <td>". $row['total'] . "</td>
                    <td>". getValue($row['client_id'], "client", $dbConn) . "</td>
                    <td>". getValue($row['employee_id'], "employee", $dbConn) . "</td>
                </tr>";
            }
            echo "</table>";
        }
        else echo "<h1><strong>Няма записи за днешна дата!</strong></h1>";
    ?>
</body>
</html>