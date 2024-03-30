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
                <td>Телефон</td>
                <td><input class="one" name="tel" type="text" /></td>
            </tr>
            <tr>
                <td>Парола</td>
                <td><input class="one" name="pass" type="password" /></td>
            </tr>
            <tr>
                <td>Повтори парола</td>
                <td><input class="one" name="repass" type="password" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Регистрирай" /> <input type="reset" name="reset" value="Изчисти" /></td>
            </tr>
        </table>
    </form>
    
    <?php
        include "../config.php";
        include "../functions.php";

        $arr = getUser();
        $userType = $arr[count($arr)-1];

        if ($userType == 'admin') {
            echo '<form align="center" action="../index/index_add.php">
                    <input class="two" type="submit" value="Назад" />
                 </form>';
        }
        else {
            echo '<form align="center" action="../index.php">
                    <input class="two" type="submit" value="Назад" />
                </form>';
        }
                
        if (isset($_POST['submit'])) {
            $name = $_POST["name"];
            $tel = $_POST["tel"];
            $pass = $_POST["pass"];
            $repass = $_POST["repass"];

            if (!empty($name) && !empty($tel) && !empty($pass) && !empty($repass))
            {
                if ($pass == $repass) {
                    $sql = "INSERT INTO client (name, tel, password) VALUES ('$name', '$tel', '$pass')";
                    $result = mysqli_query($dbConn, $sql);

                    if (!$result) die('<h1>Error!</h1>');
                    else if ($userType == 'admin')
                        header('Location: http://localhost/StoreUpdated/index/index_admin.php?');
                    else 
                        header('Location: http://localhost/StoreUpdated/index/index_client.php?');
                }
                else echo "<h1>Паролите не съвпадат! Пробвайте отново да въведете.</h1>";
            }
            else echo "<h1>Не сте въвели всички данни!!!</h1>";
        }
    ?>
</body>
</html>