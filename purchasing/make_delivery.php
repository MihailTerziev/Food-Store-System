<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/make_delivery.css">
</head>
<body>
    <h1>Изберете доставчик</h1>
    <form id="form" name="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <table align="center">
            <tr>
                <td>Доставчик</td>
                <td>
                    <select name="providers">
                        <option value="" disabled selected>---Избери---</option>
                        <?php
                            include "../config.php";
                            include "../functions.php";

                            $result = mysqli_query($dbConn, "SELECT * FROM provider");
                            while($row = mysqli_fetch_assoc($result)) {?>
                                <option value=<?php echo $row['provider_id'] ?>><?php echo $row['name'] ?></option>
                        <?php } ?> 
                    </select>
                </td>
            </tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Въведи" /></td>
            </tr>
        </table>
    </form>

    <?php
        $arr = getUser();
        $userType = $arr[count($arr)-1];

        if ($userType == 'admin') {
            echo '<form align="center" action="../index/index_admin.php">
                    <input class="two" type="submit" value="Откажи"/>  
                </form>';
        }
        else {
            echo '<form align="center" action="../index/index_employee.php">
                    <input class="two" type="submit" value="Откажи"/>  
                </form>';
        }

        function addDeliveryRecord($query_res, $dbConn, $provider) {
            $total = 0;

            while ($row = mysqli_fetch_assoc($query_res)) 
            {
                $product = $row['product_id'];
                $quantity = $row['quantity'];
                $date = $row['datetime'];
                $price = mt_rand(1, 3) - 2.00 / mt_rand(1, 5);
                if ($price < 1.00) $price += 1.00; 
                $total += round($price, 2);
                
                $sql = "SELECT gp_id FROM product WHERE product_id=$product";
                $result = mysqli_query($dbConn, $sql);
                $row = mysqli_fetch_assoc($result);
                $group = $row['gp_id'];

                $sql = "INSERT INTO delivery (product_id, gp_id, quantity, del_price, provider_id, datetime) 
                VALUES ('$product', '$group', '$quantity', '$price', '$provider', '$date')";

                $result = mysqli_query($dbConn, $sql);
                if (!$result) die('Error!');
            }

            return $total;
        }
            

        if (isset($_POST['submit'])) {
            if (isset($_POST["providers"])) $name = $_POST["providers"];
            else $name = '';

            if (!empty($name))
            {
                $sql = "SELECT product_id, datetime, quantity FROM single_purchase";
                $result = mysqli_query($dbConn, $sql);
                $total = addDeliveryRecord($result, $dbConn, $name);
            }
            else echo "Не сте въвели всички данни!!!";

            echo "<h1 style='font-size: 40px; margin-top: 70px;';>Цена на доставка: " . sprintf('%.2f', $total) . " лв.</h1>";
            echo "<h1 style='font-size: 40px;'>Очаквайте доставката до 1 час. Приятен ден!</h1>";

            if ($userType == 'admin') {
                echo '<form align="center" action="../index/index_admin.php">
                        <input class="two" type="submit" value="Към меню"/>  
                    </form>';
            }
            else if ($userType == 'employee') {
                echo '<form align="center" action="../index/index_employee.php">
                        <input class="two" type="submit" value="Към меню"/>  
                    </form>';
            }
            else {
                echo '<form align="center" action="../index/index_client.php">
                        <input class="two" type="submit" value="Към меню"/>  
                    </form>';
            }
        }
    ?>
</body>
</html>