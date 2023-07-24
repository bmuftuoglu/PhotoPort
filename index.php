<?php
session_start();
date_default_timezone_set('Europe/Istanbul');

$userid = $_SESSION["userid"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="icon" href="images/sitelogoicon.png" type="image/x-icon">
    <title>PhotoPort</title>
    <script src="https://aramizdakioyuncu.com/js/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script> -->
</head>

<body>
    <?php
    if ($userid) {
        include 'sorgu.php';
    } else {
        include 'welcomepage.php';
    }
    ?>
</body>

</html>