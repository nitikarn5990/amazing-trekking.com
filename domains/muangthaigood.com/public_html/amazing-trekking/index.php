<?php
session_start();

include_once($_SERVER["DOCUMENT_ROOT"] . '/lib/application.php');
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Amazing  private  tour</title>
        <meta name="description" content="Amazing  private  tour" />
        <meta name="keywords" content="Amazing  private  tour" />
        <meta name="viewport" content="width=device-width" />
        <link rel="shortcut icon" href="<?= ADDRESS ?>images/icon.png" />
        <link href="<?= ADDRESS ?>style.css" rel="stylesheet" type="text/css" />
           <link rel="stylesheet" href="<?= ADDRESS ?>dist/slippry.css" />

        <script src="<?= ADDRESS ?>js/jquery.min.js"></script>
        <script src="<?= ADDRESS ?>dist/slippry.min.js"></script>
        <script src="<?= ADDRESS ?>plugins/verify.notify.min.js"></script>
        
         <link rel="stylesheet" href="<?= ADDRESS ?>src/css/lightbox.css" />

        <script src='https://www.google.com/recaptcha/api.js?hl=en'></script>
        <style>
            .da-message {
                font-size: 12px;
                border: 1px solid #d2d2d2;
                padding: 15px 8px 15px 45px;
                position: relative;
                cursor: pointer;
                background-color: #f8f8f8;
                background-position: 12px 12px;
                background-repeat: no-repeat;
                margin: 10px 0 10px 0;
            }
            .da-message.success {
                background-color: #e1f1c0;
                background-image: url(admin/assets/images/message-success.png);
                border-color: #b5d56d;
                color: #62a426;
            }
            .da-message.error {
                background-color: #F2DEDE;
                background-image: url(admin/assets/images/message-error.png);
                border-color: rgba(235, 151, 155, 0.48);
                color: #9b4449;
            }
        </style>

    </head>
    <body>
        <div id="header">
            <div id="menu-logo">
                <div id="logo"><a href=""><img src="<?= ADDRESS ?>images/logo.png" width="86" height="96" /></a></div>
                <div id="menu">
                    <ul>
                        <li><a href="<?= ADDRESS ?>" class="<?= PAGE_CONTROLLERS == '' ? 'active' : '' ?>" title="Home">Home</a></li>
                        <li><a href="<?= ADDRESS ?>about" class="<?= PAGE_CONTROLLERS == 'about' ? 'active' : '' ?>" title="About Us">About Us</a></li>
                        <li><a href="<?= ADDRESS ?>programs" class="<?= PAGE_CONTROLLERS == 'programs' ? 'active' : '' ?>" title="Programs">Programs</a></li>
                        <li><a href="<?= ADDRESS ?>guestbook" class="<?= PAGE_CONTROLLERS == 'guestbook' ? 'active' : '' ?>" title="Guestbook">Guestbook</a></li>
                        <li><a href="<?= ADDRESS ?>gallery" class="<?= PAGE_CONTROLLERS == 'gallery' ? 'active' : '' ?>" title="Gallery">Gallery</a></li>
                        <li><a href="<?= ADDRESS ?>contact" class="<?= PAGE_CONTROLLERS == 'contact' ? 'active' : '' ?>" title="Contact Us">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div id="slide">
                <article class="demo_block">
                    <ul id="demo1" style="list-style:none; position:0; margin:0; width:100%;">
                        <?php
                        $sql1 = "SELECT * FROM " . $slides->getTbl() . " WHERE status = 'ใช้งาน' ORDER BY sort ASC";
                        $query1 = $db->Query($sql1);
                        $numRow1 = $db->NumRows($query1);
                        if ($numRow1 > 0) {
                            while ($row1 = $db->FetchArray($query1)) {
                                ?>
                                <li><a href="#slide1"><img src="<?php echo ADDRESS_SLIDES . $slides_file->getDataDescLastID("file_name", "slides_id = " . $row1['id']) ?>" /></a></li>

                            <?php } ?>
                        <?php } ?>

                    </ul>
                </article>
                <script>
                    $(function () {
                        var demo1 = $("#demo1").slippry({
                            transition: 'fade',
                            useCSS: true,
                            speed: 1000,
                            pause: 3000,
                            auto: true,
                            preload: 'visible'
                        });

                        $('.stop').click(function () {
                            demo1.stopAuto();
                        });

                        $('.start').click(function () {
                            demo1.startAuto();
                        });

                        $('.prev').click(function () {
                            demo1.goToPrevSlide();
                            return false;
                        });
                        $('.next').click(function () {
                            demo1.goToNextSlide();
                            return false;
                        });
                        $('.reset').click(function () {
                            demo1.destroySlider();
                            return false;
                        });
                        $('.reload').click(function () {
                            demo1.reloadSlider();
                            return false;
                        });
                        $('.init').click(function () {
                            demo1 = $("#demo1").slippry();
                            return false;
                        });
                    });
                </script>
            </div>
            <div id="slidebar-left">
                <div><iframe width="239" height="143" src="https://www.youtube.com/embed/UouU4_-dWlc" frameborder="0" allowfullscreen></iframe></div>
                <div id="TA_selfserveprop171" class="TA_selfserveprop">
                    <ul id="ZIonwiBEda" class="TA_links 2ly8y1">
                        <li id="Rla6AopI" class="2VD5aXIQeUHc">
                            <a target="_blank" href="http://www.tripadvisor.com/"><img src="http://www.tripadvisor.com/img/cdsi/img2/branding/150_logo-11900-2.png" alt="TripAdvisor"/></a>
                        </li>
                    </ul>
                </div>
                <script src="http://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=171&amp;locationId=4039755&amp;lang=en_US&amp;rating=true&amp;nreviews=0&amp;writereviewlink=true&amp;popIdx=true&amp;iswide=false&amp;border=false&amp;display_version=2"></script>
            </div>
            <!-- Content -->
            <?php
            if (PAGE_CONTROLLERS == '' || PAGE_CONTROLLERS == 'index') {

                include 'controllers/home.php';
            } else {
                include 'controllers/' . PAGE_CONTROLLERS . '.php';
            }
            ?>
            <div class="clear"></div>
            <?php if (PAGE_CONTROLLERS == '' || PAGE_CONTROLLERS == 'index') { ?>
                <div id="footer">
                    <p class="social">Follow Cheveolet : <a href=""><img src="<?= ADDRESS ?>images/iconf.jpg" /></a> <a href=""><img src="<?= ADDRESS ?>images/icont.jpg" /></a> <a href=""><img src="<?= ADDRESS ?>images/icony.jpg" /></a> <a href=""><img src="<?= ADDRESS ?>images/icone.jpg" /></a></p>
                    <p class="tel">Please call direct: (+66)8-4808-7663</p>
                    <p class="clear"></p>
                    <div class="linefooter"></div>
                    <p class="clear"></p><br />
                    <p>Amazing Trekking Tour / Design by <a href="http://webdesignchiangmai.com/">WeDeSignChiangMai</a>.com</p>
                    <p>By KALU Tel.+668-4808-7663  E-mail: kaluguide@yahoo.co.th</p>
                </div>
            <?php } ?>
        </div>

    </body>
</html>
