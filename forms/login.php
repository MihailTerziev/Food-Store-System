<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/design.css">
</head>
<body>
    <h1 style="margin-top: 150px;">Моля въведете своите имена и парола</h1>
    <form id="form" name="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <table align="center" style="margin-top: 20px;">
            <tr>
                <td>Потребител</td>
                <td><input class="one" name="username" type="text" /></td>
            </tr>
            <tr>
                <td>Парола</td>
                <td><input class="one" name="pass" type="password" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Влез" /> <input type="reset" name="reset" value="Изчисти"</td>
            </tr>
        </table>
    </form>
    
    <form align="center" action="../index.php">
        <input class="two" type="submit" value="Назад" />
    </form>
    <?php
        include "../config.php";
        include "../functions.php";

        if (isset($_POST['submit'])) {
            $username = $_POST["username"];
            $pass = $_POST["pass"];

            $foundClient = false;
            $foundEmployee = false;
            $correctPassword = true;

            if (!empty($username) && !empty($pass))
            {
                $sql = "SELECT name, password FROM client";
                $result = mysqli_query($dbConn, $sql);
                if (!$result) die('<h1>Error!</h1>');

                while($row = mysqli_fetch_assoc($result)) {
                    if ($row['name'] == $username) {
                        if ($row['password'] == $pass) {
                            $foundClient = true;
                            break;
                        }
                        else {
                            $correctPassword = false;
                        }
                    }
                }

                if ($foundClient) {
                    setUser($username, 'client');
                    header('Location: http://localhost/StoreUpdated/index/index_client.php?');
                }


                $sql = "SELECT name, password FROM employee WHERE pos_id=1 OR pos_id=6";
                $result = mysqli_query($dbConn, $sql);
                if (!$result) die('<h1>Error!</h1>');

                while($row = mysqli_fetch_assoc($result)) {
                    if ($row['name'] == $username) {
                        if ($row['password'] == $pass) {
                            $foundEmployee = true;
                            break;
                        }
                        else {
                            $correctPassword = false;
                        }
                    }
                }
                
                if ($foundEmployee) {
                    setUser($username, 'employee');
                    header('Location: http://localhost/StoreUpdated/index/index_employee.php?');
                }
                else if (!$correctPassword) {
                    echo "<h1>Грешна парола!!!</h1>";
                }
                else {
                    echo "<h1>Няма потребител с този достъп!!!</h1>";
                }
            }
            else echo "<h1>Не сте въвели всички данни!!!</h1>";
        }
    ?>
</body>
</html>