<?php
session_start();
include "connection.php";


if (isset($_POST["submit"])) {


    $email = $_POST["email"];
    $password = md5($_POST["password"]);

    $query = "SELECT * FROM users WHERE email = '$email' AND pass = '$password' ";

    if ($result = mysqli_query($connection, $query)) {
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            $_SESSION["userid"] = $result->fetch_row()[0];
            header("Location: " . "/");
            exit();
        } else {
            $_SESSION["userid"] = -1;
            echo "<script>alert('Kullanıcı adı veya Şifre yanlış');</script>";
        }
        mysqli_free_result($result);

    }

    mysqli_close($connection);

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/reglog.css">
    <link rel="shortcut icon" href="images/sitelogoicon.png" type="image/x-icon">
    <title>PhotoPort | Login</title>
</head>

<body>
    <div class="container">
        <div class="login-content">
            <form method="POST" class="login-form">
                <h2 class="form-title">log In</h2>
                <div class="form-group">
                    <input type="email" name="email" class="form-input" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-input" placeholder="Password" required>
                    <div class="error-message">
                        <?php
                        echo $password_err;
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="form-submit" value="LOG IN">
                </div>
            </form>
        </div>
    </div>
</body>

</html>