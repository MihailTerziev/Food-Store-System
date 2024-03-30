<?php
    include "config.php";

    $tbl_name = 'admin';

    $sql = "CREATE TABLE IF NOT EXISTS $tbl_name( 
        admin_id INT(5) NOT NULL AUTO_INCREMENT,
        username VARCHAR(30) NOT NULL,
        password VARCHAR(50) NOT NULL,
        PRIMARY KEY (admin_id)
    )
    ENGINE=INNODB DEFAULT CHARSET=utf8";

    $result = mysqli_query($dbConn, $sql);
    if(!$result) die("Грешка при създаване на таблицата $tbl_name!");

    $sql = "INSERT INTO admin (username, password) 
            VALUES ('master01', 'm123456')";

    mysqli_query($dbConn, $sql);


    $tbl_name = 'gp'; // group of the product -> vegies, meat, spices ...

    $sql = "CREATE TABLE IF NOT EXISTS $tbl_name( 
        gp_id INT(5) NOT NULL AUTO_INCREMENT,
        name VARCHAR(30) NOT NULL,
        PRIMARY KEY (gp_id)
    )
    ENGINE=INNODB DEFAULT CHARSET=utf8";

    $result = mysqli_query($dbConn, $sql);
    if(!$result) die("Грешка при създаване на таблицата $tbl_name!");

    $sql = "INSERT INTO gp (name) VALUES 
            ('Зеленчуци'), ('Плодове'), ('Консерви'),
            ('Сладки/Шоколади'), ('Препарати'), ('Млечни продукти'),
            ('Месо'), ('Хляб/Тестени'), ('Подправки'),
            ('Домашни потреби'), ('Санитарни продукти'),
            ('Алкохол'), ('Напитки/Безалкохолни'),
            ('БИО продукти'), ('Замразени продукти'), ('Ядки'),
            ('Продукти за животни'), ('Снакс/Чипс'),
            ('Офис материали'), ('Варива')";

    mysqli_query($dbConn, $sql);


    $tbl_name = 'product'; 

    $sql = "CREATE TABLE IF NOT EXISTS $tbl_name( 
        product_id INT(5) NOT NULL AUTO_INCREMENT,
        name VARCHAR(30) NOT NULL,
        gp_id INT(5) NOT NULL,
        price DECIMAL(5,2) NOT NULL,
        quantity DECIMAL(5,2) NOT NULL,
        PRIMARY KEY (product_id),
        KEY gp_id (gp_id)
    )
    ENGINE=INNODB DEFAULT CHARSET=utf8";

    $result = mysqli_query($dbConn, $sql);
    if(!$result) die("Грешка при създаване на таблицата $tbl_name!");

    $sql = "ALTER TABLE $tbl_name
    ADD CONSTRAINT FOREIGN KEY (gp_id) REFERENCES gp (gp_id)";
    mysqli_query($dbConn, $sql);


    $tbl_name = 'pos';  // position

    $sql = "CREATE TABLE IF NOT EXISTS $tbl_name( 
        pos_id INT(5) NOT NULL AUTO_INCREMENT,
        name VARCHAR(20) NOT NULL,
        PRIMARY KEY (pos_id)
    )
    ENGINE=INNODB DEFAULT CHARSET=utf8";

    $result = mysqli_query($dbConn, $sql);
    if(!$result) die("Грешка при създаване на таблицата $tbl_name!");

    $sql = "INSERT INTO pos (name) VALUES 
            ('Продавач-каса'), ('Работник-склад'), ('Мениджър'),
            ('Охрана'), ('Шофьор/Доставчик'), ('Работник-магазин'), ('None')";

    mysqli_query($dbConn, $sql);

    
    $tbl_name = 'employee';

    $sql = "CREATE TABLE IF NOT EXISTS $tbl_name( 
        employee_id INT(5) NOT NULL AUTO_INCREMENT,
        name VARCHAR(30) NOT NULL,
        pos_id INT(5) NOT NULL,
        tel VARCHAR(15) NOT NULL,
        password VARCHAR(50) NOT NULL,
        PRIMARY KEY (employee_id),
        KEY pos_id (pos_id)
    )
    ENGINE=INNODB DEFAULT CHARSET=utf8";

    $result = mysqli_query($dbConn, $sql);
    if(!$result) die("Грешка при създаване на таблицата $tbl_name!");

    $sql = "ALTER TABLE $tbl_name
    ADD CONSTRAINT FOREIGN KEY (pos_id) REFERENCES pos (pos_id)";
    mysqli_query($dbConn, $sql);

    $sql = "INSERT INTO employee (name, pos_id, tel, password) 
            VALUES ('None', '7', 'None', 'None')";

    mysqli_query($dbConn, $sql);


    $tbl_name = 'client';

    $sql = "CREATE TABLE IF NOT EXISTS $tbl_name( 
        client_id INT(5) NOT NULL AUTO_INCREMENT,
        name VARCHAR(30) NOT NULL,
        tel VARCHAR(15) NOT NULL,
        password VARCHAR(50) NOT NULL,
        PRIMARY KEY (client_id) 
    )
    ENGINE=INNODB DEFAULT CHARSET=utf8";

    $result = mysqli_query($dbConn, $sql);
    if(!$result) die("Грешка при създаване на таблицата $tbl_name!");

    $sql = "INSERT INTO client (name, tel, password) 
            VALUES ('None', 'None', 'None')";

    mysqli_query($dbConn, $sql);


    $tbl_name = 'provider'; // delivers purchases

    $sql = "CREATE TABLE IF NOT EXISTS $tbl_name( 
        provider_id INT(5) NOT NULL AUTO_INCREMENT,
        name VARCHAR(20) NOT NULL,
        eik VARCHAR(12) NOT NULL,
        PRIMARY KEY (provider_id) 
    )
    ENGINE=INNODB DEFAULT CHARSET=utf8";

    $result = mysqli_query($dbConn, $sql);
    if(!$result) die("Грешка при създаване на таблицата $tbl_name!");


    $tbl_name = 'purchase';

    $sql = "CREATE TABLE IF NOT EXISTS $tbl_name( 
        purchase_id INT(5) NOT NULL AUTO_INCREMENT,
        product_id INT(5) NOT NULL,
        quantity DECIMAL(5,2) NOT NULL,
        client_id INT(5) NOT NULL,
        employee_id INT(5) NOT NULL,
        datetime VARCHAR(20) NOT NULL,
        total DECIMAL(6,2) NOT NULL,
        PRIMARY KEY (purchase_id),
        KEY product_id (product_id),
        KEY client_id (client_id),
        KEY employee_id (employee_id)
    )
    ENGINE=INNODB DEFAULT CHARSET=utf8";

    $result = mysqli_query($dbConn, $sql);
    if(!$result) die("Грешка при създаване на таблицата $tbl_name!");
    
    $sql ="ALTER TABLE $tbl_name
    ADD CONSTRAINT FOREIGN KEY (product_id) REFERENCES product (product_id),
    ADD CONSTRAINT FOREIGN KEY (client_id) REFERENCES client (client_id),
    ADD CONSTRAINT FOREIGN KEY (employee_id) REFERENCES employee (employee_id)";
    mysqli_query($dbConn, $sql);


    $tbl_name = 'single_purchase';
    
    $sql = "CREATE TABLE IF NOT EXISTS $tbl_name AS SELECT * FROM purchase";

    $result = mysqli_query($dbConn, $sql);
    if(!$result) die("Грешка при създаване на таблицата $tbl_name!");


    $tbl_name = 'delivery';

    $sql = "CREATE TABLE IF NOT EXISTS $tbl_name( 
        delivery_id INT(5) NOT NULL AUTO_INCREMENT,
        product_id INT(5) NOT NULL,
        gp_id INT(5) NOT NULL,
        quantity DECIMAL(5,2) NOT NULL,
        del_price DECIMAL(4,2) NOT NULL,
        provider_id INT(5) NOT NULL,
        datetime VARCHAR(20) NOT NULL,
        PRIMARY KEY (delivery_id),
        KEY product_id (product_id),
        KEY gp_id (gp_id),
        KEY provider_id (provider_id)
    )
    ENGINE=INNODB DEFAULT CHARSET=utf8";

    $result = mysqli_query($dbConn, $sql);
    if(!$result) die("Грешка при създаване на таблицата $tbl_name!");

    $sql = "ALTER TABLE $tbl_name
    ADD CONSTRAINT FOREIGN KEY (product_id) REFERENCES product (product_id),
    ADD CONSTRAINT FOREIGN KEY (gp_id) REFERENCES gp (gp_id),
    ADD CONSTRAINT FOREIGN KEY (provider_id) REFERENCES provider (provider_id)";

    mysqli_query($dbConn, $sql);
    if(!$result) die("Грешка при създаване на таблицата $tbl_name!");
?>