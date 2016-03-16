
<?php
if ($_POST['submit_bt'] == 'บันทึกข้อมูล' || $_POST['submit_bt'] == 'บันทึกข้อมูล และแก้ไขต่อ') {

    if ($_POST['submit_bt'] == 'บันทึกข้อมูล') {
        $redirect = true;
    } else {

        $redirect = false;
    }

    //update
    if (isset($_POST['id'])) {

        $arrOrder = array(
            'id' => $_POST['id'],
            'name' => $_POST['name'],
            'title' => $_POST['title'],
            'comment' => $_POST['comment'],
            'email' => $_POST['email'],
            'comment_show_home' => $_POST['comment_show_home'],
            'created_at' => $_POST['datepicker'] . ' ' . $_POST['timepicker'],
            'updated_at' => DATE_TIME
        );
        $arrOrderID = array('id' => $_POST['id']);
        $guestbook->SetValues($arrOrder);
        $guestbook->updateSQL($arrOrder, $arrOrderID);

        if (isset($_FILES['file_array'])) {

            for ($i = 0; $i < count($_FILES['file_array']['tmp_name']); $i++) {

                if ($_FILES["file_array"]["name"][$i] != "") {

                    $targetPath = DIR_ROOT_IMG;
                    $newImage = DATE_TIME_FILE . "_" . $_FILES['file_array']['name'][$i];


                    $cdir = getcwd(); // Save the current directory
                    chdir($targetPath);
                    copy($_FILES['file_array']['tmp_name'][$i], $targetPath . $newImage);

                    chdir($cdir); // Restore the old working directory  

                    $arrOrder = array(
                        'image' => $newImage,
                    );
                    $arrOrderID = array('id' => $_POST['id']);
                    $guestbook->updateSQL($arrOrder, $arrOrderID);
                }
            }
        }
        //  if ($guestbook->Save()) {
        if ($redirect) {
            header('location:' . ADDRESS_ADMIN_CONTROL . 'guestbook');

            die();
        } else {
            header('location:' . ADDRESS_ADMIN_CONTROL . 'guestbook&action=edit&id=' . $_POST['id']);

            die();
        }
        // }
    } else {
        //Insert
        $arrOrder = array(
            'name' => $_POST['name'],
            'title' => $_POST['title'],
            'comment' => $_POST['comment'],
            'email' => $_POST['email'],
            'comment_show_home' => $_POST['comment_show_home'],
            'created_at' => $_POST['datepicker'] . ' ' . $_POST['timepicker'],
            'updated_at' => DATE_TIME
        );

        $guestbook->SetValues($arrOrder);
        if (isset($_FILES['file_array'])) {

            for ($i = 0; $i < count($_FILES['file_array']['tmp_name']); $i++) {

                if ($_FILES["file_array"]["name"][$i] != "") {

                    $targetPath = DIR_ROOT_IMG;
                    $newImage = DATE_TIME_FILE . "_" . $_FILES['file_array']['name'][$i];


                    $cdir = getcwd(); // Save the current directory
                    chdir($targetPath);
                    copy($_FILES['file_array']['tmp_name'][$i], $targetPath . $newImage);

                    chdir($cdir); // Restore the old working directory  

                    $guestbook->SetValue('image', $newImage);

                    //  $guestbook->SetValue('product_id', $products->GetPrimary());
                    //$guestbook->Save();

                    if ($guestbook->Save()) {
                        //SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');
                        $guestbook->ResetValues();
                    } else {
                        SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
                    }
                }
            }
        }
        if ($redirect) {
            header('location:' . ADDRESS_ADMIN_CONTROL . 'guestbook');

            die();
        } else {
            header('location:' . ADDRESS_ADMIN_CONTROL . 'guestbook&action=edit&id=' . $_POST['id']);

            die();
        }
    }
}


if ($_GET['id'] != '' && $_GET['action'] == 'edit') {


    $guestbook->SetPrimary((int) $_GET['id']);
    //$guestbook->SetValue('updated_at', DATE_TIME);


    if (!$guestbook->GetInfo()) {


        SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');


        $guestbook->ResetValues();
    }
}


