<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/index_add.css">
</head>
<body>
    <table align="center">
        <tr>
            <td>
                <form action="../options/add_product.php">
                    <input class="one" type="submit" value="Продукти" />
                </form>
            </td>
            <td>
                <form action="../options/add_client.php">
                    <input class="two" type="submit" value="Kлиенти" />
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form action="../options/add_provider.php">
                    <input class="three" type="submit" value="Доставчици" />
                </form>
            </td>
            <td>
                <form action="../options/add_employee.php">
                    <input class="four" type="submit" value="Служители" />
                </form>
            </td>
        </tr>
    </table>

    <form align="center" action="../index/index_admin.php">
        <input class="five" type="submit" value="Назад" />
    </form>
</body>
</html>