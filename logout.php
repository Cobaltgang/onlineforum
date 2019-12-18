<?php 
include_once('functions.php');
include_once('config.php');
session_start();
$serial = $_COOKIE['serial'];
$token = $_COOKIE['token'];
func::deleteRecord($dbh, $serial, $token);
 unset($_SESSION['username']);
 unset($_SESSION['serial']);
 unset($_SESSION['token']);
 unset($_SESSION['user_id']);
 session_destroy();
 func::deleteCookie();
 header('location: forms.php')

 ?>