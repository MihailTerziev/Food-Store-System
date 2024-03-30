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
        $sql = "SELECT * FROM employee WHERE employee_id=$id";
        $result = mysqli_query($dbConn, $sql);

        $row1 = mysqli_fetch_assoc($result); 
    ?>

    <form id="form" name="form" method="post" action="#">
        <table align="center">
            <tr>
                <td>Позиция</td>
                <td>
                    <select name="positions">
                        <option value="" disabled selected>---Избери---</option>
                        <?php
                            $result = mysqli_query($dbConn, "SELECT * FROM pos");
                            while($row = mysqli_fetch_assoc($result)) {?>
                                <option value=<?php echo $row['pos_id'] ?>><?php echo $row['name'] ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Телефон</td>
                <td><input class="one" name="tel" type="text" value=<?php echo $row1['tel'] ?>></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Въведи"/> <input type="reset" name="reset" value="Изчисти" /></td>
            </tr>
        </table>
    </form>

    <form align="center" action="corr_employee.php">
        <input class="two" type="submit" value="Назад"/>
    </form>

    <?php
        if (isset($_POST['submit'])) 
        {
            if (isset($_POST["positions"])) $pos = $_POST["positions"];
            else $pos = $row1['pos_id'];

            if (isset($_POST["tel"]) && !empty($_POST["tel"])) $tel = $_POST["tel"];
            else $tel = $row1['tel'];

            $sql = "UPDATE employee SET pos_id=$pos, tel='$tel' WHERE employee_id=$id";
            $result = mysqli_query($dbConn, $sql);
            if (!$result) die('<h1>Error!</h1>');
            else header('Location: http://localhost/StoreUpdated/corrections/corr_employee.php?');
        }
    ?>
</body>
</html>