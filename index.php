<?php
include_once("header.php")

?>
<div>
    
     <?php
     if(!checkLoginState){
         echo 'Welcome' . $_SESSION['username'] . '!';
     }
     else{
         header("location:login.php");
     }
     ?>
</div>
<?php include_once("footer.php");
?>

