<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/upd_purchase.css">
</head>
<body>
    <?php
        include "../config.php";
        include "../functions.php";

        $id = $_GET['edit'];
        $sql = "SELECT * FROM purchase WHERE purchase_id='$id'";
        $result = mysqli_query($dbConn, $sql);

        $row1 = mysqli_fetch_assoc($result);
    ?>

    <form id="form" name="form" method="post" action="#">
        <table align="center">
            <tr>
                <td>Продукт</td>
                <td>
                    <select name="products">
                        <option value="" disabled selected>---Избери---</option>
                        <?php
                            $result = mysqli_query($dbConn, "SELECT * FROM product");
                            while($row = mysqli_fetch_assoc($result)) {?>
                                <option value=<?php echo $row['product_id'] ?>><?php echo $row['name'] ?></option>
                        <?php } ?> 
                    </select>
                </td>
            </tr>
            <tr>
                <td>Кол. (кг./бр.)</td>
                <td><input name="quantity" type="text" value=<?php echo $row1['quantity'] ?>></td>
            </tr>
            <tr>
                <td>Клиент</td>
                <td>
                    <select name="clients">
                        <option value="" disabled selected>---Избери---</option>
                        <?php
                            $result = mysqli_query($dbConn, "SELECT * FROM client");
                            while($row = mysqli_fetch_assoc($result)) {?>
                                <option value=<?php echo $row['client_id'] ?>><?php echo $row['name'] ?></option>
                        <?php } ?> 
                    </select>
                </td>
            <tr>
                <td>Служител</td>
                <td>
                    <select name="employees">
                        <option value="" disabled selected>---Избери---</option>
                        <?php
                            $result = mysqli_query($dbConn, "SELECT * FROM employee");
                            while($row = mysqli_fetch_assoc($result)) {?>
                                <option value=<?php echo $row['employee_id'] ?>><?php echo $row['name'] ?></option>
                        <?php } ?> 
                    </select>
                </td>
            </tr>
            <tr>
                <td>Дата (ДД/ММ/ГГ)</td>
                <td><input name="datetime" type="text" value=<?php echo $row1['datetime'] ?>></td>
            </tr>
            <tr>
                <td>Общо (лв.)</td>
                <td><input name="total" type="text" value=<?php echo $row1['total'] ?>></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Въведи" /> <input type="reset" name="reset" value="Изчисти" /></td>
            </tr>
        </table>
    </form>
    
    <form align="center" action="corr_purchase.php">
        <input class="two" type="submit" value="Назад" />
    </form>

    <?php
        if (isset($_POST['submit'])) 
        {   
            if (isset($_POST["products"])) $product = $_POST["products"];
            else $product = $row1['product_id'];

            if (isset($_POST["quantity"]) && !empty($_POST["quantity"])) $quantity = $_POST["quantity"];
            else $quantity = $row1['quantity'];
            
            if (isset($_POST["clients"])) $client = $_POST["clients"];
            else $client = $row1['client_id'];

            if (isset($_POST["employees"])) $employee = $_POST["employees"];
            else $employee = $row1['employee_id'];

            if (isset($_POST["datetime"]) && !empty($_POST["datetime"])) $date = $_POST["datetime"];
            else $date = $row1['datetime'];

            if (isset($_POST["total"]) && !empty($_POST["total"])) $total = $_POST["total"];
            else $total = $row1['total'];

            $arr = loadContent("/xampp/htdocs/StoreUpdated/purchasing/date_and_money.txt");
            $today = $arr[0];
            $oborot = $arr[1];

            $oborot -= $total; 
            $sql = "SELECT price FROM product WHERE product_id=$product";
            $result = mysqli_query($dbConn, $sql);
            $row = mysqli_fetch_assoc($result);
            $total = $quantity * $row['price'];

            saveDateAndMoney("/xampp/htdocs/StoreUpdated/purchasing/date_and_money.txt", ($total + $oborot), $today);

            $sql = "UPDATE purchase
                        SET product_id=$product, quantity=$quantity, client_id=$client, 
                            employee_id=$employee, datetime='$date', total=$total
                    WHERE purchase_id=$id";

            $result = mysqli_query($dbConn, $sql);
            if (!$result) die('<h1>Error!</h1>');
            else echo "<h1>Променихте запис!</h1>";
        }
    ?>
</body>
</html>