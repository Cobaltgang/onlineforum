<?php include_once("header.php");
?>

<div>
   
   <?php
    if (func::checkLoginState($dbh)){
        if(isset($_POST['username']) && isset($_POST['password'])){
            $query = "SELECT * FROM users WHERE username = :username AND password = :password";

            $username = $_POST['username'];
            $password = $_POST['password'];

            $stmt = $dbh->prepare($query);
            $stmt->execute(array(':username' => $username, ':password' =>$password,));

            $row = $stmt-fetch(PDO::FETCH_ASSOC);

            if($row['user_id'] > 0){
                //func::createRecord($row['user_id'], $row['username'])
                header("location:index.php");
                $string=  CryptoLib::randomString(64);
                echo $string;
                


            }
        }
    }
    else{
        echo ' <form action="login.php" method ="post">
               <label>Username</label><br />
               <input type="text" name ="username" /> <br />

               <label>Password</label><br />
               <input type = "password" name="password"/> <br />
               <input type="submit" value="login"/>
               </form>';
    }
    
    
    ?>
</div>