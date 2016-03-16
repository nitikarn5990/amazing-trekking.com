<div id="content">
    <h1><?=$home->getDataDesc('home_title','id = 1');?></h1>
    <?=$home->getDataDesc('home_shortdetail','id = 1');?>

    <?php
    $sql1 = "SELECT * FROM " . $guestbook->getTbl() . " WHERE comment_show_home = 'on' ORDER BY id ASC";
    $query1 = $db->Query($sql1);
    $numRow1 = $db->NumRows($query1);
    if ($numRow1 > 0) {

        while ($row1 = $db->FetchArray($query1)) {
            ?>
            <div class="review">
                <div class="imgreview"><img src="<?=ADDRESS?>img/<?=$row1['image'] != '' ? $row1['image']:'no-image.jpg'?>" style="width: 140px;height: 113px;" /></div>
                <div class="txtreview">
                    <p class="colorreview"><?=$row1['title']?> /  <a href="<?=ADDRESS?>guestbook" style="vertical-align:top; margin:0 0 0 10px;">Guestbook</a></p>
                    <p class="txtnamereview"><?=$row1['name']?></p>
                    <p>
                        <?=$row1['comment']?>
                    </p>
                </div> 
                <div class="clear"></div>
            </div>
        <?php } ?>
<?php } ?>



</div>