if ($_GET['id'] != '' && $_GET['action'] == 'del') {

    if ($guestbook->DeleteMultiID($_GET['id'])) {

        SetAlert('Delete Data Success', 'success');


        header('location:' . ADDRESS_ADMIN_CONTROL . 'guestbook');

        die();
    } else {
        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}
?>
<?php if ($_GET['action'] == "add" || $_GET['action'] == "edit") {
    ?>



    <script>
        $(function () {
            $("#datepicker").datepicker({
                dateFormat: "yy-mm-dd"
            });
            $('#timepicker').timepicker({
                timeFormat: 'hh:mm:ss',
                showSecond: true,
            });
        });
    </script>
    <div class="row-fluid">
        <div class="span12">
            <?php
            // Report errors to the user

            Alert(GetAlert('error'));


            Alert(GetAlert('success'), 'success');
            ?>
            <div class="da-panel collapsible">
                <div class="da-panel-header"> <span class="da-panel-title"> <i class="icol-<?php echo ($guestbook->GetPrimary() != '') ? 'email-open' : 'add' ?>"></i> <?php echo ($guestbook->GetPrimary() != '') ? '' : '' ?> Comment </span> </div>
                <div class="da-panel-content da-form-container">
                    <form id="validate" enctype="multipart/form-data" action="" method="post" class="da-form">
                        <input type="hidden" name="comment_show_home" id="comment_show_home" value="" />
                        <?php if ($guestbook->GetPrimary() != ''): ?>
                            <input type="hidden" name="id" value="<?php echo $guestbook->GetPrimary() ?>" />
                            <input type="hidden" name="image" value="<?php echo $guestbook->GetValue('image') ?>" />
                            <input type="hidden" name="created_at" value="<?php echo $guestbook->GetValue('created_at') ?>" />
                        <?php endif; ?>
                        <div class="da-form-inline">
                            <?php if ($guestbook->GetPrimary() != ''): ?>
                                <div class="da-form-row">
                                    <label class="da-form-label">ID <span class="required">*</span></label>
                                    <div class="da-form-item large">
                                        <input type="text" name="id" id="name" value="<?php echo ($guestbook->GetPrimary() != '') ? $guestbook->GetValue('id') : ''; ?>" class="span12" disabled="" />
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="da-form-row">
                                <label class="da-form-label">Name <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <input type="text" name="name" id="name" value="<?php echo ($guestbook->GetPrimary() != '') ? $guestbook->GetValue('name') : ''; ?>" class="span12 required" />
                                </div>
                            </div>
                            <div class="da-form-row">
                                <label class="da-form-label">Subject <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <input type="text" name="title" id="txt_subject" value="<?php echo ($guestbook->GetPrimary() != '') ? $guestbook->GetValue('title') : ''; ?>" class="span12 required" />
                                </div>
                            </div>
                            <div class="da-form-row">
                                <label class="da-form-label">Comment <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <textarea name="comment" id="txt_message" class="span12 required"><?php echo ($guestbook->GetPrimary() != '') ? $guestbook->GetValue('comment') : ''; ?></textarea>
                                </div>
                            </div>

                            <div class="da-form-row">
                                <label class="da-form-label">ไฟล์ที่อัพโหลด</label>
                                <div class="da-form-item large">
                                    <?php if ($guestbook->GetPrimary() != '') { ?>
                                        <?php if ($guestbook->GetValue('image') != ""){  ?>
                                        <img src="<?= ADDRESS ?>img/<?= $guestbook->GetValue('image') ?>" style="max-width: 100%;">
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">อัพโหลดไฟล์</label>
                            <div class="da-form-item large" id="filecopy"> 

                                <input type="file" name="file_array[]" id="image"  class="span4"/>

                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">Email <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <input type="email" name="email" id="email" value="<?php echo ($guestbook->GetPrimary() != '') ? $guestbook->GetValue('email') : ''; ?>" class="span12 required" />
                            </div>
                        </div>
                        <?php
                        if ($guestbook->GetPrimary() != '') {
                            $arrDateTime = explode(' ', $guestbook->GetValue('created_at'));
                        }
                        ?>
                        <div class="da-form-row">
                            <label class="da-form-label">Date <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <input type="text" name="datepicker" id="datepicker" value="<?php echo ($guestbook->GetPrimary() != '') ? $arrDateTime[0] : ''; ?>" class="span12" readonly=""/>
                            </div>
                            <p>&nbsp;</p>
                            <label class="da-form-label">Time <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <p>
                                    <input type="text" name="timepicker" id="timepicker" value="<?php echo ($guestbook->GetPrimary() != '') ? $arrDateTime[1] : ''; ?>" class="span12" readonly=""/>
                                </p>
                            </div>
                        </div>

                        <div class="da-form-row">
                            <label class="da-form-label">นำไปแสดงหน้า Home <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <div class="toggle toggle-light "></div>
                            </div>

                        </div>

                        <div class="btn-row">
                            <input type="submit" name="submit_bt" value="บันทึกข้อมูล" class="btn btn-success" />
                            <input type="submit" name="submit_bt" value="บันทึกข้อมูล และแก้ไขต่อ" class="btn btn-primary" />
                            <a href="<?php echo ADDRESS_ADMIN_CONTROL ?>guestbook" class="btn btn-danger">ยกเลิก</a> 
                        </div>   

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
                <div class="da-panel-header"> <span class="da-panel-title"> <i class="icol-grid"></i> All Comment </span> </div>
                <div class="da-panel-toolbar">
                    <div class="btn-toolbar">
                        <div class="btn-group"> 
                            <a class="btn" href="<?php echo ADDRESS_ADMIN_CONTROL ?>guestbook&action=add"><i class="icol-add"></i> เพิ่มข้อมูล</a> 
                            <a class="btn" onClick="multi_delete()"><img src="http://icons.iconarchive.com/icons/awicons/vista-artistic/24/delete-icon.png" height="16" width="16"> Delete</a> 
                        </div>
                    </div>
                </div>
                <div class="da-panel-content da-table-container">
                    <table id="da-ex-datatable-sort" class="da-table" sort="1" order="desc" width="1000">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"></th>
                                <th>รหัส</th>
                                <th>ชื่อ</th>
                                <th>หัวข้อ</th>
                                <th>แสดงหน้า Home</th>
                                <th>ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $sql = "SELECT * FROM " . $guestbook->getTbl() . " ORDER BY id DESC";


                            $query = $db->Query($sql);


                            while ($row = $db->FetchArray($query)) {
                                ?>
                                <tr onmouseover="this.className = 'yellowThing';"
                                    onmouseout="this.className = 'whiteThing';">
                                    <td class="center" width=""><input type="checkbox" value="<?php echo $row['id']; ?>" id="chkboxID"></td>
                                    <td class="center" width="" class="sorting_desc"><?php echo $row['id']; ?></td>

                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['comment']; ?></td>
                                    <td class="center"><i class="fa fa-2x fa-<?= $row['comment_show_home'] == '' || $row['comment_show_home'] == 'off' ? 'eye-slash red' : 'eye green' ?>"></i></td>
                                    <td width="" class="center"><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>guestbook&action=edit&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-small"> แก้ไข / ดู</a> <a href="#" onclick="if (confirm('คุณต้องการลบข้อมูลนี้หรือใม่?') == true) {
                                                document.location.href = '<?php echo ADDRESS_ADMIN_CONTROL ?>guestbook&action=del&id=<?php echo $row['id'] ?>'
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
                document.location.href = '<?php echo ADDRESS_ADMIN_CONTROL ?>guestbook&action=del&id=' + res;
            }
        }

    }

</script>
<style>


    /*Colored Label Attributes*/
    .red{
        color: #F26B6B;

    }
    .green{
        color: #4CAF50;
    }
    .yellowThing {
        background: #FF9 !important;
        cursor:pointer;

    }
    .whiteThing {
        background: #FFF !important;
    }
    .redThing {
        background: #F00 !important;
    }

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
<style>
    .toggle-slide {
        overflow: hidden;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        direction: ltr;
        text-align: center;
    }
    div.disabled > .toggle-slide {
        opacity: 0.7;
        pointer-events: none;
    }
    .toggle-slide .toggle-on,
    .toggle-slide .toggle-off,
    .toggle-slide .toggle-blob {
        float: left;
    }
    .toggle-slide .toggle-blob {
        position: relative;
        z-index: 99;
        cursor: hand;
        cursor: grab;
    }
    .toggle-dark .toggle-slide {
        border-radius: 5px;
        box-shadow: 0 0 0 1px #242529, 0 1px 0 1px #666;
    }
    .toggle-dark .toggle-on,
    .toggle-dark .toggle-off,
    .toggle-dark .toggle-blob {
        color: rgba(255, 255, 255, 0.7);
        font-size: 11px;
    }
    .toggle-dark .toggle-on,
    .toggle-dark .toggle-select .toggle-inner .active {
        background: -webkit-linear-gradient(#1A70BE, #31A2E1);
        background: linear-gradient(#1A70BE, #31A2E1);
    }
    .toggle-dark .toggle-off,
    .toggle-dark .toggle-select .toggle-on {
        background: -webkit-linear-gradient(#242529, #34363B);
        background: linear-gradient(#242529, #34363B);
    }
    .toggle-dark .toggle-blob {
        border-radius: 4px;
        background: -webkit-linear-gradient(#CFCFCF, whiteSmoke);
        background: linear-gradient(#CFCFCF, whiteSmoke);
        box-shadow: inset 0 0 0 1px #888, inset 0 0 0 2px white;
    }
    .toggle-dark .toggle-blob:hover {
        background: -webkit-linear-gradient(#c0c0c0, #dadada);
        background: linear-gradient(#c0c0c0, #dadada);
        box-shadow: inset 0 0 0 1px #888,inset 0 0 0 2px #ddd;
    }
    .toggle-iphone .toggle-slide {
        border-radius: 9999px;
        box-shadow: 0 0 0 1px #999;
    }
    .toggle-iphone .toggle-on,
    .toggle-iphone .toggle-off {
        color: white;
        font-size: 18px;
        font-weight: bold;
        text-shadow: 0 0 8px rgba(0, 0, 0, 0.5);
    }
    .toggle-iphone .toggle-on {
        border-radius: 9999px 0 0 9999px;
        background: #037bda;
        box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.4);
    }
    .toggle-iphone .toggle-on:after {
        background: -webkit-linear-gradient(#1189f1, #3797ef);
        background: linear-gradient(#1189f1, #3797ef);
        height: 50%;
        content: '';
        margin-top: -19%;
        display: block;
        border-radius: 9999px;
        margin-left: 10%;
    }
    .toggle-iphone .toggle-off {
        box-shadow: inset -2px 2px 5px rgba(0, 0, 0, 0.4);
        border-radius: 0 9999px 9999px 0;
        color: #828282;
        background: #ECECEC;
        text-shadow: 0 0 1px white;
    }
    .toggle-iphone .toggle-off:after {
        background: -webkit-linear-gradient(#fafafa, #fdfdfd);
        background: linear-gradient(#fafafa, #fdfdfd);
        height: 50%;
        content: '';
        margin-top: -19%;
        display: block;
        margin-right: 10%;
        border-radius: 9999px;
    }
    .toggle-iphone .toggle-blob {
        border-radius: 50px;
        background: -webkit-linear-gradient(#d1d1d1, #fafafa);
        background: linear-gradient(#d1d1d1, #fafafa);
        box-shadow: inset 0 0 0 1px rgba(0, 0, 0, 0.6), inset 0 0 0 2px white, 0 0 3px rgba(0, 0, 0, 0.6);
    }
    .toggle-light .toggle-slide {
        border-radius: 9999px;
        box-shadow: 0 0 0 1px #999;
    }
    .toggle-light .toggle-on,
    .toggle-light .toggle-off {
        font-size: 11px;
        font-weight: 500;
    }
    .toggle-light .toggle-on,
    .toggle-light .toggle-select .toggle-inner .active {
        background: #45a31f;
        box-shadow: inset 2px 2px 6px rgba(0, 0, 0, 0.2);
        text-shadow: 1px 1px rgba(0, 0, 0, 0.2);
        color: rgba(255, 255, 255, 0.8);
    }
    .toggle-light .toggle-off,
    .toggle-light .toggle-select .toggle-on {
        color: rgba(0, 0, 0, 0.6);
        text-shadow: 0 1px rgba(255, 255, 255, 0.2);
        background: -webkit-linear-gradient(#cfcfcf, #f5f5f5);
        background: linear-gradient(#cfcfcf, #f5f5f5);
    }
    .toggle-light .toggle-blob {
        border-radius: 50px;
        background: -webkit-linear-gradient(#f5f5f5, #cfcfcf);
        background: linear-gradient(#f5f5f5, #cfcfcf);
        box-shadow: 1px 1px 2px #888;
    }
    .toggle-light .toggle-blob:hover {
        background: -webkit-linear-gradient(#e4e4e4, #f9f9f9);
        background: linear-gradient(#e4e4e4, #f9f9f9);
    }
    .toggle-modern .toggle-slide {
        border-radius: 4px;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.25), 0 0 1px rgba(0, 0, 0, 0.2);
        background: -webkit-linear-gradient(#c0c5c9, #a1a9af);
        background: linear-gradient(#c0c5c9, #a1a9af);
        box-shadow: inset 0 2px 1px rgba(0, 0, 0, 0.2), inset 0 0 0 1px rgba(0, 0, 0, 0.15), 0 1px 0 rgba(255, 255, 255, 0.15);
    }
    .toggle-modern .toggle-on,
    .toggle-modern .toggle-off {
        -webkit-transition: all 0.1s ease-out;
        transition: all 0.1s ease-out;
        color: white;
        text-shadow: 1px 1px rgba(0, 0, 0, 0.1);
        font-size: 11px;
        box-shadow: inset 0 2px 0 rgba(255, 255, 255, 0.2), inset 0 0 0 1px rgba(0, 0, 0, 0.2), inset 0 -1px 1px rgba(0, 0, 0, 0.1), 0 1px 1px rgba(0, 0, 0, 0.2);
    }
    .toggle-modern .toggle-select .toggle-off,
    .toggle-modern .toggle-select .toggle-on {
        background: none;
    }
    .toggle-modern .toggle-off,
    .toggle-modern .toggle-off.active {
        background: -webkit-linear-gradient(#737e8d, #3f454e);
        background: linear-gradient(#737e8d, #3f454e);
    }
    .toggle-modern .toggle-on,
    .toggle-modern .toggle-on.active {
        background: -webkit-linear-gradient(#4894cd, #2852a6);
        background: linear-gradient(#4894cd, #2852a6);
    }
    .toggle-modern .toggle-blob {
        background: -webkit-linear-gradient(#c0c6c9, #81898f);
        background: linear-gradient(#c0c6c9, #81898f);
        box-shadow: inset 0 2px 0 rgba(255, 255, 255, 0.2), inset 0 0 0 1px rgba(0, 0, 0, 0.2), inset 0 -1px 1px rgba(0, 0, 0, 0.1), 1px 1px 2px rgba(0, 0, 0, 0.2);
        border-radius: 3px;
    }
    .toggle-modern .toggle-blob:hover {
        background-image: -webkit-linear-gradient(#a1a9af, #a1a9af);
        background-image: linear-gradient(#a1a9af, #a1a9af);
    }
    .toggle-soft .toggle-slide {
        border-radius: 5px;
        box-shadow: 0 0 0 1px #999;
    }
    .toggle-soft .toggle-on,
    .toggle-soft .toggle-off {
        color: rgba(0, 0, 0, 0.7);
        font-size: 11px;
        text-shadow: 1px 1px white;
    }
    .toggle-soft .toggle-on,
    .toggle-soft .toggle-select .toggle-inner .active {
        background: -webkit-linear-gradient(#d2ff52, #91e842);
        background: linear-gradient(#d2ff52, #91e842);
    }
    .toggle-soft .toggle-off,
    .toggle-soft .toggle-select .toggle-on {
        background: -webkit-linear-gradient(#cfcfcf, #f5f5f5);
        background: linear-gradient(#cfcfcf, #f5f5f5);
    }
    .toggle-soft .toggle-blob {
        border-radius: 4px;
        background: -webkit-linear-gradient(#cfcfcf, #f5f5f5);
        background: linear-gradient(#cfcfcf, #f5f5f5);
        box-shadow: inset 0 0 0 1px #bbb, inset 0 0 0 2px white;
    }
    .toggle-soft .toggle-blob:hover {
        background: -webkit-linear-gradient(#e4e4e4, #f9f9f9);
        background: linear-gradient(#e4e4e4, #f9f9f9);
        box-shadow: inset 0 0 0 1px #ddd,inset 0 0 0 2px #ddd;
    }

</style>
<script>
    /*
     jQuery Toggles v4.0.0
     Copyright 2012 - 2015 Simon Tabor - MIT License
     https://github.com/simontabor/jquery-toggles / http://simontabor.com/labs/toggles
     */
    (function (g) {
        function p(q) {
            var p = g.Toggles = function (c, a) {
                var g = this;
                if ("boolean" === typeof a && c.data("toggles"))
                    c.data("toggles").toggle(a);
                else {
                    for (var k = "on drag click width height animate easing type checkbox".split(" "), b = {}, l = 0; l < k.length; l++) {
                        var t = c.data("toggle-" + k[l]);
                        "undefined" !== typeof t && (b[k[l]] = t)
                    }
                    a = q.extend({drag: !0, click: !0, text: {on: "ON", off: "OFF"}, on: !1, animate: 250, easing: "swing", checkbox: null, clicker: null, width: 0, height: 0, type: "compact", event: "toggle"}, a || {}, b);
                    c.data("toggles",
                            g);
                    var f = !a.on, n = "select" === a.type, p = q(a.checkbox), k = a.clicker && q(a.clicker), d = a.height || c.height() || 20, m = a.width || c.width() || 50;
                    c.height(d);
                    c.width(m);
                    var b = function (a) {
                        return q('<div class="toggle-' + a + '">')
                    }, r = b("slide"), s = b("inner"), w = b("on"), x = b("off"), h = b("blob"), b = d / 2, l = m - b, t = a.text;
                    w.css({height: d, width: l, textIndent: n ? "" : -d / 3, lineHeight: d + "px"}).html(t.on);
                    x.css({height: d, width: l, marginLeft: n ? "" : -b, textIndent: n ? "" : d / 3, lineHeight: d + "px"}).html(t.off);
                    h.css({height: d, width: d, marginLeft: -b});
                    s.css({width: 2 * m - d, marginLeft: n ? 0 : -m + d});
                    n && (r.addClass("toggle-select"), c.css("width", 2 * l), h.hide());
                    s.append(w, h, x);
                    r.html(s);
                    c.html(r);
                    var v = g.toggle = function (b, e, A) {
                        f !== b && (f = g.active = !f, c.data("toggle-active", f), x.toggleClass("active", !f), w.toggleClass("active", f), p.prop("checked", f), A || c.trigger(a.event, f), n || (b = f ? 0 : -m + d, s.stop().animate({marginLeft: b}, e ? 0 : a.animate, a.easing)))
                    }, b = function (b) {
                        c.hasClass("disabled") || b.target === h[0] && a.drag || v()
                    };
                    if (a.click && (!k || !k.has(c).length))
                        c.on("click",
                                b);
                    if (k)
                        k.on("click", b);
                    if (a.drag && !n) {
                        var e, y = (m - d) / 4, z = function (b) {
                            c.off("mousemove");
                            r.off("mouseleave");
                            h.off("mouseup");
                            !e && a.click && "mouseleave" !== b.type ? v() : (f ? e < -y : e > y) ? v() : s.stop().animate({marginLeft: f ? 0 : -m + d}, a.animate / 2, a.easing)
                        }, u = -m + d;
                        h.on("mousedown", function (a) {
                            if (!c.hasClass("disabled")) {
                                e = 0;
                                h.off("mouseup");
                                r.off("mouseleave");
                                var b = a.pageX;
                                c.on("mousemove", h, function (a) {
                                    e = a.pageX - b;
                                    f ? (a = e, 0 < e && (a = 0), e < u && (a = u)) : (a = e + u, 0 > e && (a = u), e > -u && (a = 0));
                                    s.css("margin-left", a)
                                });
                                h.on("mouseup",
                                        z);
                                r.on("mouseleave", z)
                            }
                        })
                    }
                    v(a.on, !0, !0)
                }
            };
            q.fn.toggles = function (c) {
                return this.each(function () {
                    new p(q(this), c)
                })
            }
        }
        "function" === typeof define && define.amd ? define(["jquery"], p) : p(g.jQuery || g.Zepto || g.ender || g.$ || $)
    })(this);

</script>
<?php
$status_comment_show_home = 'off';
if ($guestbook->GetPrimary() != '') {
    if ($guestbook->GetValue('comment_show_home') == '') {
        $status_comment_show_home = 'off';
    } else {
        $status_comment_show_home = $guestbook->GetValue('comment_show_home');
    }
}
?>
<script>

    $('.toggle').toggles({
        drag: true, // allow dragging the toggle between positions
        click: true, // allow clicking on the toggle
        text: {
            on: 'เปิด', // text for the ON position
            off: 'ปิด' // and off
        },
        on: false, // is the toggle ON on init
        animate: 250, // animation time (ms)
        easing: 'swing', // animation transition easing function
        checkbox: null, // the checkbox to toggle (for use in forms)
        clicker: null, // element that can be clicked on to toggle. removes binding from the toggle itself (use nesting)
        width: 50, // width used if not set in css
        height: 20, // height if not set in css
        type: 'compact' // if this is set to 'select' then the select style toggle will be used
    });
// Getting notified of changes, and the new state:
    $('.toggle').on('toggle', function (e, active) {
        if (active) {
            $('#comment_show_home').val('on');
            // console.log('Toggle is now ON!');
        } else {
            $('#comment_show_home').val('off');
            //console.log('Toggle is now OFF!');
        }
    });
    var toggle = $('.toggle');

    $(document).ready(function () {
<?php if ($status_comment_show_home == 'on') { ?>
            toggle.toggles(true);
<?php } else { ?>
            toggle.toggles(false);
<?php } ?>
    });

</script>