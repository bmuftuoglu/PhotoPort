<?php
session_start();


if (!$_SESSION['userid']) {
    echo "Adam Giriş yapmamış";
    return;
}

if (!$_POST) {
    echo "Post veri gönderilmedi";
    return;
}


$yildiz = addslashes(strip_tags($_POST['yildiz']));
$postID = addslashes(strip_tags($_POST['postID']));


if ($yildiz == "" || $postID == "") {
    echo "Eksik parametreler var ";
    return;
}

$host = "localhost";
$dbusername = "root";
$dbpassword = "12345678";
$db = "photoport";

$connection = mysqli_connect($host, $dbusername, $dbpassword, $db);
mysqli_set_charset($connection, "UTF8");

$userid = $_SESSION['userid'];

$fotobilgiSQL = "SELECT * FROM photos WHERE id='$postID'";
$fotobilgiSQL = mysqli_query($connection, $fotobilgiSQL);

if (mysqli_num_rows($fotobilgiSQL) != 1) {
    echo "Foto id yanlış";
    return;
}



$query = "SELECT * FROM likesrate WHERE photoid='$postID' AND userid='$userid'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) == 0) {

    $query = "INSERT INTO likesrate SET photoid='$postID' , userid='$userid' , rate='$yildiz'";

    if (mysqli_query($connection, $query)) {

        $query = "UPDATE photos SET totalrate = totalrate + $yildiz WHERE id='$postID'";

        if (mysqli_query($connection, $query)) {

            echo "Başarılı";

        } else {
            echo "Sistemsel bir hata (totalrate)!";

        }

    } else {
        echo "Sistemsel bir hata oluştu";
    }

} else {

    $result = mysqli_fetch_array($result);
    if ($result['photoid'] == "") {

        echo "Veriler gelinemedi";
        return;
    }


    $query = "UPDATE likesrate SET  userid='$userid' , rate='$yildiz' WHERE photoid='" . $result['photoid'] . "' AND userid='$userid'";

    if (mysqli_query($connection, $query)) {

        $yildiz = $yildiz - $result['rate'];

        $totalrate = "";
        if ($yildiz < 0) {
            $yildiz = abs($yildiz);
            $islemSQL = "totalrate = totalrate - $yildiz";

        } else {
            $islemSQL = "totalrate = totalrate + $yildiz";
        }



        $query = "UPDATE photos SET $islemSQL WHERE id='$postID'";

        if (mysqli_query($connection, $query)) {

            echo "Başarılı";

        } else {
            echo "Sistemsel bir hata (totalrate)!";
        }


    } else {
        echo "Sistemsel bir hata oluştu";
    }

}

?>