
<div id="content">
    <h1>Programs Amazing  private  tour</h1>
    <?php if ($_GET['catID'] == '') { ?>
        <?php
        $sql1 = "SELECT * FROM " . $programs->getTbl() . " WHERE status = 'ใช้งาน' ORDER BY sort ASC";
        $query1 = $db->Query($sql1);
        $numRow1 = $db->NumRows($query1);
        if ($numRow1 > 0) {
            while ($row1 = $db->FetchArray($query1)) {
                ?>

                <a href="<?= ADDRESS ?>programs/<?= $row1['id'] ?>"><h2><?= $row1['name'] ?></h2></a>

            <?php } ?>
        <?php } ?>

<?php } else { ?>


        <h2><?= $programs->getDataDesc('name', 'id = ' . $_GET['catID']) ?></h2>
        <?php
        //   $product_Detail = $products->getDataDesc("product_detail", "product_name_ref = '" . $_GET['productID'] . "'");
        $detail = $programs->getDataDesc('detail', 'id = ' . $_GET['catID']);

        //  $html = preg_replace('/(width|height)="\d*"\s/', "", $detail);

        echo $detail;
        ?>

<?php } ?>
        <?php include_once  'inc_footer.php';?>
</div>
 


