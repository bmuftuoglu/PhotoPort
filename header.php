<?php
session_start();
$userid = $_SESSION["userid"];
?>

<header class="header">
    <div class="header-container">

        <div>
            <a href="/">
                <img class="site-logo" src="images/sitelogoicon.png" alt="">
            </a>
        </div>

        <div class="logout-button">
            <a href="?page=logout" class="logout">
                <div>
                    Log Out
                </div>
            </a>
        </div>

    </div>
</header>