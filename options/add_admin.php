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
                <td>Username</td>
                <td><input class="one" name="username" type="text" /></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input class="one" name="pass" type="password" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Добави" /> <input type="reset" name="reset" value="Изчисти" /></td>
            </tr>
        </table>
    </form>
    
    <form align="center" action="../index/index_admin.php">
        <input class="two" type="submit" value="Назад" />
    </form>
    <?php
        include "../config.php";

        if (isset($_POST['submit'])) {
            $username = $_POST["username"];
            $pass = $_POST["pass"];

            if (!empty($username) && !empty($pass))
            {
                $sql = "INSERT INTO admin (username, password) VALUES ('$username', '$pass')";

                $result = mysqli_query($dbConn, $sql);
                if (!$result) die('<h1>Error!</h1>');
                else header('Location: http://localhost/StoreUpdated/index/index_admin.php?');
            }
            else echo "<h1>Не сте въвели всички данни!!!</h1>";
        }
    ?>
</body>
</html>