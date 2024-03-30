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
        <table align="center">
            <tr>
                <td>Име</td>
                <td><input class="one" name="name" type="text" /></td>
            </tr>
            <tr>
                <td>Позиция</td>
                <td>
                    <select name="positions">
                        <option value="" disabled selected>---Избери---</option>
                        <?php
                            include "../config.php";
                            $result = mysqli_query($dbConn, "SELECT * FROM pos");
                            while($row = mysqli_fetch_assoc($result)) {?>
                                <option value=<?php echo $row['pos_id'] ?>><?php echo $row['name'] ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Телефон</td>
                <td><input class="one" name="tel" type="text" /></td>
            </tr>
            <tr>
                <td>Парола</td>
                <td><input class="one" name="pass" type="password" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Въведи" /> <input type="reset" name="reset" value="Изчисти" /></td>
            </tr>
        </table>
    </form>

    <form align="center" action="../index/index_add.php">
        <input class="two" type="submit" value="Назад" />
    </form>
    <?php
        if (isset($_POST['submit'])) {
            $name = $_POST["name"];
            $tel = $_POST["tel"];
            $pass = $_POST["pass"];

            if (isset($_POST["positions"])) $pos = $_POST["positions"];
            else $pos = ''; 
            
            if (!empty($name) && !empty($tel) && !empty($pos) && !empty($pass))
            {
                $sql = "INSERT INTO employee (name, pos_id, tel, password) VALUES ('$name', '$pos', '$tel', '$pass')";

                $result = mysqli_query($dbConn, $sql);
                if (!$result) die('<h1>Error!</h1>');
                else header('Location: http://localhost/StoreUpdated/index/index_admin.php?');
            }
            else echo "<h1>Не сте въвели всички данни!!!</h1>";
        }
    ?>
</body>
</html>