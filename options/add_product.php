<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/design.css">
</head>
<body>
    <form id="form" name="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <table align="center" style="width: 450px;">
            <tr>
                <td>Име</td>
                <td><input class="one" name="name" type="text" /></td>
            </tr>
            <tr>
                <td>Група</td>
                <td>
                    <select name="groups">
                        <option value="" disabled selected>---Избери---</option>
                        <?php
                            include "../config.php";
                            $result = mysqli_query($dbConn, "SELECT * FROM gp");
                            while($row = mysqli_fetch_assoc($result)) {?>
                                <option value=<?php echo $row['gp_id'] ?>><?php echo $row['name'] ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Ед. цена (лв.)</td>
                <td><input class="one" name="price" type="text" /></td>
            </tr>
            <tr>
                <td>Кол. (кг./бр.)</td>
                <td><input class="one" name="quantity" type="text" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input class="one" type="submit" name="submit" value="Въведи" /> <input type="reset" name="reset" value="Изчисти" /></td>
            </tr>
        </table>
    </form>

    <form align="center" action="../index/index_add.php">
        <input class="two" type="submit" value="Назад" />
    </form>
    <?php
        if (isset($_POST['submit'])) {
            $name = $_POST["name"];
            $price = $_POST["price"];
            $quantity = $_POST["quantity"];

            if (isset($_POST["groups"])) $group = $_POST["groups"];
            else $group = '';

            if (!empty($name) && !empty($group) && !empty($price) && !empty($quantity))
            {   
                $validPrice = true;
                $validQuantity = true;

                if (!is_numeric($price) && $price < 0) {
                    $validPrice = false;
                    echo "<h1>Моля въведете подходяща цена!!!</h1>";
                }
                if (!is_numeric($quantity) && $quantity < 0) {
                    $validQuantity = false;
                    echo "<h1>Моля въведете подходящо количество!!!</h1>";
                }
                
                if ($validPrice && $validQuantity) {
                    $sql = "SELECT quantity FROM product WHERE name='$name'";
                    $result = mysqli_query($dbConn, $sql);

                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        $quantity += $row['quantity'];
                        $sql = "UPDATE product SET quantity=$quantity WHERE name='$name'";
                        $result = mysqli_query($dbConn, $sql);
                        if (!$result) die('<h1>Error!Line74</h1>');
                    }
                    else {
                        $sql="INSERT INTO product (name, gp_id, price, quantity) VALUES ('$name', '$group', '$price', '$quantity')";
                        $result = mysqli_query($dbConn, $sql);
                        if (!$result) die('<h1>Error!Line80</h1>');
                    }

                    header('Location: http://localhost/StoreUpdated/index/index_admin.php?');
                }
            }
            else echo "<h1>Не сте въвели всички данни!!!</h1>";
        }
    ?>
</body>
</html>