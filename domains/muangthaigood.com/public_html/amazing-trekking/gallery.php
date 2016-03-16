<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Gallery Amazing  private  tour</title>
        <meta name="description" content="Gallery Amazing  private  tour" />
        <meta name="keywords" content="Gallery Amazing  private  tour" />
        <link href="style.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="images/icon.png">
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
            <script src="dist/slippry.min.js"></script>
            <script src="//use.edgefonts.net/cabin;source-sans-pro:n2,i2,n3,n4,n6,n7,n9.js"></script>
            <meta name="viewport" content="width=device-width">
                <link rel="stylesheet" href="dist/slippry.css">
                    <link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
                    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
                    <script type="text/javascript" src="js/prototype.lite.js"></script>
                    <script type="text/javascript" src="js/moo.fx.js"></script>
                    <script type="text/javascript" src="js/litebox-1.0.js"></script>
                    </head>
                    <body  onload="initLightbox()">
                        <div id="header">
                            <div id="menu-logo">
                                <div id="logo"><a href=""><img src="images/logo.png" width="86" height="96" /></a></div>
                                <div id="menu">
                                    <ul>
                                        <li><a href="index.html" title="Home">Home</a></li>
                                        <li><a href="about.html" title="About Us">About Us</a></li>
                                        <li><a href="programs.html" title="Programs">Programs</a></li>
                                        <li><a href="guestbook.html" title="Guestbook">Guestbook</a></li>
                                        <li><a href="gallery.html" title="Gallery">Gallery</a></li>
                                        <li><a href="contact.html" title="Contact Us">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="slide">
                                <article class="demo_block">
                                    <ul id="demo1" style="list-style:none; position:0; margin:0; width:100%;">
                                        <li><a href="#slide1"><img src="img/slide.jpg" /></a></li>
                                        <li><a href="#slide1"><img src="img/slide.jpg" /></a></li>
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
                         
<div id="content">
    <h1>Gallery Amazing  private  tour</h1>
    <p style="text-align: left; width:100%;">
        <?php
        $sql1 = "SELECT * FROM " . $gallery->getTbl() . " WHERE status = 'ใช้งาน' ORDER BY sort ASC";
        $query1 = $db->Query($sql1);
        $numRow1 = $db->NumRows($query1);
        if ($numRow1 > 0) {
            while ($row1 = $db->FetchArray($query1)) { ?>
                <a href="<?=ADDRESS?>img/<?=$row1['image']?>" rel="lightbox[example]" title="<?=$row1['alt_tag']?>"><img src="<?=ADDRESS?>img/<?=$row1['image']?>" alt="<?=$row1['alt_tag']?>" class="bordered" /></a>
            <?php }?>
        <?php }?>
    </p>
    <div class="clear"></div>
</div>
                            <div id="footer">
                                <p class="social">Follow Cheveolet : <a href=""><img src="images/iconf.jpg" /></a> <a href=""><img src="images/icont.jpg" /></a> <a href=""><img src="images/icony.jpg" /></a> <a href=""><img src="images/icone.jpg" /></a></p>
                                <p class="tel">Please call direct: (+66)8-4808-7663</p>
                                <p class="clear"></p>
                                <div class="linefooter"></div>
                                <p class="clear"></p><br />
                                <p>Amazing Trekking Tour / Design by <a href="http://webdesignchiangmai.com/">WeDeSignChiangMai</a>.com</p>
                                <p>By KALU Tel.+668-4808-7663  E-mail: kaluguide@yahoo.co.th</p>
                            </div>
                        </div>
                        </div>
                    </body>
                    </html>
