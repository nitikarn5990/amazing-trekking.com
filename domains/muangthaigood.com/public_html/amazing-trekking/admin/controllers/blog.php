<?php


	// If they are saving the Information	


	


	if ($_POST['submit_bt'] == 'บันทึกข้อมูล' || $_POST['submit_bt'] == 'บันทึกข้อมูล และแก้ไขต่อ'){


		if($_POST['submit_bt'] == 'บันทึกข้อมูล'){


			$redirect = true;


		}else{


			$redirect = false;


		}


		$arrData = array();


		$arrData = $functions->replaceQuote($_POST);
		
		if($arrData['ref'] != ""){

			$arrData['blog_name_ref'] = $functions->seoTitle($arrData['ref']);

		}else{

			$arrData['blog_name_ref'] = $functions->seoTitle($arrData['blog_name']);

		}
		
		$blog->SetValues($arrData);
		if($blog->GetPrimary() == ''){


			$blog->SetValue('created_at', DATE_TIME);


			$blog->SetValue('updated_at', DATE_TIME);


		}else{


			$blog->SetValue('updated_at', DATE_TIME);


		}



	//	$blog->Save();


		if($blog->Save()){			


			SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');


			//Redirect if needed


				/*if(isset($_FILES['file_array'])){


					$Allfile = "";


					$Allfile_ref = "";


					for($i= 0; $i < count($_FILES['file_array']['tmp_name']); $i++){


						if($_FILES["file_array"]["name"][$i] != ""){


							unset($arrData['webs_money_image']);


			


							$targetPath = DIR_ROOT_GALLERY . "/";


				


							$newImage = DATE_TIME_FILE . "_" . $_FILES['file_array']['name'][$i];


				


							$cdir = getcwd(); // Save the current directory


				


							chdir($targetPath);


				


							copy($_FILES['file_array']['tmp_name'][$i], $targetPath . $newImage);


				


							chdir($cdir); // Restore the old working directory   


							


							$product_files->SetValue('file_name', $newImage);


							


							if($_POST['alt_tag'][$i] == ''){


								


								//$Allfile_ref .= "|_|" . $newImage;


								//$product_files->SetValue('file_name', substr($Allfile, 3));


								$product_files->SetValue('alt_tag', $newImage);	


							}else{


								//$Allfile_ref .= "|_|" .   $functions->seoTitle($_POST['alt_tag'][$i]);


								$product_files->SetValue('alt_tag', $functions->seoTitle($_POST['alt_tag'][$i]));	


							}


							$product_files->SetValue('blog_id', $blog->GetPrimary());


							//$product_files->Save();


							if($product_files->Save()){	

								//SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');


								$product_files->ResetValues();


							


							}else{


								SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');


							}


						


						}


					}


					if($_POST['blogs_file_name_cover'] == ''){


						$arrOrder = array(


							'blogs_file_name_cover' => $product_files->getDataDesc("file_name", "product_id = '" .  $blog->GetPrimary() . "' ORDER BY id ASC LIMIT 0,1"),


				


							'updated_at' => DATE_TIME


						);


						$arrOrderID = array('id' => $blog->GetPrimary());


				


					 	$blog->updateSQL($arrOrder, $arrOrderID);


						


					}


				


				}*/


				if ($redirect){


					header('location:' . ADDRESS_ADMIN_CONTROL . 'blog');


					die();


				}else{


					header('location:' . ADDRESS_ADMIN_CONTROL . 'blog&action=edit&id=' . $blog->GetPrimary());


					die();


				}

		}else{


			SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');


		}	


	}


