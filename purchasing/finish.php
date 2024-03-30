<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/design.css">
</head>
<body>
    <?php
        include "../config.php";
        include "../functions.php";

        $arr = getUser();
        $userType = $arr[count($arr)-1];

        $sql = "SELECT * FROM single_purchase";
        $result = mysqli_query($dbConn, $sql);

        $total = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $total += $row['total'];
            $id = $row['product_id'];
            $minus = $row['quantity'];

            $sql = "UPDATE product SET quantity=quantity-$minus WHERE product_id=$id";
            mysqli_query($dbConn, $sql);
            
            $product = $row['product_id'];
            $quantity = $row['quantity'];
            $client = $row['client_id'];
            $employee = $row['employee_id'];
            $date = $row['datetime']; 
            $total_row = $row['total'];

            $sql = "INSERT INTO purchase (product_id, quantity, client_id, employee_id, datetime, total) 
                    VALUES ('$product', '$quantity', '$client', '$employee', '$date', '$total_row')";
            
            mysqli_query($dbConn, $sql);
            if (!$result) die('<h1>Error!</h1>');
        }

        $arr = loadContent("date_and_money.txt");
        $today = $arr[0];
        $oborot = $arr[1];
        
        if ($today != date('d/m/y')) $oborot = 0;

        saveDateAndMoney("date_and_money.txt", ($total + $oborot), date('d/m/y'));

        echo "<strong><h1 style='margin-top: 60px; font-size: 45px;'>Благодарим, че пазарувахте при нас!!!</h1></strong>";
        echo "<strong><h1 style='margin-top: 80px; font-size: 40px;'>Общо: " . sprintf('%.2f', $total) . " лв.</h1></strong>";
        echo "<strong><h1 style='font-size: 40px;'>Желаете ли продуктите ви да бъдат доставени?</h1></strong>";

        echo '<table align="center" style="margin-top: 0px; height: 50px; width: 170px; background-color: #dcf0d7; border: none;">
            <tr>
                <td>
                    <form align="center" action="make_delivery.php">
                        <input class="two" type="submit" value="Да" />  
                    </form>
                </td>';
            
        if ($userType == 'admin') {
            echo '<td>
                    <form align="center" action="../index/index_admin.php">
                        <input class="two" type="submit" value="Не"/> 
                    </form>
                </td>';
        }
        else if ($userType == 'client') {
            echo '<td>
                    <form align="center" action="../index/index_client.php">
                        <input class="two" type="submit" value="Не"/> 
                    </form>
                </td>';
        }
        else {
            echo '<td>
                    <form align="center" action="../index/index_employee.php">
                        <input class="two" type="submit" value="Не"/> 
                    </form>
                </td>';
        }
            
       echo '</tr>
    </table>';
    ?>
</body>
</html>