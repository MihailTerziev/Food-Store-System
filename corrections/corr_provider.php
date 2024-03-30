<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/corr_provider.css">
</head>
<body>
    <?php
        include "../config.php";

        $sql = "SELECT * FROM provider";
        $result = mysqli_query($dbConn, $sql);
        if (!$result) die('<h1>Error!</h1>');

        if (mysqli_num_rows($result) != 0) {
            echo
            "<table id='one' align='center'>
                <tr align='centre'>
                    <th>Номер</th>
                    <th>Име</th>
                    <th>ЕИК</th>
                </tr>";
            while($row = mysqli_fetch_assoc($result)) {
                echo 
                "<tr>
                    <td>". $row['provider_id'] . "</td>
                    <td>". $row['name'] . "</td>
                    <td>". $row['eik'] . "</td>"; ?>
                    <td>
                        <a href="upd_provider.php?edit=<?php echo $row['provider_id'] ?>"><button class="button">Коригирай</button></a>
                    </td>  
                    <td>
                        <a href="del_provider.php?edit=<?php echo $row['provider_id'] ?>"><button class="button">Изтрий</button></a>
                    </td>
                <?php echo "</tr>";
            }
            echo "</table>";
        }
        else echo "<h1 style='margin-top: 200px; font-size: 40px;'>Таблицата е празна! Добавете записи.</h1>";
    ?>
    <form align="center" action="../index/index_corr.php">
        <input class="two" type="submit" value="Назад" />
    </form>
</body>
</html>