<?php
include_once("header.php")

?>
<div>
    
     <?php

     if(!func::checkLoginState($dbh)){
         echo 'Welcome ' . $_SESSION['username'] . '!';
     }
     else{
         header("location:login.php");
         exit();
     }
    ?>
</div>
<?php include_once("footer.php");
?>

