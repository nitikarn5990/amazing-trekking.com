<?php
// If they are saving the Information	





if ($_POST['submit_bt'] == 'บันทึกข้อมูล' || $_POST['submit_bt'] == 'บันทึกข้อมูล และแก้ไขต่อ') {
    if ($_POST ['submit_bt'] == 'บันทึกข้อมูล') {

        $redirect = true;
    } else {

        $redirect = false;
    }


    $payment_confirm->SetPrimary((int) $_GET['id']);

    if ($payment_confirm->GetPrimary() != '') {

        $arrOrder = array(
            'status' => $_POST['status'],
            'status2' => $_POST['status2'],
            'updated_at' => DATE_TIME
        );

        $arrOrderID = array('id' => $payment_confirm->GetPrimary());
        if ($payment_confirm->updateSQL($arrOrder, $arrOrderID)) {

            SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ', 'success');
            if ($redirect) {

                header('location:' . ADDRESS_ADMIN_CONTROL . 'payment_confirm');

                die();
            } else {

                header('location:' . ADDRESS_ADMIN_CONTROL . 'payment_confirm&action=edit&id=' . $payment_confirm->GetPrimary());

                die();
            }



            die();
        }
    } else {


        SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}


if ($_GET['id'] != '' && $_GET['action'] == 'del') {


    if ($payment_confirm->DeleteMultiID($_GET['id'])) {

        SetAlert('Delete Data Success', 'success');

        header('location:' . ADDRESS_ADMIN_CONTROL . 'payment_confirm');
        die();
    } else {


        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}


if ($_GET['id'] != '' && $_GET['action'] == 'edit') {


    // For Update
    $arrOrder = array(
        'open_read' => 'ดูแล้ว'
    );

    $arrOrderID = array('id' => $_GET['id']);
    if ($payment_confirm->updateSQL($arrOrder, $arrOrderID)) {
        
    }

    $payment_confirm->SetPrimary((int) $_GET['id']);


    // Try to get the information


    if (!$payment_confirm->GetInfo()) {


        SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');


        $payment_confirm->ResetValues();
    }
}

//
if ($_GET['payment_confirm_files_id'] != '') {


    // Get all the form data


    $arrDel = array('id' => $_GET['payment_confirm_files_id']);


    $payment_confirm->SetValues($arrDel);


    // Remove the info from the DB


    if ($payment_confirm->Delete()) {


        // Set alert and redirect


        SetAlert('Delete Data Success', 'success');


        header('location:' . ADDRESS_ADMIN_CONTROL . 'payment_confirm&action=edit&id=' . $payment_confirm->GetPrimary());

        die();
    } else {
        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}
?>
<?php if ($_GET['action'] == "add" || $_GET['action'] == "edit") { ?>

    <div class="row-fluid">
        <div class="span12">
            <?php
            // Report errors to the user

            Alert(GetAlert('error'));


            Alert(GetAlert('success'), 'success');
            ?>
            <div class="da-panel collapsible">
                <div class="da-panel-header"> <span class="da-panel-title"> <i class="icol-<?php echo ($payment_confirm->GetPrimary() != '') ? 'application-edit' : 'add' ?>"></i> <?php echo ($payment_confirm->GetPrimary() != '') ? '' : '' ?> แจ้งการชำระเงิน </span> </div>
                <div class="da-panel-content da-form-container">
                    <form id="validate" enctype="multipart/form-data" action="<?php echo ADDRESS_ADMIN_CONTROL ?>payment_confirm<?php echo ($payment_confirm->GetPrimary() != '') ? '&id=' . $payment_confirm->GetPrimary() : ''; ?>" method="post" class="da-form">
                        <?php if ($payment_confirm->GetPrimary() != ''): ?>
                            <input type="hidden" name="id" value="<?php echo $payment_confirm->GetPrimary() ?>" />
                            <input type="hidden" name="created_at" value="<?php echo $payment_confirm->GetValue('created_at') ?>" />
                        <?php endif; ?>
                        <div class="da-form-inline">
                            <div class="da-form-row">
                                <label class="da-form-label">หมายเลขสั่งซื้อ<span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <input type="text" name="order_id" id="payment_confirm_name" value="<?php echo ($payment_confirm->GetPrimary() != '') ? $payment_confirm->GetValue('order_id') : ''; ?>" class="span12 required" readonly/>
                                </div>
                            </div>
                            <div class="da-form-row">
                                <label class="da-form-label">ชื่อผู้โอน<span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <input type="text" name="payment_confirm_name" id="payment_confirm_name" value="<?php echo ($payment_confirm->GetPrimary() != '') ? $payment_confirm->GetValue('name') : ''; ?>" class="span12 required" readonly/>
                                </div>
                            </div>
                            <div class="da-form-row">
                                <label class="da-form-label">Email<span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <input type="text" name="Email" id="Email" value="<?php echo ($payment_confirm->GetPrimary() != '') ? $payment_confirm->GetValue('email') : ''; ?>" class="span12 required" readonly/>
                                </div>
                            </div>
                            <div class="da-form-row">
                                <label class="da-form-label">เบอร์โทร<span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <input type="text" name="tel" id="payment_confirm_name" value="<?php echo ($payment_confirm->GetPrimary() != '') ? $payment_confirm->GetValue('tel') : ''; ?>" class="span12 required" readonly/>
                                </div>
                            </div>

                            <div class="da-form-row">
                                <label class="da-form-label">ยอดเงินที่โอน <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <input type="text" name="payment_confirm_name" id="payment_confirm_name" value="<?php echo ($payment_confirm->GetPrimary() != '') ? $payment_confirm->GetValue('transfer_amount') : ''; ?>" class="span12 required" readonly/>
                                </div>
                            </div>
                            <div class="da-form-row">
                                <label class="da-form-label">วันและเวลาโอน <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <input type="text" name="payment_confirm_name" id="payment_confirm_name" value="<?php echo ($payment_confirm->GetPrimary() != '') ? $functions->ShowDateThTime($payment_confirm->GetValue('transfer_date')) : ''; ?>" class="span12 required" readonly/>
                                </div>
                            </div>
                            <div class="da-form-row">
                                <label class="da-form-label">ไฟล์ที่อัพโหลด</label>
                                <div class="da-form-item large">
                                    <ul style=" list-style-type: none;" class="da-form-list">
                                        <img src="<?php echo ADDRESS . 'images/' . $payment_confirm->GetValue('image_receipt') ?>">
                                        </div>
                                        </div>
                                        <div class="da-form-row">
                                            <label class="da-form-label">สถานะ <span class="required">*</span></label>
                                            <div class="da-form-item large">
                                                <ul class="da-form-list">
                                                    <?php
                                                    $getStatus = $payment_confirm->get_enum_values('status2');

                                                    $i = 1;

                                                    foreach ($getStatus as $status) {
                                                        ?>
                                                        <li><input type="radio"
                                                                   name="status2" id="status" value="<?php echo $status ?>"
                                                                   <?php echo ($payment_confirm->GetPrimary() != "") ? ($payment_confirm->GetValue('status2') == $status) ? "checked=\"checked\"" : "" : ($i == 1) ? "checked=\"checked\"" : "" ?>
                                                                   class="required" /> <label><?php echo $status ?></label></li>
                                                            <?php
                                                            $i ++;
                                                        }
                                                        ?>
                                                </ul>
                                            </div>
                                        </div>


                                        <div class="btn-row">
                                            <input type="submit" name="submit_bt" value="บันทึกข้อมูล"
                                                   class="btn btn-success" /> 
                                            <a href="<?php echo ADDRESS_ADMIN_CONTROL ?>payment_confirm" class="btn btn-primary">กลับ</a>
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
                                    <div class="da-panel-header"> <span class="da-panel-title"> <i class="icol-grid"></i> แจ้งการชำระเงิน ทั้งหมด </span> </div>
                                    <div class="da-panel-toolbar">
                                        <div class="btn-toolbar">
                                            <div class="btn-group"> <a class="btn" onClick="multi_delete()"><img src="http://icons.iconarchive.com/icons/awicons/vista-artistic/24/delete-icon.png" height="16" width="16"> Delete</a> </div>
                                        </div>
                                    </div>
                                    <div class="da-panel-content da-table-container">
                                        <table id="da-ex-datatable-sort" class="da-table" sort="3" order="asc" width="1000">
                                            <thead>
                                                <tr style="font-size: 12px;">
                                                    <th><input type="checkbox" id="checkAll"></th>
                                                 
                                                    <th>หมายเลขสั่งซื้อ</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>Email</th>
                                                    <th>เบอร์โทร</th>
                                                    <th>เวลาแจ้งโอน</th>
                                                    <th>สถานะ</th>
                                                    <th>ตัวเลือก</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM " . $payment_confirm->getTbl() . " ORDER BY id DESC";


                                                $query = $db->Query($sql);

                                                $no = 0;
                                                while ($row = $db->FetchArray($query)) {
                                                      $no =   $no + 1;
                                                    $cStatus = 'background-color: rgba(240, 105, 105, 0.42)';
                                                    if ($row['status2'] == 'ส่งของแล้ว') {
                                                        $cStatus = 'background-color: rgba(165, 240, 105, 0.42)';
                                                    }
                                                    $classRead = 'background-color: white; font-weight: normal;';
                                                    if ($row['open_read'] == '' || $row['open_read'] == 'ยังไม่ได้ดู') {
                                                        $classRead = 'background-color: rgba(34, 150, 204, 0.14);font-weight: bolder;font-size:13px';
                                                    }
                                                    ?>
                                                    <tr style="<?= $cStatus ?>">
                                                        <td  class="center" width="5%" style="font-size: 12px;"><input type="checkbox" value="<?php echo $row['id'] ?>" id="chkboxID"></td>
                                           
                                                        <td style="font-size: 12px;"><?php echo $row['order_id']; ?></td>
                                                        <td style="font-size: 12px;"><?php echo $row['name']; ?></td>
                                                        <td class="center" style="font-size: 12px;"><?php echo $row['email'] ?></td>
                                                        <td class="center" style="font-size: 12px;"><?php echo $row['tel'] ?></td>
                                                        <td class="center" style="font-size: 12px;"><?php echo $row['created_at'] ?></td>
                                                        <td class="center" style="font-size: 12px;"><?php echo $row['status2'] ?></td>
                                                        <td class="center" style="font-size: 12px;">
                                                            <a href="<?php echo ADDRESS_ADMIN_CONTROL ?>payment_confirm&action=edit&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-small">แก้ไข / ดู</a> 
                                                            <a href="#"  onclick="if (confirm('คุณต้องการลบข้อมูลนี้หรือใม่?') == true) {
                                                                        document.location.href = '<?php echo ADDRESS_ADMIN_CONTROL ?>payment_confirm&action=del&id=<?php echo $row['id'] ?>'
                                                                                }" class="btn btn-danger btn-small">ลบ</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>

                            $("#checkAll").click(function (e) {
                                $('input:checkbox').prop('checked', this.checked);
                            });

                            function multi_delete() {

                                var msg_id = "";
                                var res = "";

                                $('input:checkbox[id^="chkboxID"]:checked').each(function () {


                                    msg_id += ',' + $(this).val();
                                    res = msg_id.substring(1);


                                });
                                if (res != '') {
                                    if (confirm('คุณต้องการลบข้อมูลนี้หรือใม่?') == true) {
                                        document.location.href = '<?php echo ADDRESS_ADMIN_CONTROL ?>payment_confirm&action=del&id=' + res;
                                    }
                                }


                            }

                        </script>
                    <?php } ?>
                    <script type="text/javascript">


                        //$( document ).ready(function() {


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


                        $(document).ready(function () {





                            $('input:radio[name="payment_confirms_file_name_cover"][value="<?php echo $payment_confirm->getDataDesc("payment_confirms_file_name_cover", "id = '" . $_GET['id'] . "'"); ?>"]').prop('checked', true);





                        });





                        //});





                    </script> 
                    <script>


                        $(function () {


                            // $( "#datepicker" ).datepicker();


                            $("#activity_date").datepicker({
                                dateFormat: "yy-mm-dd"
                            }).val();


                        });


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
