<div id="content">
    <h1>Gallery Amazing  private  tour</h1>
    <p style="text-align: left; width:100%;">
        <?php
        $sql1 = "SELECT * FROM " . $gallery->getTbl() . " WHERE status = 'ใช้งาน' ORDER BY sort ASC";
        $query1 = $db->Query($sql1);
        $numRow1 = $db->NumRows($query1);
        if ($numRow1 > 0) {
            while ($row1 = $db->FetchArray($query1)) {
                ?>
                <a href="<?= ADDRESS ?>img/<?= $row1['image'] ?>" data-title="<?= $row1['name'] ?>" data-lightbox="roadtrip"> <img src="<?= ADDRESS ?>img/<?= $row1['image'] ?>" class="bordered"/></a>
            <?php } ?>
        <?php } ?>
    </p>
    <div class="clear"></div>
</div>
   <?php include_once  'inc_footer.php';?>
  <script type="text/javascript" src="<?= ADDRESS ?>src/js/lightbox.js"></script>
