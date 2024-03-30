<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/make_purchase.css">
</head>
<body>
    <form id="form" name="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <table align="center">
            <tr>
                <td>Продукт</td>
                <td>
                    <select name="products">
                        <option value="" disabled selected>---Избери---</option>
                        <?php
                            include "../config.php";
                            include "../functions.php";

                            $result = mysqli_query($dbConn, "SELECT * FROM product WHERE quantity > 10");
                            while($row = mysqli_fetch_assoc($result)) {?>
                                <option value=<?php echo $row['product_id'] ?>><?php echo $row['name'] ?></option>
                        <?php } ?> 
                    </select>
                </td>
            </tr>
            <tr>
                <td>Кол. (кг./бр.)</td>
                <td><input name="quantity" type="text" /></td>
            </tr>
            <tr>
                <?php
                    $arr = getUser();
                    $userName = $arr[0];
                    $userType = $arr[count($arr)-1];
                    
                    if ($userType != 'admin') {
                        $userName = $arr[0].' '.$arr[1];
                    }

                    if ($userType == 'admin' || $userType == 'employee') {?>
                        <td>Клиент</td>
                        <td>
                            <select name="clients">
                            <option value="" disabled selected>---Избери---</option>';
                            <?php
                                $result = mysqli_query($dbConn, "SELECT * FROM client");
                                while($row = mysqli_fetch_assoc($result)) {?>
                                    <option value=<?php echo $row['client_id'] ?>><?php echo $row['name'] ?></option>
                            <?php }?> 
                            </select>
                        </td>
                <?php } ?>        
            <tr>
            <?php 
                if ($userType == 'admin') {?>
                        <td>Служител</td>
                        <td>
                            <select name="employees">
                            <option value="" disabled selected>---Избери---</option>
                            <?php
                                $result = mysqli_query($dbConn, "SELECT * FROM employee WHERE pos_id=1 OR pos_id=6");
                                while($row = mysqli_fetch_assoc($result)) {?>
                                    <option value=<?php echo $row['employee_id'] ?>><?php echo $row['name'] ?></option>
                            <?php } ?> 
                            </select>
                        </td>
                <?php } ?> 
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Въведи" /> <input type="reset" name="reset" value="Изчисти" /></td>
            </tr>
        </table>
    </form>
    
    <table align="center" style="margin-top: 0px; height: 30px; width: 150px; border: none; background-color: #dcf0d7;">
        <tr>
            <td>
                <?php        
                    if ($userType == 'admin') {
                        echo '<form style="margin-right: 120px;" align="center" action="../index/index_admin.php">
                                <input class="two" type="submit" value="Назад" />
                             </form>';
                    }
                    else if ($userType == 'employee') {
                        echo '<form style="margin-right: 120px;" align="center" action="../index/index_employee.php">
                                <input class="two" type="submit" value="Назад" />
                             </form>';
                    }
                    else {
                        echo '<form style="margin-right: 120px;" align="center" action="../index/index_client.php">
                                <input class="two" type="submit" value="Назад" />
                             </form>';
                    }
                ?>
            </td>
            <td>
                <form style="margin-left: 10px;" align="center" action="cart.php">
                    <input class="two" type="submit" value="Към количка" />
                </form>
            </td>
        </tr>
    </table>
    <?php
        if (isset($_POST['submit'])) {
            if (isset($_POST["products"])) $product = $_POST["products"];
            else $product = ''; 

            if (isset($_POST["clients"])) $client = $_POST["clients"];
            else if ($userType == "client") $client = getId($userName, "client", $dbConn);
            else $client = 1;

            if (isset($_POST["employees"])) $employee = $_POST["employees"];
            else if ($userType == "employee") $employee = getId($userName, "employee", $dbConn);
            else $employee = 1;

            $quantity = $_POST["quantity"];
            $date = date("d/m/y");

            if (!empty($product) && !empty($quantity) && !empty($date) && !empty($client) && !empty($employee))
            {   
                $validQuantity = true;

                if (!is_numeric($quantity) && $quantity < 0) {
                    $validQuantity = false;
                    echo "<h1>Моля въведете подходящo количество!!!</h1>";
                }

                if ($validQuantity) {
                    $sql = "SELECT quantity FROM product WHERE product_id=$product";
                    $result = mysqli_query($dbConn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    if ($row['quantity']-10 >= $quantity) {
                        $total = 0;
                        $sql = "SELECT price FROM product WHERE product_id=$product";
                        $result = mysqli_query($dbConn, $sql);
                    
                        if (mysqli_num_rows($result) != 0) {
                            $row = mysqli_fetch_assoc($result);
                            $total = $quantity * $row['price'];
                        }

                        $sql = "INSERT INTO single_purchase (product_id, quantity, client_id, employee_id, datetime, total) 
                                VALUES ('$product', '$quantity', '$client', '$employee', '$date', '$total')";
                            
                        $result = mysqli_query($dbConn, $sql);
                        if (!$result) die('<h1>Error!</h1>');
                        else echo "<h1>Добавихте в количката!</h1>";
                    }
                    else echo "<h1>Вмомента не можете да поръчате такова количество!!!</h1>";
                }
            }
            else echo "<h1>Не сте въвели всички данни!!!</h1>";
        }
    ?>
</body>
</html>