/*	if($_GET['gallery_file_id'] != '' && $_GET['action'] == 'edit'){



			$product_files->SetPrimary((int)$_GET['gallery_file_id']);


			if ($product_files->Delete()){


				// Set alert and redirect


				if(unlink(DIR_ROOT_GALLERY . $product_files->GetValue('file_name'))){


			//	fulldelete($location); 


					SetAlert('Delete Data Success','success');


				}


				


			}else{


				SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');


			//	echo $_GET['gallery_file_id'];


			}


	}*/

	// If Deleting the Page


	if ($_GET['id'] != '' && $_GET['action'] == 'del'){


		if ($blog->DeleteMultiID($_GET['id'])){


			// Set alert and redirect


			SetAlert('Delete Data Success','success');


			header('location:' . ADDRESS_ADMIN_CONTROL . 'blog');


			die();


		}else{


			SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');


		}

	}


	if ($_GET['id'] != '' && $_GET['action'] == 'edit'){


		// For Update


		$blog->SetPrimary((int)$_GET['id']);


		// Try to get the information


		if (!$blog->GetInfo()){


			SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');


			$blog->ResetValues();


		}


	}
	
	//
	/*	if ($_GET['blog_files_id'] != ''){


		// Get all the form data


		$arrDel = array('id' => $_GET['blog_files_id']);


		$product_files->SetValues($arrDel);


		// Remove the info from the DB


		if ($product_files->Delete()){


			// Set alert and redirect


			SetAlert('Delete Data Success','success');


			header('location:' . ADDRESS_ADMIN_CONTROL . 'blog&action=edit&id=' . $blog->GetPrimary());

			die();


		}else{
			SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');

		}
	}*/


