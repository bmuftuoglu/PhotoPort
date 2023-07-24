<body>
    <?php
    include("header.php");
    ?>
    <div class="body-container">

        <main id="main-container">
            <?php
            include 'navigation.php';
            ?>

            <?php
            $page = $_GET['page'];
            if ($page == "logout") {
                $_SESSION = array();
                session_destroy();
                header("Location:" . "/");
                exit();
            } elseif ($page == "top") {
                include "photosoftheday.php";
            } else {
                include "mainpage.php";
            }
            ?>

        </main>
    </div>
</body>