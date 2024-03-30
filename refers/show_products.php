<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/spec2.css">
</head>
<body>
    <form align="center" action="../index/index_client.php">
        <input class="two" type="submit" value="Назад" />
    </form>
    <?php
        include "../config.php";

        $sql = "SELECT name, price FROM product WHERE quantity > 0";
        $result = mysqli_query($dbConn, $sql);
        
        if (mysqli_num_rows($result) != 0) {
            echo 
                "<table id='one' align='center'>
                    <tr align='centre'>
                        <th>Продукт</th>
                        <th>Цена (бр./кг.)</th>
                    </tr>";
                    while($row = mysqli_fetch_assoc($result)) {
                        echo 
                        "<tr>
                            <td>". $row['name'] . "</td>
                            <td>". $row['price'] . "</td>
                        </tr>";
                    }
            echo "</table>";
        }
        else echo "<h1>Няма продукти!!!</h1>";
    ?>
</body>
</html>