<?php
include "connection.php";

$passwordconfirmation_err = null;

if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $password = md5($_POST["password"]);
    $passwordconfirmation = md5($_POST["passwordconfirmation"]);


    if ($_POST["password"] != $_POST["passwordconfirmation"]) {

        $passwordconfirmation_err = "The passwords do not match";

    }

    $uyebilgiSQL = "SELECT * FROM users WHERE email='$email' ";
    $uyebilgiSQL = mysqli_query($connection, $uyebilgiSQL);
    $uyebilgiSQL = mysqli_num_rows($uyebilgiSQL);
    if ($uyebilgiSQL == 0) {

        if (!isset($passwordconfirmation_err)) {
            $query = "INSERT INTO users (name,surname,email,pass) VALUES ('$name','$surname','$email','$password')";
            $runquery = mysqli_query($connection, $query);

            if ($runquery) {
                header("Location: " . "/login.php");
                exit();

            } else {
                echo '<script> alert("Kayıt eklenirken bir problem oluştu"); </script>';
            }
            mysqli_close($connection);
        }


    } else {
        echo '<script> alert("Var olan hesap!"); </script>';
    }



}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/reglog.css">
    <link rel="shortcut icon" href="images/sitelogoicon.png" type="image/x-icon">
    <title>PhotoPort | Register</title>
</head>

<body>
    <div class="container">
        <div class="register-content">
            <form method="POST" action="register.php" class="register-form">
                <h2 class="form-title">CREATE ACCOUNT</h2>
                <div class="form-group">
                    <input type="text" name="name" class="form-input " placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <input type="text" name="surname" class="form-input" placeholder="Your Surname" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-input" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-input" placeholder="Password" minlength="8" required>
                </div>
                <div class="form-group">
                    <input type="password" name="passwordconfirmation" class="form-input"
                        placeholder="Repeat Your Password" required>
                    <div class="error-message">
                        <?php
                        echo $passwordconfirmation_err;
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="form-submit" value="sign up">
                </div>
            </form>
            <p class="loginhere">
                Have already an account? <a href="/login.php" class="loginhere-link">Login here</a>
            </p>
        </div>
    </div>
</body>

</html>