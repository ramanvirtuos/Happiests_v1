<?php
    $mysql = new mysqli('localhost','root','root','magicsuggest', 8889);
    $q = isset($_POST['query']) ? $mysql->real_escape_string($_POST['query']) : '';

    $result = $mysql->query("select * from countries where countryName like '%" . $q ."%'");
    $rows = array();
    while($row = $result->fetch_array(MYSQL_ASSOC)) {
        $rows[] = array_map("utf8_encode", $row);
    }
    echo json_encode($rows);
    $result->close();
    $mysql->close();

?>
