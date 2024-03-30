<?php 
    function dayToBulg($day) {
        if ($day == "Monday") return "Понеделник";
        elseif ($day == "Tuesday") return "Вторник";
        elseif ($day == "Wednesday") return "Сряда";
        elseif ($day == "Thursday") return "Четвъртък";
        elseif ($day == "Friday") return "Петък";
        elseif ($day == "Saturday") return "Събота";
        else return "Неделя";
    }

    function loadContent($f_path) {
        $file = fopen($f_path, 'r');
        $line = fgets($file);
        fclose($file);
        return explode(' ', $line);
    }

    function saveDateAndMoney($f_path, $money, $currDay) {
        $file = fopen($f_path, 'w');
        fwrite($file, $currDay.' '.$money);
        fclose($file);
    }

    function getValue($id, $table, $dbConn) {
        $tbl_id = $table . '_id';
        $sql = "SELECT name FROM $table WHERE $tbl_id=$id";
        $result = mysqli_query($dbConn, $sql);

        if (mysqli_num_rows($result) != 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['name'];
        }
    }

    function getId($name, $table, $dbConn) {
        $tbl_id = $table . '_id';
        $sql = "SELECT $tbl_id FROM $table WHERE name='$name'";
        $result = mysqli_query($dbConn, $sql);

        if (mysqli_num_rows($result) != 0) {
            $row = mysqli_fetch_assoc($result);
            return $row["$tbl_id"];
        }
    }

    function truncate($tbl_name, $dbConn) {
        $sql = "TRUNCATE TABLE $tbl_name";
        mysqli_query($dbConn, $sql);
        mysqli_close($dbConn);
    }

    function backup($tbl_name, $backup_file, $dbConn) {
        $path = "/xampp/htdocs/StoreUpdated/backups/$backup_file";
        if (file_exists($path)) unlink($path);
        $sql = "SELECT * FROM $tbl_name INTO OUTFILE '$path'";
        $result = mysqli_query($dbConn, $sql);
        if(!$result) die('Could not take data backup: ' . mysqli_error($dbConn));
    }

    function setUser($user, $type) {
        $file = fopen('/xampp/htdocs/StoreUpdated/index/usertype.txt', 'w');
        fwrite($file, $user.' '.$type);
        fclose($file);
    }

    function getUser() {
        $file = fopen('/xampp/htdocs/StoreUpdated/index/usertype.txt', 'r');
        $line = fgets($file);
        fclose($file);
        return explode(' ', $line);
    }
?>