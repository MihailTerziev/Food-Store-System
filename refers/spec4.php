<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/spec4.css">
</head>
<body>
    <?php
        include "../config.php";
        include "../functions.php";

        $sql = "SELECT product.name as Product, SUM(purchase.quantity) as Counter FROM purchase
                INNER JOIN product ON product.product_id = purchase.product_id
                GROUP BY product.name
                ORDER BY Counter DESC LIMIT 5";   
                                
        $result = mysqli_query($dbConn, $sql);
        if (!$result) die('<h1>Error!</h1>');

        if (mysqli_num_rows($result) != 0) {
            echo
            "<table id='one' align='center'>
                    <tr align='centre'>
                        <th>Продукт</th>
                        <th>Прод. (кг./бр.)</th>
                    </tr>";
            while($row = mysqli_fetch_assoc($result)) {
                echo 
                    "<tr>
                        <td>". $row['Product'] . "</td>
                        <td>". $row['Counter'] . "</td>
                    </tr>";
            }
            echo "</table>";
        }
        else echo "<h1>Няма записи за поръчки!</h1>";
    ?>
    <form align="center" action="../references.php">
        <input class="two" type="submit" value="Назад" />
    </form>
</body>
</html>