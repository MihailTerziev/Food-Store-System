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

        $id = $_GET['edit'];
        $sql = "SELECT * FROM client WHERE client_id='$id'";
        $result = mysqli_query($dbConn, $sql);

        $row = mysqli_fetch_assoc($result); 
    ?>

    <form id="form" name="form" method="post" action="#">
        <table align="center">
            <tr>
                <td>Име</td>
                <td><input class="one" name="name" type="text" /></td>
            </tr>
            <tr>
                <td>Телефон</td>
                <td><input class="one" name="tel" type="text" value=<?php echo $row['tel'] ?>></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Въведи" /> <input type="reset" name="reset" value="Изчисти" /></td>
            </tr>
        </table>
    </form>

    <form align="center" action="corr_client.php">
        <input class="two" type="submit" value="Назад" />
    </form>

    <?php
        if (isset($_POST['submit'])) 
        {
            if (isset($_POST["name"]) && !empty($_POST["name"])) $name = $_POST["name"];
            else $name = $row['name'];

            if (isset($_POST["tel"]) && !empty($_POST["tel"])) $tel = $_POST["tel"];
            else $tel = $row['tel'];

            $sql = "UPDATE client SET name='$name', tel='$tel' WHERE client_id=$id";
            $result = mysqli_query($dbConn, $sql);
            if (!$result) die('<h1>Error!</h1>');
            else header('Location: http://localhost/StoreUpdated/corrections/corr_client.php?');
        }
    ?>
</body>
</html>