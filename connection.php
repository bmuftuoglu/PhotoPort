<?php
$host = "localhost";
$dbusername = "root";
$dbpassword = "12345678";
$db = "photoport";

$connection = mysqli_connect($host, $dbusername, $dbpassword, $db);
mysqli_set_charset($connection, "UTF8");
?>