<?php
if (count($_SESSION["strProductID"]) == 0) {

    header("location:" . ADDRESS . "product");
}


$orderID = $_GET['catID'];
?>

<p style="text-align: left;font-size: 14px;font-weight: bold;text-decoration: underline;">ข้อมูลการสั่งซื้อสินค้า</p>
<div class="shipping-detail-middle">
    <table id="success">
        <tbody>
             <tr>
                
                <th style="width:50%; text-align:right;">หมายเลขสั่งซื้อ:</th>
                <td style="width:50%; text-align:left;"><?= $orders->getDataDesc('years','id='.$orderID) . $functions->padLeft($orders->getDataDesc('months','id='.$orderID),2,'0').$functions->padLeft($orders->getDataDesc('id','id='.$orderID),5,'0') ?></td>
            </tr>
            <tr>
                
                <th style="width:50%; text-align:right;">วันที่สั่งซื้อสินค้า:</th>
                <td style="width:50%; text-align:left;"><?= $functions->ShowDateEngTime($orders->getDataDesc('order_date','id='.$orderID))?></td>
            </tr>

            <tr>
                <th width="50%" align="right">ยอดเงินรวม:</th>
                <td width="50%">
                 
                    <?=  $functions->formatcurrency($orders_detail->SumDataDesc('total','orders_id='.$orderID)) ?> ฿ 
                </td>
            </tr>
            <tr>
                <th width="50%" align="right">สถานะการชำระเงิน:</th>
                <td width="50%"> <?= $orders->getDataDesc('status','id='.$orderID) ?></td>
            </tr>
        </tbody>
    </table>
</div>
<div class="clear"></div>
<hr>
<p style="text-align: left;font-size: 14px;font-weight: bold;text-decoration: underline;">รายการสินค้า</p>
<form action="<?php echo ADDRESS ?>cart" method="post">
    <div class="table-responsive" style="padding-left: 224px;">

        <table border="0" cellpadding="0" cellspacing="0" class="item-list" style="width: 295px;">

                <tbody>
                    <tr>
                        <th class="hidden">ภาพสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>ราคา/หน่วย</th>
                        <th>จำนวน</th>
                        <th>ราคารวม</th>
                    </tr>
                    <?php
              
                    for ($i = 0; $i <= (int) $_SESSION["intLine"]; $i++) {


                        if ($_SESSION["strProductID"][$i] != "") {

                            $strSQL = "SELECT * FROM products WHERE id = " . $_SESSION["strProductID"][$i] . "";
                            $objQuery = mysql_query($strSQL) or die(mysql_error());
                            $objResult = mysql_fetch_array($objQuery, MYSQL_ASSOC);
                            $qty = $_SESSION["strQty"][$i];
                            $Total = $qty * $objResult["product_cost"];
                            $SumTotal = $SumTotal + $Total;
                            $_SESSION["Total"] = $SumTotal;
                            ?>

                            <tr>
                                <td class="pro-id hidden"><img src="<?php echo ADDRESS . 'images/' . $objResult["products_file_name_cover"] ?>" style="width:70px;"></td>
                                <td class="pro-desc"><?= $objResult["product_name"]; ?></td>
                                <td class="pro-price"><?= $functions->formatcurrency($objResult["product_cost"]); ?></td>

                                <td class="quantity"><?php echo $qty; ?></td>

                                <td class="sumprice"><?= $functions->formatcurrency(($Total)); ?></td>

                            </tr>
                        <input type="hidden"  name="product_id[]" id="product_id" value="<?php echo $objResult["id"] ?>" >


                        <?php
                    
                    }
                }
                ?>
                </tbody>
            </table>
            <div id="product-summary" style="width: 430px;
                 position: relative;
                 float: left;">
            
                <table style="width: 295px;">
                    <tbody>
                        <tr>
                            <th style="font-size: 16px;text-align: left;color: #CD426C;">สรุปรายการสินค้า (Subtotal)</th>
                            <td></td>
                            <td></td>
                        </tr>  

                        <tr>
                            <th style="text-align: left;">ราคารวมทั้งหมด</th>
                            <td style="text-align: right;"><?php echo number_format($SumTotal, 2) ?></td>
                            <td style="text-align: right;">฿&nbsp;</td>
                        </tr>

                    </tbody>
                </table>

            </div>
        

        </div>
    </form>
<div class="clear"></div>
<hr>
<p style="text-align: left;font-size: 14px;font-weight: bold;text-decoration: underline;">ชื่อและที่อยู่จัดส่งสินค้า</p>
<div class="shipping-detail-middle" style="padding-left: 275px;">
    <table id="" style="max-width:700px;">
        <tbody><tr>
                <th style=" text-align:right;">ชื่อ-สกุล:</th>
                <td style=" text-align:left;"><?= $orders->getDataDesc('name','id='.$orderID) ?></td>
            </tr>
            <tr>
                <th width="" align="right">ที่อยู่:</th>
                <td width="" style="max-width: 350px; word-wrap: break-word;"><?= $orders->getDataDesc('address','id='.$orderID) ?>
               &nbsp; <?= $orders->getDataDesc('province','id='.$orderID) ?> &nbsp;
                    <?= $orders->getDataDesc('zipcode','id='.$orderID) ?>
                </td>
            </tr>
              <tr>
                <th width="" align="right">เบอร์โทร:</th>
                <td width=""><?= $orders->getDataDesc('tel','id='.$orderID) ?></td>
            </tr>

        </tbody></table>
</div>
<hr>
<style>
    #success{
        width: 300px;
      
    
        margin-left: 256px;
     
    }
    .item-list td,.item-list th{
        padding: 5px;
        border: 1px solid #CD426C;
    }
    .hidden{
        display: none;
    }
    .clear{
        clear: both;
    }
</style>
<script>
    $(document).ready(function (){
        alert('รายละเอียดการสั่งซื้อได้ส่งไปยัง Email ของท่านแล้ว');
    });
    
</script>
<?php
                session_destroy();
?>