<?php 
include_once('config.php');
include_once('functions.php');
$userid = $_COOKIE['userid'];
$username=$_COOKIE['username'];
func::deleteCookie();
func::deleteRecord($dbh, $userid, $username);

            


 unset($_SESSION['username']);
 unset($_SESSION['serial']);
 unset($_SESSION['token']);
 unset($_SESSION['user_id']);
 session_destroy();

header('location:login.php');
 ?>