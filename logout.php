
<?php include_once('header.php');
func::deleteCookie();
session_destroy();

header('location:login.php');
 ?>
