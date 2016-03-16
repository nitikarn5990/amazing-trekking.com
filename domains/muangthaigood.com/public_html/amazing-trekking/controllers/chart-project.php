

<div id="slide">
    <article class="demo_block">
        <img class="img-responsive margin-auto-xs" id="slide_top" src="<?= ADDRESS ?>img/<?= $head_image->getDataDesc('image', 'type = "chart-project"') ?>" />
</div>
<div id="bottomslide">
    <div class="sizebottomslide">
        <p class="hidden-lg hidden-md">&nbsp;</p>
        <div class="boxleft">
            <img class="img-responsive margin-auto-xs" src="<?= ADDRESS ?>img/<?= $sub_images->getDataDesc('image', 'name = "chart-project" AND position = "L"') ?>" />
        </div>
        <p class="hidden-lg hidden-md">&nbsp;</p>
        <div class="boxrigthfty">
            <img class="img-responsive margin-auto-xs" src="<?= ADDRESS ?>img/<?= $sub_images->getDataDesc('image', 'name = "chart-project" AND position = "R"') ?>" />
        </div>
        <p class="hidden-lg hidden-md">&nbsp;</p>
        <div class="clear"></div>
    </div>
</div>
<div id="content">


    <h1><strong><?= $chart_project->getDataDescLastID('project_title', 'id = 1') ?></strong></h1>
    <div class="model_detail2">
        <p>

            <?php
            //   $product_Detail = $products->getDataDesc("product_detail", "product_name_ref = '" . $_GET['productID'] . "'");
            $model_detail = str_replace("../files", "../../files", $chart_project->getDataDescLastID('project_detail', 'id = 1'));

            $html = preg_replace('/(width|height)="\d*"\s/', "", $model_detail);

            echo $html;
            ?>
        </p>
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
