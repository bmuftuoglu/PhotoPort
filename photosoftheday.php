<?php

$query = "SELECT ph.id as phId, title, photo, date, userId, name, surname FROM photos ph INNER JOIN users us ON ph.userid = us.id ORDER BY totalrate DESC LIMIT 3";
$result = mysqli_query($connection, $query);

while ($row = $result->fetch_assoc()) {
    $id = $row["phId"];
    $username = $row["name"] . " " . $row["surname"];
    $photopath = $row["photo"];
    $phototitle = $row["title"];
    $photodate = date("d.m.Y H:i:s", strtotime($row["date"]));
    $insertquery = "INSERT INTO likesrate (photoid, userid, rate) VALUES (?,?,?)";
    ?>
    <div class='card-container'>
        <div class='user-information-bar flex'>
            <img src='images/user.png' style='padding-right: 10px;'>
            <?php echo $username; ?>
        </div>
        <div class='photo-area'>
            <img class='photo' src='<?php echo $photopath; ?> '>
        </div>
        <div style="margin: 10px 0px 10px 10px; padding:5px;">
            <div style="float: left;width:100%; text-align:right;">
                Paylaşım Zamanı : <b>
                    <?php echo $photodate; ?>
                </b>
            </div>
            <div style="float: left;width:100%;">
                <?php echo $phototitle; ?>
            </div>
            <?php

            $tarih = date("Y-m-d :H:i:s");
            $tarih1gungeri = date("Y-m-d :H:i:s", strtotime("-1 days"));

            $rateSQL = "SELECT * FROM likesrate WHERE photoid='$id' AND date > '$tarih1gungeri' AND date < '$tarih' ";
            $rateSQL = mysqli_query($connection, $rateSQL);


            $toplamyildiz = 0;
            while ($row = $rateSQL->fetch_assoc()) {
                $toplamyildiz += $row['rate'];
            }

            ?>
            <div style="margin-bottom:10px;"><span>Toplam Yıldız :
                    <?php echo $toplamyildiz; ?>
                </span></div>


        </div>
    </div>


<?php } ?>