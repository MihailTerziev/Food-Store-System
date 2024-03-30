<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/upd_delivery.css">
</head>
<body>
    <?php
        include "../config.php";

        $id = $_GET['edit'];
        $sql = "SELECT * FROM delivery WHERE delivery_id='$id'";
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
                <td>Група</td>
                <td>
                    <select name="groups">
                        <option value="" disabled selected>---Избери---</option>
                        <?php
                            $result = mysqli_query($dbConn, "SELECT * FROM gp");
                            while($row = mysqli_fetch_assoc($result)) {?>
                                <option value=<?php echo $row['gp_id'] ?>><?php echo $row['name'] ?></option>
                        <?php } ?> 
                    </select>
                </td>
            </tr>
            <tr>
                <td>Кол. (кг./бр.)</td>
                <td><input name="quantity" type="text" value=<?php echo $row1['quantity'] ?>></td>
            </tr>
            <tr>
                <td>Дост. (лв.)</td>
                <td><input name="del_price" type="text" value=<?php echo $row1['del_price'] ?>></td>
            </tr>
            <tr>
                <td>Доставчик</td>
                <td>
                    <select name="providers">
                        <option value="" disabled selected>---Избери---</option>
                        <?php
                            $result = mysqli_query($dbConn, "SELECT * FROM provider");
                            while($row = mysqli_fetch_assoc($result)) {?>
                                <option value=<?php echo $row['provider_id'] ?>><?php echo $row['name'] ?></option>
                        <?php } ?> 
                    </select>
                </td>
            </tr>
            <tr>
                <td>Дата (ДД/ММ/ГГ)</td>
                <td><input name="datetime" type="text" value=<?php echo $row1['datetime'] ?>></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Въведи" /> <input type="reset" name="reset" value="Изчисти" /></td>
            </tr>
        </table>
    </form>

    <form align="center" action="corr_delivery.php">
        <input class="two" type="submit" value="Назад" />
    </form>

    <?php
        if (isset($_POST['submit'])) 
        {
            if (isset($_POST["products"])) $product = $_POST["products"];
            else $product = $row1['product_id'];

            if (isset($_POST["groups"])) $group = $_POST["groups"];
            else $group = $row1['gp_id'];

            if (isset($_POST["quantity"]) && !empty($_POST["quantity"])) $quantity = $_POST["quantity"];
            else $quantity = $row1['quantity'];
            
            if (isset($_POST["del_price"]) && !empty($_POST["del_price"])) $price = $_POST["del_price"];
            else $price = $row1['del_price'];

            if (isset($_POST["providers"])) $provider = $_POST["providers"];
            else $provider = $row1['provider_id'];

            if (isset($_POST["datetime"]) && !empty($_POST["datetime"])) $date = $_POST["datetime"];
            else $date = $row1['datetime'];

            $sql = "UPDATE delivery
                        SET product_id=$product, gp_id=$group, quantity=$quantity, 
                            del_price=$price, provider_id=$provider, datetime='$date'
                    WHERE delivery_id=$id";

            $result = mysqli_query($dbConn, $sql);
            if (!$result) die('<h1>Error!</h1>');
            else echo "<h1>Променихте запис!</h1>";
        }
    ?>
</body>
</html>