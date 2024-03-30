<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/index_employee.css">
    <link rel="stylesheet" href="../static/nav.css">
</head>
<body>
    <ul>
        <li><a href="../forms/logout.php">Logout</a></li>
        <li id='home'><a href="../index/index_employee.php">Home</a></li>
    </ul>
    <h2><strong>
        <?php 
            include "../config.php";
            include "../functions.php";

            echo date("d/m/Y") . ' (' . dayToBulg(date('l')) . ')';
            truncate("single_purchase", $dbConn);
        ?>
    </strong></h2>
    <h1><b><strong>СОД - Магазин</strong></b></h1>
    <table align="center">
        <tr>
            <td>
                <form action="../purchasing/make_purchase.php">
                    <input class="three" type="submit" value="Направи поръчка" />
                </form>
            </td>
            <td>
                <form action="../purchasing/oborot.php">
                    <input class="two" type="submit" value="Оборот" />
                </form>
            </td>
        </tr>
    </table>
</body>
</html>