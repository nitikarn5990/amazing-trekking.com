
<?php
/* curl function to get response object */

function curl_url($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

if ($_POST['submit_bt'] == 'Post Comment') {
    // set recaptchar paremeter 
    $params = array();
    $params['secret'] = '6Lev8RoTAAAAAPMGZxMM0W_et9GRtd4qxX4GZROB';
    $params['response'] = $_POST['g-recaptcha-response'];
    $params['remoteip'] = $_SERVER['REMOTE_ADDR'];

    $url = 'https://www.google.com/recaptcha/api/siteverify?';
    $url .= http_build_query($params);
    $response = curl_url($url); // use file_get_content if openssl
    $response = json_decode($response, true);

    if ($response['success']) {

        $arrData = array(
            'name' => $_POST['name'],
            'title' => $_POST['title'],
            'comment' => $_POST['comment'],
            'email' => $_POST['email'],
            'comment_show_home' => 'off',
            'created_at' => DATE_TIME,
            'updated_at' => DATE_TIME
        );

        $guestbook->SetValues($arrData);


        if ($_FILES["file_array"]["name"] != '') {

            $targetPath = DIR_ROOT_IMG;
            $newImage = DATE_TIME_FILE . "_" . $_FILES['file_array']['name'];
            $cdir = getcwd(); // Save the current directory
            chdir($targetPath);
            copy($_FILES['file_array']['tmp_name'], $targetPath . $newImage);
            chdir($cdir); // Restore the old working directory   
            $guestbook->SetValue('image', $newImage);
        }

        if ($guestbook->Save()) {

            SetAlert('Add Comment Success', 'success');

            header('location:' . ADDRESS . 'guestbook');

            die();
        } else {

            SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
        }
    } else {

        SetAlert('Error');

        header('location:' . ADDRESS . 'guestbook');

        die();
    }
}
?>

<div id="content">

    <?php
    // Report errors to the user
    Alert(GetAlert('error'));


    Alert(GetAlert('success'), 'success');
    ?>
  

    <!-- pagination -->

    <?php
    $strSQL = "SELECT * FROM " . $guestbook->getTbl() ;

    $objQuery = $db->Query($strSQL);
    $Num_Rows = $db->NumRows($objQuery);
    $numRow = $Num_Rows;

    $Per_Page = 5;   // Per Page

    $Page = $_GET["Page"];
    if (!$_GET["Page"]) {
        $Page = 1;
    }

    $Prev_Page = $Page - 1;
    $Next_Page = $Page + 1;

    $Page_Start = (($Per_Page * $Page) - $Per_Page);
    if ($Num_Rows <= $Per_Page) {
        $Num_Pages = 1;
    } else if (($Num_Rows % $Per_Page) == 0) {
        $Num_Pages = ($Num_Rows / $Per_Page);
    } else {
        $Num_Pages = ($Num_Rows / $Per_Page) + 1;
        $Num_Pages = (int) $Num_Pages;
    }

    $strSQL .=" order  by id ASC LIMIT $Page_Start , $Per_Page";
    $objQuery = mysql_query($strSQL);
    ?>
    <h1>Guestbook Amazing  private  tour</h1>
    <?php
    while ($objResult = $db->FetchArray($objQuery)) {
        ?>
     <div class="comment-box">

                <p class="comment-number"><b>Comment #<?= $objResult['id']; ?></b></p>
                <div class="clear"></div>
                <div class="comment-name"> <?= $objResult['name'] ?> </div>
                <p class="comment-date">  <?= $functions->ShowDay($objResult['created_at']) . ',' . $functions->ShowDateEngTime($objResult['created_at']) ?></p>
                <p class="comment-title"> <?= $objResult['title'] ?></p>
                <div>
                    <p class="comment-detail">
                    <ul>
                        <li>
                            <?= $objResult['comment'] ?>
                        </li>
                        <?php if ($objResult['image'] != '') { ?>
                            <li>
                                <img src="<?= ADDRESS ?>img/<?= $objResult['image'] ?>" style="max-width: 100%;">
                            </li>       
                        <?php } ?>
                    </ul>
                    <p>
                </div>
                <div class="clear"></div>
            </div>
        <?php
    }
    ?>
    <div style="font-weight:bold;">
        <br>
        Total <?php echo $Num_Rows; ?> Record 

        <?php
        $pages = new Paginator;
        $pages->items_total = $Num_Rows;
        $pages->mid_range = 10;
        $pages->current_page = $Page;
        $pages->default_ipp = $Per_Page;
        $pages->url_next = ADDRESS_CONTROL . "guestbook&Page=";

        $pages->paginate();

        echo $pages->display_pages()
        ?>	
    </div>	
    <!-- End pagination -->
    <form method="POST" action="<?= ADDRESS ?>guestbook" enctype="multipart/form-data" id="frm-comment">
        <p><b>LEAVE YOUR COMMENT</b></p>
        <div id="comment_form">
            <div>
                <input type="text" name="name" id="name" value="" placeholder="Name" data-validate="required">
            </div>
            <div>
                <input type="email" name="email" id="email" value="" placeholder="Email" data-validate="required,email">
            </div>
            <div>
                <input type="text" name="title" id="title" value="" placeholder="Subject" data-validate="required">
            </div>
            <div>
                <textarea rows="10" name="comment" id="comment" placeholder="Comment" data-validate="required"></textarea>
            </div>
            <div>
                <p><input type="file" name="file_array" value="Attract File"></p>
                <div class="g-recaptcha" data-sitekey="6Lev8RoTAAAAAPdxUpFiEhs8n8cLijX9ZL-kDVVX"></div>
            </div>
            <div>

                <input type="submit" name="submit_bt2" value="Post Comment">
                <input type="hidden" name="submit_bt" value="Post Comment">
            </div>


        </div>
    </form>
       <?php include_once  'inc_footer.php';?>
</div>
<style>


    #comment_form input, #comment_form textarea {
        border: 4px solid rgba(0,0,0,0.1);
        padding: 8px 10px;

        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;


        outline: 0;
    }
    #comment_form input:not([type="submit"]),#comment_form textarea{
        width: 600px;
    }
    #comment_form input[type="file"]{
        width: 200px;
    }


    #comment_form input[type="submit"] {
        cursor: pointer;
        background: -webkit-linear-gradient(top, #efefef, #ddd);
        background: -moz-linear-gradient(top, #efefef, #ddd);
        background: -ms-linear-gradient(top, #efefef, #ddd);
        background: -o-linear-gradient(top, #efefef, #ddd);
        background: linear-gradient(top, #efefef, #ddd);
        color: #333;
        text-shadow: 0px 1px 1px rgba(255,255,255,1);
        border: 1px solid #ccc;
    }

    #comment_form input[type="submit"]:hover {
        background: -webkit-linear-gradient(top, #eee, #ccc);
        background: -moz-linear-gradient(top, #eee, #ccc);
        background: -ms-linear-gradient(top, #eee, #ccc);
        background: -o-linear-gradient(top, #eee, #ccc);
        background: linear-gradient(top, #eee, #ccc);
        border: 1px solid #bbb;
    }

    #comment_form input[type="submit"]:active {
        background: -webkit-linear-gradient(top, #ddd, #aaa);
        background: -moz-linear-gradient(top, #ddd, #aaa);
        background: -ms-linear-gradient(top, #ddd, #aaa);
        background: -o-linear-gradient(top, #ddd, #aaa);
        background: linear-gradient(top, #ddd, #aaa);	
        border: 1px solid #999;
    }

    #comment_form div {
        margin-bottom: 8px;
    }
    .comment-list{
        margin-bottom: 15px;
    }
    .comment-list li{
        background-color: #FFF;
        padding: 20px;

    }
    .comment-box{
        margin: 25px 0 0 0;
        background: #fff;
        padding: 5px 20px 10px 20px;
        border-radius: 5px;
        border: 3px solid rgba(204, 204, 204, 0.27);

        -webkit-box-shadow: 4px 3px 14px -6px rgba(0, 0, 0, 0.31);
        -moz-box-shadow: 4px 3px 14px -6px rgba(0, 0, 0, 0.31);
        box-shadow: 4px 3px 14px -6px rgba(0, 0, 0, 0.31);

    }
    .comment-box .comment-number{
        float: right;
        margin-bottom: 0;
    }
    .comment-box ul{
        list-style:none;
    }
    .comment-box ul li{
        margin-bottom: 10px;
    }
    #frm-comment{
        padding: 15px;
        background: rgb(255, 255, 255);
        border-radius: 5px;
        margin-top: 35px;
    }
</style>