<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/index_corr.css">
</head>
<body>
    <table id="table1" align="center">
        <tr>
            <td>
                <form action="../corrections/corr_product.php">
                    <input class="one" type="submit" value="Продукти" />
                </form>
            </td>
            <td>
                <form action="../corrections/corr_client.php">
                    <input class="two" type="submit" value="Kлиенти" />
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form action="../corrections/corr_provider.php">
                    <input class="three" type="submit" value="Доставчици" />
                </form>
            </td>
            <td>
                <form action="../corrections/corr_employee.php">
                    <input class="four" type="submit" value="Служители" />
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form action="../corrections/corr_purchase.php">
                    <input class="five" type="submit" value="Поръчки" />
                </form>
            </td>
            <td>
                <form action="../corrections/corr_delivery.php">
                    <input class="six" type="submit" value="Доставки" />
                </form>
            </td>
        </tr>
    </table>

    <form align='center' action="../index/index_admin.php">
        <input class='seven' type="submit" value="Назад" />
    </form>
</body>
</html>