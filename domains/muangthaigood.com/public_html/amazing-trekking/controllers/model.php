<!-- Latest compiled and minified CSS -->

<div class="clearfix"></div>
<div id="slide"> 

    <img id="slide_top" src="<?= ADDRESS ?>img/<?= $head_image->getDataDesc('image', 'type = "model"') ?>" class="img-responsive margin-auto-xs "/>
</div>
<div class="clearfix"></div>
<div id="bottomslide">
    <div class="sizebottomslide">
        <p class="hidden-lg hidden-md">&nbsp;</p>
        <div class="boxleft"> <img src="<?= ADDRESS ?>img/<?= $sub_images->getDataDesc('image', 'name = "model" AND position = "L"') ?>" class="img-responsive"/> </div>
        <p class="hidden-lg hidden-md">&nbsp;</p>
        <div class="boxrigthfty"> <img src="<?= ADDRESS ?>img/<?= $sub_images->getDataDesc('image', 'name = "model" AND position = "R"') ?>" class="img-responsive"/> </div>
        <p class="hidden-lg hidden-md">&nbsp;</p>
        <div class="clear"></div>
    </div>
</div>
<div class="clearfix"></div>

<div id="content">

    <div class="row">


        <?php
        if ($_GET['catID'] != '') {
            // detail model	


            $arr_modelID = explode('_', $_GET['catID']);
            $arr_modelID = $arr_modelID[0];
            ?>

            <div class="col-md-12">
                <h1>
                    <strong> <?= $modelhome->getDataDesc('name', 'id = ' . $arr_modelID) ?></strong> 
                </h1>
                <p align="center">
                    <img src="<?= ADDRESS ?>img/<?= $modelhome->getDataDesc('image', 'id = ' . $arr_modelID) ?>"  class="img-responsive"/>
                </p>
                <div  class="model_detail2">
                    <p>
                        <?php
                        //   $product_Detail = $products->getDataDesc("product_detail", "product_name_ref = '" . $_GET['productID'] . "'");
                        $model_detail = str_replace("../files", "../../files", $modelhome->getDataDesc('detail', 'id = ' . $arr_modelID));

                        $html = preg_replace('/(width|height)="\d*"\s/', "", $model_detail);

                        echo $html;
                        ?>
                    </p>
                </div>
            </div>
            <div class="clearfix"></div>
            <?php
        } else {

// list all model
            ?>


            <div class="col-md-12">
                <h1>
                    <strong> <?= $model->getDataDescLastID('model_title', 'id = 1') ?></strong>
                </h1>
                <div  class="model_detail2">
                    <p class="">
                        <?php
                        //   $product_Detail = $products->getDataDesc("product_detail", "product_name_ref = '" . $_GET['productID'] . "'");
                        $model_detail = str_replace("../files", "../../files", $model->getDataDescLastID('model_detail', 'id = 1'));

                        $html = preg_replace('/(width|height)="\d*"\s/', "", $model_detail);

                        echo $html;
                        ?>
                    </p>
                </div>
                <div class="clearfix"></div>
            </div>

            <?php
            $sql1 = "SELECT * FROM " . $modelhome->getTbl() . " WHERE status = 'ใช้งาน'";
            $query1 = $db->Query($sql1);
            $numRow1 = $db->NumRows($query1);
            $xx = 0;
            if ($numRow1 > 0) {
                while ($row1 = $db->FetchArray($query1)) {
                    ?>


                    <div class="col-md-4 col-xs-12" style="">
                        <p>
                            <a href="<?= ADDRESS ?>model/<?= $row1['id'] ?>_<?= $row1['name_ref'] ?>">

                                <img src="<?= ADDRESS ?>img/<?= $row1['image'] ?>" alt="<?= $row1['alt'] ?>" class="bordereds img-responsive" style="margin:auto;"/>
                            </a>
                        </p>

                        <div class="text-center" style="font-family: Arial;font-size: 12px;">
                            <p>
                                <a href="<?= ADDRESS ?>model/<?= $row1['id'] ?>_<?= $row1['name_ref'] ?>"> <?= $row1['name'] ?>   </a>      
                            </p>
                        </div>
                        <div style="margin-bottom: 20px;" class="hidden-lg hidden-md"></div>

                    </div>


                    <?php
                }
            }
            ?>




        <?php } ?>

    </div>

</div>


<script type="text/javascript">
    $(document).ready(function () {


        if ($(window).width() < 992) {

        } else {
            $("#slide_top").width("100%").height("292");
        }

    });
</script> 
