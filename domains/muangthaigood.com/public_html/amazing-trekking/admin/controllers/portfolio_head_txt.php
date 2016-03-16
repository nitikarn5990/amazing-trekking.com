<?php
// If they are saving the Information	


if ($_POST['submit_bt'] == 'บันทึกข้อมูล' || $_POST['submit_bt'] == 'บันทึกข้อมูล และแก้ไขต่อ') {


    if ($_POST['submit_bt'] == 'บันทึกข้อมูล') {


        $redirect = true;
    } else {


        $redirect = false;
    }

    $arrData = array();


    $arrData = $functions->replaceQuote($_POST);


    $portfolio_head_txt->SetValues($arrData);


//
//    if ($portfolio_head_txt->GetPrimary() == '') {
//
//
//        $portfolio_head_txt->SetValue('created_at', DATE_TIME);
//
//
//        $portfolio_head_txt->SetValue('updated_at', DATE_TIME);
//    } else {
//
//
//        $portfolio_head_txt->SetValue('updated_at', DATE_TIME);
//    }


    if ($portfolio_head_txt->Save()) {
        

       SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ', 'success');


        if ($redirect) {


            header('location:' . ADDRESS_ADMIN_CONTROL . 'portfolio_head_txt');


            die();
        } else {


            header('location:' . ADDRESS_ADMIN_CONTROL . 'portfolio_head_txt&action=edit&id=' . $portfolio_head_txt->GetPrimary());


            die();
        }
    } else {


        SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}

// If Deleting the Page


if ($_GET['id'] != '' && $_GET['action'] == 'del') {


    // Get all the form data


    $arrDel = array('id' => $_GET['id']);


    $portfolio_head_txt->SetValues($arrDel);

    // Remove the info from the DB


    if ($portfolio_head_txt->Delete()) {

        if (unlink(DIR_ROOT_SLIDES . $portfolio_head_txt->GetValue('image'))) {
            // Set alert and redirect
            SetAlert('Delete Data Success', 'success');
            header('location:' . ADDRESS_ADMIN_CONTROL . 'portfolio_head_txt');
        }

        // Set alert and redirect
        SetAlert('Delete Data Success', 'success');
        header('location:' . ADDRESS_ADMIN_CONTROL . 'portfolio_head_txt');

        die();
    } else {


        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}





if ($_GET['id'] != '' && $_GET['action'] == 'edit') {


    // For Update


    $portfolio_head_txt->SetPrimary((int) $_GET['id']);


    // Try to get the information


    if (!$portfolio_head_txt->GetInfo()) {


        SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');


        $portfolio_head_txt->ResetValues();
    }
}



if ($_GET['action'] == "add" || $_GET['action'] == "edit") {
    ?>
    <div class="row-fluid">
        <div class="span12">
    <?php
    Alert(GetAlert('error'));


    Alert(GetAlert('success'), 'success');
  
    ?>

            <div class="da-panel collapsible">
                <div class="da-panel-header"> <span class="da-panel-title"> <i class="icol-<?php echo ($portfolio_head_txt->GetPrimary() != '') ? 'application-edit' : 'add' ?>"></i> <?php echo ($portfolio_head_txt->GetPrimary() != '') ? 'แก้ไข' : 'เพิ่ม' ?> หัวเรื่อง ผลงานของเรา </span> </div>
                <div class="da-panel-content da-form-container">
                    <form id="validate" enctype="multipart/form-data" action="<?php echo ADDRESS_ADMIN_CONTROL ?>portfolio_head_txt<?php echo ($portfolio_head_txt->GetPrimary() != '') ? '&id=' . $portfolio_head_txt->GetPrimary() : ''; ?>" method="post" class="da-form">
    <?php if ($portfolio_head_txt->GetPrimary() != ''): ?>
                            <input type="hidden" name="id" value="<?php echo $portfolio_head_txt->GetPrimary() ?>" />
                           
    <?php endif; ?>
                        <div class="da-form-inline">
                            <div class="da-form-row">
                                <label class="da-form-label">หัวเรื่อง <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <input type="text" name="title" id="name" value="<?php echo ($portfolio_head_txt->GetPrimary() != '') ? $portfolio_head_txt->GetValue('title') : ''; ?>" class="span12 required" />
                                </div>
                            </div>

                          


                        </div>
                        <div class="btn-row">
                            <input type="submit" name="submit_bt" value="บันทึกข้อมูล" class="btn btn-success hidden" />
                            <input type="submit" name="submit_bt" value="บันทึกข้อมูล และแก้ไขต่อ" class="btn btn-primary" />
                            <a href="<?php echo ADDRESS_ADMIN_CONTROL ?>portfolio_head_txt" class="btn btn-danger">ยกเลิก</a> </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="row-fluid">
        <div class="span12">
    <?php
    // Report errors to the user


    Alert(GetAlert('error'));


    Alert(GetAlert('success'), 'success');
    ?>
            <div class="da-panel collapsible">
                <div class="da-panel-header"> <span class="da-panel-title"> <i class="icol-grid"></i> รูปภาพ ทั้งหมด </span> </div>
                <div class="da-panel-toolbar">
                    <div class="btn-toolbar">
                        <div class="btn-group"> <a class="btn" href="<?php echo ADDRESS_ADMIN_CONTROL ?>portfolio_head_txt&action=add"><i class="icol-add"></i> เพิ่มข้อมูล</a> </div>
                    </div>
                </div>
                <div class="da-panel-content da-table-container">
                    <table id="da-ex-datatable-sort" class="da-table" sort="0" order="asc" width="1000">
                        <thead>
                            <tr>
                                <th>รหัส</th>
                                <th>ชื่อภาพ</th>
                                <th>ภาพย่อย</th>
                                <th>สถานะ</th>
                                <th>แก้ไขล่าสุด</th>
                                <th>ลำดับ</th>
                                <th>ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php
    $sql = "SELECT * FROM " . $portfolio_head_txt->getTbl();


    $query = $db->Query($sql);


    while ($row = $db->FetchArray($query)) {
        ?>
                                <tr>
                                    <td class="center" width="15"><?php echo $row['id']; ?></td>
                                    <td  width=""><?php echo $row['name']; ?></td>
                                    <td class="center"  width=""><img src="<?php echo $portfolio_head_txt->getDataDesc("image", "id = '" . $row['id'] . "'") == "" ? NO_IMAGE : ADDRESS_SLIDES . $portfolio_head_txt->getDataDesc("image", "id = '" . $row['id'] . "'") ?>" style="height:70px; width:150px;"></td>
                                    <td class="center" width=""><i class="icol-<?php echo ($row['status'] == 'ใช้งาน') ? 'accept' : 'cross' ?>" title="<?php echo $row['status'] ?>"></i></td>
                                    <td class="center" width=""><?php echo $functions->ShowDateThTime($row['updated_at']) ?></td>
                                    <td class="center" width=""><?php echo $row['sort']; ?></td>
                                    <td class="center"  width=""><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>portfolio_head_txt&action=edit&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-small">แก้ไข / ดู</a> <a href="javascript:;" onclick="if (confirm('คุณต้องการลบข้อมูลนี้หรือใม่?') == true) {
                                                document.location.href = '<?php echo ADDRESS_ADMIN_CONTROL ?>portfolio_head_txt&action=del&id=<?php echo $row['id'] ?>'
                                                        }" class="btn btn-danger btn-small">ลบ</a></td>
                                </tr>
                                    <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<script type="text/javascript">








    function addfile() {





        $("#filecopy:first").clone().insertAfter("div #filecopy:last");


    }


    function delfile() {


        //$("#filecopy").clone().insertAfter("div #filecopy:last");


        var conveniancecount = $("div #filecopy").length;


        if (conveniancecount > 2) {


            $("div #filecopy:last").remove();


        }


    }


//});





</script>
<style>


    /*Colored Label Attributes*/


    .label {


        background-color: #BFBFBF;


        border-bottom-left-radius: 3px;


        border-bottom-right-radius: 3px;


        border-top-left-radius: 3px;


        border-top-right-radius: 3px;


        color: #FFFFFF;


        font-size: 9.75px;


        font-weight: bold;


        padding-bottom: 2px;


        padding-left: 4px;


        padding-right: 4px;


        padding-top: 2px;


        text-transform: uppercase;


        white-space: nowrap;


    }





    .label:hover {


        opacity: 80;


    }





    .label.success {


        background-color: #46A546;


    }


    .label.success2 {


        background-color: #CCC;


    }


    .label.success3 {


        background-color: #61a4e4;





    }





    .label.warning {


        background-color: #FC9207;


    }





    .label.failure {


        background-color: #D32B26;


    }





    .label.alert {


        background-color: #33BFF7;


    }





    .label.good-job {


        background-color: #9C41C6;


    }








</style>
