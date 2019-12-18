<?php include_once('header.php');
if (!func::checkLoginState($dbh)){
    echo'<a href="logout.php">Logout</a>';
}
else{
    echo'<a href="login.php">Login</a>';
}