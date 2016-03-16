
<div id="content">


    <h1><strong><?= $location->getDataDescLastID('location_title', 'id = 1') ?></strong></h1>
    <div class="model_detail2">
        <p>
            <?php
            //   $product_Detail = $products->getDataDesc("product_detail", "product_name_ref = '" . $_GET['productID'] . "'");
            $model_detail = str_replace("../files", "../../files", $location->getDataDescLastID('location_detail', 'id = 1'));

            $html = preg_replace('/(width|height)="\d*"\s/', "", $model_detail);

            echo $html;
            ?>
        </p>
    </div>
</div>
