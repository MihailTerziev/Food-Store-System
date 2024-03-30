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

        $id = $_GET['edit'];  // казва че е undefined след submit на формата, пък го принтира ако се извика echo
        $sql = "SELECT * FROM product WHERE product_id='$id'";
        $result = mysqli_query($dbConn, $sql);

        $row1 = mysqli_fetch_assoc($result); // взимаме реда който ще update-ваме
    ?>

    <form id="form" name="form" method="post" action="#">
        <table align="center" style="width: 500px;">
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
                <td>Ед. цена (лв.)</td>
                <td><input class="one" name="price" type="text" value=<?php echo $row1['price'] ?>></td>
            </tr>
            <tr>
                <td>Количество (кг.)</td>
                <td><input class="one" name="quantity" type="text" value=<?php echo $row1['quantity'] ?>></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input class="one" type="submit" name="submit" value="Въведи" /> <input type="reset" name="reset" value="Изчисти" /></td>
            </tr>
        </table>
    </form>

    <form align="center" action="corr_product.php">
        <input class="two" type="submit" value="Назад" />
    </form>

    <?php
        if (isset($_POST['submit'])) 
        {
            if (isset($_POST["groups"])) $group = $_POST["groups"];
            else $group = $row1['gp_id'];
            
            if (isset($_POST["price"]) && !empty($_POST["price"])) $price = $_POST["price"];
            else $price = $row1['price'];

            if (isset($_POST["quantity"]) && !empty($_POST["quantity"])) $quantity = $_POST["quantity"];
            else $quantity = $row1['quantity'];

            $sql = "UPDATE product 
                    SET gp_id=$group, price=$price, quantity=$quantity
                    WHERE product_id=$id";

            $result = mysqli_query($dbConn, $sql);
            if (!$result) die('<h1>Error!</h1>');
            else header('Location: http://localhost/StoreUpdated/corrections/corr_product.php?');
        }
    ?>
</body>
</html>