<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/cart.css">
</head>
<body>
    <?php 
        include "../config.php";
        include "../functions.php";

        $result = mysqli_query($dbConn, "SELECT * FROM single_purchase");

        if (mysqli_num_rows($result) != 0)
        {
            echo
            "<table id='one' align='center'>
                <tr align='centre'>
                    <th>Продукт</th>
                    <th>Кол. (кг./бр.)</th>
                    <th>Дата</th>
                    <th>Общо (лв.)</th>
                    <th>Клиент</th>
                    <th>Служител</th>
                </tr>";
            while($row = mysqli_fetch_assoc($result)) {
                echo 
                "<tr align='centre'>
                    <td>". getValue($row['product_id'], 'product', $dbConn) . "</td>
                    <td>". sprintf('%.2f', $row['quantity']) . "</td>
                    <td>". $row['datetime'] . "</td>
                    <td>". $row['total'] . "</td>
                    <td>". getValue($row['client_id'], 'client', $dbConn) . "</td>
                    <td>". getValue($row['employee_id'], 'employee', $dbConn) . "</td>" ?>
                    <td>
                        <a href="return_product.php?edit=<?php echo $row['product_id'] ?>"><button class="button">Върни</button></a>
                    </td>
                <?php echo "</tr>";
            }
            echo "</table>";

            echo '<table align="center" style="margin-top: 0px; height: 50px; width: 450px;">
                    <tr>
                        <td>
                            <form style="margin-right: 360px;" align="center" action="make_purchase.php">
                                <input class="two" type="submit" value="Назад" />
                            </form>
                        </td>';

                        $arr = getUser();
                        $userType = $arr[count($arr)-1];

                        if ($userType == 'admin') {
                            echo '<td>
                                    <form style="margin-right: 10px;" align="center" action="../index/index_admin.php">
                                        <input class="two" type="submit" value="Откажи" />  
                                    </form>
                                 </td>';
                        }
                        else if ($userType == 'client') {
                            echo '<td>
                                    <form style="margin-right: 10px;" align="center" action="../index/index_client.php">
                                        <input class="two" type="submit" value="Откажи" />  
                                    </form>
                                 </td>';
                        }
                        else {
                            echo '<td>
                                    <form style="margin-right: 10px;" align="center" action="../index/index_employee.php">
                                        <input class="two" type="submit" value="Откажи" />  
                                    </form>
                                 </td>';
                        }
                        
                  echo' <td>
                            <form align="center" action="finish.php">
                                <input class="two" type="submit" value="Приключи" />
                            </form>
                        </td>
                    </tr>
                </table>';
        }
        else {
            echo "<h1 style='margin-top: 200px;'>Количката е празна! Моля изберете продукти!</h1>";
            echo '<form align="center" action="make_purchase.php">
                    <input class="two" type="submit" value="Назад" />
                  </form>';
        }
    ?>
</body>
</html>