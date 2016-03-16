<?php
session_start();
setcookie("user");  
session_destroy();

header("Location: ".ADDRESS_ADMIN); //ส่งไปยังหน้าที่ตอ้งการ  


?>