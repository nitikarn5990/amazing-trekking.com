<?php

// Global Defines

include_once($_SERVER["DOCUMENT_ROOT"] . '/lib/define.php');

// Simpl Framework
include_once(FS_SIMPL . 'simpl.php');

// Custom Functions and Classes
include_once(FS_LIB . 'controllers.php');
include_once(FS_LIB . 'classes.php');
include_once(FS_LIB . 'btce-api.php');
include_once(FS_LIB . 'functions.php');
include_once(FS_LIB . 'pagination.php');


// Make the DB Connection
$db = new DB;
$db->Connect();

$functions = new Utility;


// New Class For Table
//$category = new Category; 
$users = new Users;

//$gallery_categories = new Gallery_Categories;
//$gallery = new Gallery;
//$gallery_file = new Gallery_Files;
//$webs_money = new WebsMoney;
//$product_files = new Product_files;
//$products = new Products; 

$home = new Home;
//$about = new About;
//$shopping_guide = new Shopping_guide;
$contact = new Contact;
$contact_message = new Contact_message;
//$products_message = new Products_message;
//$contact_footer = new Contact_footer;
//$contact_map = new Contact_map;

$slides = new Slides;
$slides_file = new Slide_files;

//$ads = new Ads;
//$ads_files = new Ads_files;
//$bank = new Bank;
//$bank_company = new Bank_company;
//$payment_confirm = new Payment_confirm;
//$best_offer = new Best_offer;
//$blog_category = new Blog_category;
//$blog = new Blog;
//$province = new Province;
//$amphur = new Amphur;
//$district = new District;
//$customer = new Customer;
//$orders = new Orders;
//$orders_detail = new Orders_detail;
//$shipping = new Shipping;
//$shipping_total = new Shipping_total;
//$google_map = new Google_map;
//$tag = new Tag;
//  $payment_confirm_detail = new Payment_confirm_detail();
// $social = new Social;

$ProID = $_GET['productID'];

$sub_images = new Sub_images;
//$txt_slide = new Txt_slide;
//$portfolio = new portfolio;
//$portfolio_head_image = new Portfolio_head_image;
//$portfolio_head_txt = new Portfolio_head_txt;
// $menu = new Menu;
//$menu_head_image = new Menu_head_image;
//  $menu_head_txt = new Menu_head_txt;
//  $menuset = new Menuset;
// $menuset_head_image = new Menuset_head_image;
//    $menuset_head_txt = new Menuset_head_txt;





$location = new Location;
$chart_project = new Chart_project;
$head_image = new Head_image;

$model = new Model;
$modelhome = new Modelhome;
$programs = new Programs;
$gallery = new Gallery;
$guestbook = new Guestbook;

?>
