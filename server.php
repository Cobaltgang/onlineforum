<?php
include 'config.php';
include 'functions.php';
require_once './vendor/autoload.php';
$errors = array();
$pwned = new \MFlor\Pwned\Pwned();

if (isset($_POST['login_user'])) {
    $username = ($_POST['username']);
	$password = $_POST['password'];
    if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
    }
    $query = "SELECT COUNT(*) FROM `ip` WHERE `address` LIKE :IPaddress AND `timestamp` > (now() - interval 10 minute)";
                $stmt = $dbh->prepare($query);
                $stmt->execute(array(':IPaddress' => $IPaddress));

                $count = $stmt->fetch(PDO::FETCH_ASSOC);
                



    

                if ($row['address'] > 0)
                {
            echo "Your are allowed 3 attempts in 10 minutes";
        }
        if($count[0] < 3){
            if ($row['address'] > 0) {
	
        $query = "SELECT * FROM users WHERE username = :username ";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array(':username' => $username));


            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($password, $row['password'])) {
                
       
                func::createRecord($dbh, $row['username'], $row['user_id']);
                header("location:index.php");
        
            }
            else{
                array_push($errors, "The account name or password that you have entered is incorrect.");
                $IPaddress= func::get_client_ip();
                $query = "INSERT INTO `ip` (`address` ,`timestamp`)VALUES (:ip, CURRENT_TIMESTAMP)";
                $stmt = $dbh->prepare($query);
                $stmt->execute(array(':ip' => $IPaddress));

                
            }
        
            
        }
    }
    

        if (isset($_POST['reg_user'])) {
            $username=trim(htmlspecialchars($_POST['username']));
            $email=$_POST['email'];
            $password1 = $_POST['password'];
            $password2 = $_POST['cpassword'];
            if (empty($username)) { array_push($errors, "Username is required"); }
            if (empty($email)) { array_push($errors, "Email is required"); }
            if (empty($password)) { array_push($errors, "Password is required"); }
           
            if ($password1 != $password2) {
                array_push($errors, "The two passwords do not match");
            }
            $query1 = "SELECT * FROM users WHERE username = :username";
            $stmt1 = $dbh->prepare($query1);
            $stmt1->execute(array(':username' => $username));
            $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

            $query2 = "SELECT * FROM users WHERE email = :email";
            $stmt2 = $dbh->prepare($query2);
            $stmt2->execute(array(':email' => $email));
            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
            if($row2['user_id'] > 0){
                array_push($errors, "email already in use");
            }
            if($row1['user_id'] > 0){
                array_push($errors, "Username taken");
            }
            $weak = $pwned->passwords()->occurences($password1);
            $occur =  (int)$weak;
           
        
            if($occur > 0){
                array_push($errors, "Please choose a more secure password, that password has been found in ".$occur." leaks.");
                
                
            }
            else{
                if (count($errors) == 0) {
                    $hash= password_hash($password1, PASSWORD_ARGON2I);
                    $query = "INSERT INTO users (username, email, password) VALUES(:username ,:email,:password)";
                    $stmt = $dbh->prepare($query);
                    $stmt->execute(array(':username' => $username,':email' => $email, ':password' =>$hash));
                    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
                    func::createRecord($dbh, $row['username'], $row['user_id']);
                    
                    $_SESSION['message'] = "User registered successfully, please login to continue";  
                    
                }
            }
            

        }

        // function getOccurance(){
        //     $password1 = $_POST['password'];
        //     $pwned = new \MFlor\Pwned\Pwned();
        //     $weak = $pwned->passwords()->occurences($password1);
        //     $occur =  (int)$weak;
        //     return $occur;
        // }
?>