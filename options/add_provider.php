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
        <table align="center" style="width: 350px;">
            <tr>
                <td>Име</td>
                <td><input class="one" name="name" type="text" /></td>
            </tr>
            <tr>
                <td>ЕИК</td>
                <td><input class="one" name="eik" type="text" /></td>
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
        include "../config.php";

        if (isset($_POST['submit'])) {
            $name = $_POST["name"];
            $eik = $_POST["eik"];

            if (!empty($name) && !empty($eik))
            {
                $sql="INSERT INTO provider (name, eik) VALUES ('$name', '$eik')";

                $result = mysqli_query($dbConn, $sql);
                if (!$result) die('<h1>Error!</h1>');
                else echo header('Location: http://localhost/StoreUpdated/index/index_admin.php?');
            }
            else echo "<h1>Не сте въвели всички данни!!!</h1>";
        }
    ?>
</body>
</html>