?>
<?php if($_GET['action'] == "add" || $_GET['action'] == "edit"){?>
<div class="row-fluid">
    <div class="span12">
        <?php


			// Report errors to the user


			Alert(GetAlert('error'));


			Alert(GetAlert('success'),'success');


		?>
        <div class="da-panel collapsible">
            <div class="da-panel-header"> <span class="da-panel-title"> <i class="icol-<?php echo ($blog->GetPrimary() != '') ? 'application-edit' : 'add'?>"></i> <?php echo ($blog->GetPrimary() != '') ? 'แก้ไข' : 'เพิ่ม'?> บล็อก </span> </div>
            <div class="da-panel-content da-form-container">
                <form id="validate" enctype="multipart/form-data" action="<?php echo ADDRESS_ADMIN_CONTROL?>blog<?php echo ($blog->GetPrimary() != '') ? '&action=edit&id=' . $blog->GetPrimary() : ''; ?>" method="post" class="da-form">
                    <?php if($blog->GetPrimary() != ''):?>
                    <input type="hidden" name="id" value="<?php echo $blog->GetPrimary()?>" />
                    <input type="hidden" name="created_at" value="<?php echo $blog->GetValue('created_at')?>" />
                    <?php endif;?>
                    <div class="da-form-inline">
                    <div class="da-form-row">
                        <label class="da-form-label">ชื่อบล็อก <span class="required">*</span></label>
                        <div class="da-form-item large">
                            <input type="text" name="blog_name" id="blog_name" value="<?php echo ($blog->GetPrimary() != '') ? $blog->GetValue('blog_name') : ''; ?>" class="span12 required" />
                        </div>
                    </div>
                    <div class="da-form-row">
                        <label class="da-form-label">ชื่อใช้อ้างอิง / URL</label>
                        <div class="da-form-item large">
                            <input type="text" name="ref" id="ref" value="<?php echo ($blog->GetPrimary() != '') ? $blog->GetValue('blog_name_ref') : ''; ?>" class="span12" />
                            <label class="help-block">ว่างไว้ถ้าต้องการให้สร้างชื่ออ้างอิงอัตโนมัติ</label>
                        </div>
                    </div>
                    <div class="da-form-row">
                        <label class="da-form-label">กลุ่มบล็อก <span class="required">*</span></label>
                        <div class="da-form-item large">
                            <select id="blog_category_id" name="blog_category_id" class="span12 select2 required">
                                <option value=""></option>
                                <?php $blog_category->CreateDataList("id","category_name","status='ใช้งาน'",($blog->GetPrimary() != "") ? $blog->GetValue('blog_category_id') : "")?>
                            </select>
                        </div>
                    </div>
                      <div class="da-form-row">
                        <label class="da-form-label">รายละเอียดหน้าปก<span class="required">*</span></label>
                        <div class="da-form-item large">
                            <textarea name="blog_cover" id="blog_cover" class="span12 tinymce required"><?php echo ($blog->GetPrimary() != '') ? $blog->GetValue('blog_cover') : ''; ?></textarea>
                            <label for="blog_cover" generated="true" class="error" style="display:none;"></label>
                        </div>
                    </div>
                    <div class="da-form-row">
                        <label class="da-form-label">รายละเอียดโดยย่อ<span class="required">*</span></label>
                        <div class="da-form-item large">
                            <textarea name="blog_short_detail" id="blog_short_detail" class="span12 tinymce required"><?php echo ($blog->GetPrimary() != '') ? $blog->GetValue('blog_short_detail') : ''; ?></textarea>
                            <label for="blog_short_detail" generated="true" class="error" style="display:none;"></label>
                        </div>
                    </div>
                    <div class="da-form-row">
                        <label class="da-form-label">รายละเอียด<span class="required">*</span></label>
                        <div class="da-form-item large">
                            <textarea name="blog_detail" id="blog_detail" class="span12 tinymce required"><?php echo ($blog->GetPrimary() != '') ? $blog->GetValue('blog_detail') : ''; ?></textarea>
                            <label for="blog_detail" generated="true" class="error" style="display:none;"></label>
                        </div>
                    </div>
                    <div class="da-form-inline">
                      
                        <div class="da-form-row">
                            <label class="da-form-label">Meta Title</label>
                            <div class="da-form-item large">
                                <textarea name="meta_title" id="meta_title" class="span12"><?php echo ($blog->GetPrimary() != '') ? $blog->GetValue('meta_title') : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">Meta Keywords</label>
                            <div class="da-form-item large">
                                <textarea name="meta_keywords" id="meta_keywords" class="span12"><?php echo ($blog->GetPrimary() != '') ? $blog->GetValue('meta_keywords') : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">Meta Descriptions</label>
                            <div class="da-form-item large">
                                <textarea name="meta_descriptions" id="meta_descriptions" class="span12"><?php echo ($blog->GetPrimary() != '') ? $blog->GetValue('meta_descriptions') : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">สถานะ <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <ul class="da-form-list">
                                    <?php


										$getStatus = $blog->get_enum_values('status');


										$i = 1;


										foreach ($getStatus as $status) {


									?>
                                    <li>
                                        <input type="radio" name="status" id="status" value="<?php echo $status?>" <?php echo ($blog->GetPrimary() != "") ? ($blog->GetValue('status') == $status) ? "checked=\"checked\"" : "" : ($i == 1) ? "checked=\"checked\"" : ""?> class="required"/>
                                        <label><?php echo $status?></label>
                                    </li>
                                    <?php $i++; }?>
                                </ul>
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label class="da-form-label">Tags (คำค้น)</label>
                            <div class="da-form-item large">
                                <input type="text" value="<?php echo ($blog->GetPrimary() != '') ? $blog->GetValue('tags') : ''; ?>" data-role="tagsinput" name="tags">
                            </div>
                        </div>
                        
                    </div>
                    <div class="btn-row">
                        <input type="submit" name="submit_bt" value="บันทึกข้อมูล" class="btn btn-success" />
                        <input type="submit" name="submit_bt" value="บันทึกข้อมูล และแก้ไขต่อ" class="btn btn-primary" />
                        <a href="<?php echo ADDRESS_ADMIN_CONTROL?>blog" class="btn btn-danger">ยกเลิก</a> </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php }else{?>
<div class="row-fluid">
    <div class="span12">
        <?php


			// Report errors to the user


			Alert(GetAlert('error'));


			Alert(GetAlert('success'),'success');


		?>
        <div class="da-panel collapsible">
            <div class="da-panel-header"> <span class="da-panel-title"> <i class="icol-grid"></i> บล็อก ทั้งหมด </span> </div>
            <div class="da-panel-toolbar">
                <div class="btn-toolbar">
                    <div class="btn-group"> <a class="btn" href="<?php echo ADDRESS_ADMIN_CONTROL?>blog&action=add"><i class="icol-add"></i> เพิ่มข้อมูล</a> <a class="btn" onClick="multi_delete()"><img src="http://icons.iconarchive.com/icons/awicons/vista-artistic/24/delete-icon.png" height="16" width="16"> Delete</a> </div>
                </div>
            </div>
            <div class="da-panel-content da-table-container">
                <table id="da-ex-datatable-sort" class="da-table" sort="3" order="asc" width="1000">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th style="font-size:12;">รหัส</th>
                            <th style="font-size:12;">ชื่อบล็อก</th>
                            <th style="font-size:12;">กลุ่มบล็อก</th>
                            <th style="font-size:12;">สถานะ</th>
                            <th style="font-size:12;">แก้ไขล่าสุด</th>
                            <th style="font-size:12;">ตัวเลือก</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php


							$sql = "SELECT * FROM " . $blog->getTbl();


							$query = $db->Query($sql);


							while ($row = $db->FetchArray($query)){


						?>
                        <tr>
                            <td class="center" width="5%" style="font-size:12;"><input type="checkbox" value="<?php echo $row['id'];?>" id="chkboxID"></td>
                            <td class="center" style="font-size:12;"><?php echo $row['id'];?></td>
                            <td style="font-size:12;"><?php echo $row['blog_name'];?></td>
                            <td style="font-size:12;"><?php echo $blog_category->getDataDesc("category_name","id = '" . $row['blog_category_id'] . "'")?></td>
                            <td class="center" style="font-size:12;"><i class="icol-<?php echo ($row['status'] == 'ใช้งาน') ? 'accept' : 'cross'?>" title="<?php echo $row['status']?>"></i></td>
                            <td class="center" style="font-size:12;"><?php echo $functions->ShowDateThTime($row['updated_at'])?></td>
                            <td class="center" style="font-size:12;"><a href="<?php echo ADDRESS_ADMIN_CONTROL?>blog&action=edit&id=<?php echo $row['id']?>" class="btn btn-primary btn-small">แก้ไข / ดู</a> <a href="#" onclick="if(confirm('คุณต้องการลบข้อมูลนี้หรือใม่?')==true){document.location.href='<?php echo ADDRESS_ADMIN_CONTROL?>blog&action=del&id=<?php echo $row['id']?>'}" class="btn btn-danger btn-small">ลบ</a></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
					
					$("#checkAll").click(function(e) {
                         $('input:checkbox').prop('checked', this.checked);  
                    });
					
					function multi_delete(){
					
						 var msg_id = "";
						 var res = "";
						 
						 $('input:checkbox[id^="chkboxID"]:checked').each(function(){
					  
						   
							 msg_id += ','+$(this).val(); 
							 res = msg_id.substring(1);
							
						  
						  }); 
						  if(res != ''){
							  if(confirm('คุณต้องการลบข้อมูลนี้หรือใม่?')== true){
									document.location.href='<?php echo ADDRESS_ADMIN_CONTROL?>blog&action=del&id='+res;
							  }
						  }
					 
					}
					
					</script>
<?php }?>
<script type="text/javascript">


//$( document ).ready(function() {


	function addfile(){


  	 $("#filecopy:first").clone().insertAfter("div #filecopy:last");


	}


	function delfile(){


  	 //$("#filecopy").clone().insertAfter("div #filecopy:last");


	 var conveniancecount = $("div #filecopy").length;


	 if(conveniancecount > 2){


		 $("div #filecopy:last").remove();


	 }



	}


	$(document).ready(function() {


       


		$('input:radio[name="products_file_name_cover"][value="<?php echo $blog->getDataDesc("products_file_name_cover", "id = '" .  $_GET['id'] . "'");?>"]').prop('checked', true);


		


    });


   


//});


     


</script> 
<script>


  $(function() {


   // $( "#datepicker" ).datepicker();


	 $("#activity_date").datepicker({ dateFormat: "yy-mm-dd" }).val()


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
