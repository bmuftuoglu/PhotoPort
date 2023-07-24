<?php
include 'connection.php';

$userid = $_SESSION["userid"];


$tarih = date("Y-m-d :H:i:s");
$tarih1gungeri = date("Y-m-d :H:i:s", strtotime("-1 days"));


$oyuncuyuklemesayac = "SELECT * FROM photos WHERE userid='$userid' AND date < '$tarih' AND date > '$tarih1gungeri' ";
$oyuncuyuklemesayac = mysqli_query($connection, $oyuncuyuklemesayac);
$oyuncuyuklemesayac = mysqli_num_rows($oyuncuyuklemesayac);



if (isset($_POST["upload"]) && $_FILES['photo']['tmp_name'] != "") {
    $title = $_POST["title"];

    $tempFilePath = $_FILES['photo']['tmp_name'];


    // Fotoğrafın kalıcı konumu ve dosya adı
    $targetDir = 'gallery/';
    $targetFile = $targetDir . basename($_FILES['photo']['name']);

    // Fotoğrafı kalıcı konuma taşıyın
    move_uploaded_file($tempFilePath, $targetFile);






    if ($oyuncuyuklemesayac >= 3) {
        // echo "Limite ulaştınız";

    } else {
        $sql = "INSERT INTO photos (title, photo,userid) VALUES ('$title', '$targetFile','$userid')";

        if ($connection->query($sql) === TRUE) {
            // echo "Fotoğraf başarıyla yüklendi ve veritabanına kaydedildi.";
        } else {
            echo "Fotoğraf yükleme hatası: ";
        }
        // mysqli_close($connection);
    }




}
?>

<div class="upload-container">
    <div class="navigate-menu">
        <ul class="sidebar-list">
            <a href="/" class="list-item-content">
                <li class="list-item">
                    <span class="list-item-icon">
                        <img src="images/home.png" alt="">
                    </span>
                    Home
                </li>
            </a>
            <a href="?page=top" class="list-item-content">
                <li class="list-item">
                    <span class="list-item-icon">
                        <img src="images/top.png" alt="">
                    </span>
                    Photos of the Day
                </li>
            </a>
        </ul>
    </div>

    <?php


    if ($oyuncuyuklemesayac >= 3) { ?>
        <div class="upload-button">
            <img src="images/uploaderr.png">
        </div>
        <?php
    } else { ?>

        <button id="btnHide" class="upload-button">
            <img src="images/upload.png" alt="">
        </button>

    <?php } ?>



</div>

<div class="upload-container secret" id="uploadbox">

    <form method="post" enctype="multipart/form-data" style="display: contents;">

        <div style="display: flex;flex-direction: column;">
            <input type="file" name="photo" style="margin-bottom: 5px;">
            <input class="titlebox" type="text" name="title" placeholder="Enter Title">
        </div>
        <button name="upload" class="send-file">
            <img src="images/accept.png" alt="">
        </button>

    </form>



</div>

<script>
    var btnHide = document.getElementById("btnHide");
    var uploadbox = document.getElementById("uploadbox");
    btnHide.onclick = function () {
        if (uploadbox.classList.contains("secret")) {
            uploadbox.classList.remove("secret");
        }
        else {
            uploadbox.classList.add("secret");
        }

    }
</script>