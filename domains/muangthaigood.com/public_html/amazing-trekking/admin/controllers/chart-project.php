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




    $chart_project->SetValues($arrData);



    if ($chart_project->GetPrimary() == '') {


        $chart_project->SetValue('created_at', DATE_TIME);


        $chart_project->SetValue('updated_at', DATE_TIME);
    } else {


        $chart_project->SetValue('updated_at', DATE_TIME);
    }



    //	$chart_project->Save();


    if ($chart_project->Save()) {


        SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ', 'success');


        //Redirect if needed





        if (isset($_FILES['file_array'])) {


            $Allfile = "";


            $Allfile_ref = "";


            for ($i = 0; $i < count($_FILES['file_array']['tmp_name']); $i++) {


                if ($_FILES["file_array"]["name"][$i] != "") {


                    unset($arrData['webs_money_image']);





                    $targetPath = DIR_ROOT_GALLERY . "/";





                    $newImage = DATE_TIME_FILE . "_" . $_FILES['file_array']['name'][$i];





                    $cdir = getcwd(); // Save the current directory





                    chdir($targetPath);





                    copy($_FILES['file_array']['tmp_name'][$i], $targetPath . $newImage);





                    chdir($cdir); // Restore the old working directory   





                    $chart_project_files->SetValue('file_name', $newImage);





                    if ($_POST['alt_tag'][$i] == '') {





                        //$Allfile_ref .= "|_|" . $newImage;
                        //$chart_project_files->SetValue('file_name', substr($Allfile, 3));


                        $chart_project_files->SetValue('alt_tag', $newImage);
                    } else {


                        //$Allfile_ref .= "|_|" .   $functions->seoTitle($_POST['alt_tag'][$i]);


                        $chart_project_files->SetValue('alt_tag', $functions->seoTitle($_POST['alt_tag'][$i]));
                    }


                    $chart_project_files->SetValue('chart_project_id', $chart_project->GetPrimary());


                    //$chart_project_files->Save();


                    if ($chart_project_files->Save()) {

                        //SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');


                        $chart_project_files->ResetValues();
                    } else {


                        SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
                    }
                }
            }
        }


        ////////





        if ($redirect) {


            header('location:' . ADDRESS_ADMIN_CONTROL . 'chart-project');


            die();
        } else {


            header('location:' . ADDRESS_ADMIN_CONTROL . 'chart-project&action=edit&id=' . $chart_project->GetPrimary());


            die();
        }
    } else {


        SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}


if ($_GET['gallery_file_id'] != '' && $_GET['action'] == 'edit') {





    $chart_project_files->SetPrimary((int) $_GET['gallery_file_id']);





    if ($chart_project_files->Delete()) {


        // Set alert and redirect


        if (unlink(DIR_ROOT_GALLERY . $chart_project_files->GetValue('file_name'))) {


            //	fulldelete($chart_project); 


            SetAlert('Delete Data Success', 'success');
        }
    } else {


        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');


        //	echo $_GET['gallery_file_id'];
    }
}





// If Deleting the Page


if ($_GET['id'] != '' && $_GET['action'] == 'del') {


    // Get all the form data


    $arrDel = array('id' => $_GET['id']);


    $chart_project->SetValues($arrDel);





    // Remove the info from the DB


    if ($chart_project->Delete()) {


        // Set alert and redirect


        SetAlert('Delete Data Success', 'success');


        header('chart_project:' . ADDRESS_ADMIN_CONTROL . 'chart-project');


        die();
    } else {


        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}





if ($_GET['id'] != '' && $_GET['action'] == 'edit') {


    // For Update


    $chart_project->SetPrimary((int) $_GET['id']);


    // Try to get the information


    if (!$chart_project->GetInfo()) {


        SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');


        $chart_project->ResetValues();
    }
}

//
if ($_GET['chart_project_files_id'] != '') {


    // Get all the form data


    $arrDel = array('id' => $_GET['chart_project_files_id']);


    $chart_project_files->SetValues($arrDel);





    // Remove the info from the DB


    if ($chart_project_files->Delete()) {


        // Set alert and redirect


        SetAlert('Delete Data Success', 'success');


        header('location:' . ADDRESS_ADMIN_CONTROL . 'chart-project');

        die();
    } else {
        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}
?>
<?php if ($_GET['mode'] == "" && $_GET['action'] == "edit") { ?>
    <div class="row-fluid">
        <div class="span12">
    <?php
    // Report errors to the user


    Alert(GetAlert('error'));


    Alert(GetAlert('success'), 'success');
    ?>
            <div class="da-panel collapsible">
                <div class="da-panel-header"> <span class="da-panel-title"> <i class="icol-<?php echo ($chart_project->GetPrimary() != '') ? 'application-edit' : 'add' ?>"></i> <?php echo ($chart_project->GetPrimary() != '') ? 'แก้ไข' : 'แก้ไข' ?> รายละเอียดที่ตั้งโครงการ </span> </div>
                <div class="da-panel-content da-form-container">
                    <form id="validate" enctype="multipart/form-data" action="<?php echo ADDRESS_ADMIN_CONTROL ?>chart-project<?php echo ($chart_project->GetPrimary() != '') ? '&action=edit&id=' . $chart_project->GetPrimary() : ''; ?>" method="post" class="da-form">
    <?php if ($chart_project->GetPrimary() != ''): ?>
                            <input type="hidden" name="id" value="<?php echo $chart_project->GetPrimary() ?>" />
                            <input type="hidden" name="created_at" value="<?php echo $chart_project->GetValue('created_at') ?>" />
    <?php endif; ?>
                        <div class="da-form-inline">
                          
                            <div class="da-form-row">
                                <label class="da-form-label">หัวเรื่อง <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <input type="text" name="project_title" id="project_title" value="<?php echo ($chart_project->GetPrimary() != '') ? $chart_project->GetValue('project_title') : ''; ?>" class="span12 required">
                                </div>
                            </div>
                            <div class="da-form-row">
                                <label class="da-form-label">รายละเอียด<span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <textarea name="project_detail" id="project_detail" class="span12 tinymce required"><?php echo ($chart_project->GetPrimary() != '') ? $chart_project->GetValue('project_detail') : ''; ?></textarea>
                                    <label for="project_detail" generated="true" class="error" style="display:none;"></label>
                                </div>
                            </div>


                        </div>
                        <div class="btn-row">

                            <input type="submit" name="submit_bt" value="บันทึกข้อมูล และแก้ไขต่อ" class="btn btn-primary" />

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>



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
