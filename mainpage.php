<?php

$query = "SELECT ph.id as phId, title, photo, date, userId, name, surname FROM photos ph INNER JOIN users us ON ph.userid = us.id ORDER BY date DESC";
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

        <div style="margin: 10px 0 50px 10px; padding:5px;">
            <div style="float: left;width:100%; text-align:right;">
                Paylaşım Zamanı : <b>
                    <?php echo $photodate; ?>
                </b>
            </div>
            <div style="float: left;width:100%;">
                <?php echo $phototitle; ?>
            </div>

        </div>
        <div class='buttons'>
            <ul class='ratings'>
                <?php

                $rateSQL = "SELECT * FROM likesrate WHERE photoid='$id' AND userid='$userid'";
                $rateSQL = mysqli_query($connection, $rateSQL);

                $ratebilgi = mysqli_fetch_array($rateSQL);
                ?>


                <li class='star star<?php echo $id; ?> <?php if ($ratebilgi['rate'] == "5") {
                        echo 'selected';
                    } ?>' data-postid="<?php echo $id; ?>" value='5'></li>
                <li class='star star<?php echo $id; ?> <?php if ($ratebilgi['rate'] == "4") {
                        echo 'selected';
                    } ?>' data-postid="<?php echo $id; ?>" value='4'></li>
                <li class='star star<?php echo $id; ?> <?php if ($ratebilgi['rate'] == "3") {
                        echo 'selected';
                    } ?>' data-postid="<?php echo $id; ?>" value='3'></li>
                <li class='star star<?php echo $id; ?> <?php if ($ratebilgi['rate'] == "2") {
                        echo 'selected';
                    } ?>' data-postid="<?php echo $id; ?>" value='2'></li>
                <li class='star star<?php echo $id; ?> <?php if ($ratebilgi['rate'] == "1") {
                        echo 'selected';
                    } ?>' data-postid="<?php echo $id; ?>" value='1'></li>




            </ul>
        </div>
    </div>


<?php } ?>

<script type="text/javascript">

    $(".star").on('click', function () {


        var postid = $(this).data("postid");
        var yildiz = $(this).val();

        $(".star" + postid).removeClass('selected');
        $.ajax({
            type: "post",
            url: "islemler/yildiz-islem.php",
            data: "postID=" + postid + "&yildiz=" + yildiz,
            success: function (cevap) {

                if (cevap != "Başarılı") {
                    alert(cevap);
                }
            }
        });

        $(this).addClass('selected');

    });

</script>