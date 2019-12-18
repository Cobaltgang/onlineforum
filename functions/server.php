<?php
include 'config.php';
include 'functions.php';
require_once './vendor/autoload.php';
$errors = array();
$pwned = new \MFlor\Pwned\Pwned();

if (isset($_POST['login_user'])) {
    $username = trim(htmlspecialchars($_POST['username']));
	$password = $_POST['password'];
    if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
    }
    if (count($errors) == 0) {
	
        $query = "SELECT * FROM users WHERE username = :username AND password = :password";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array(':username' => $username, ':password' =>$password));

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($row['user_id'] > 0){
                func::createRecord($dbh, $row['username'], $row['user_id']);
                header("location:index.php");
            }
            else{
                array_push($errors, "The account name or password that you have entered is incorrect.");
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
            if (htmlspecialchars(strip_tags($password1))) { array_push($errors, "Invalid password entered"); }
            if (htmlspecialchars(strip_tags($email))) { array_push($errors, "Invalid email entered"); }
            if (htmlspecialchars(strip_tags($username))) { array_push($errors, "Invalid username entered"); }
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
                array_push($errors, "Please choose a more secure password, that password has been found in many leaks.");
            }
            else{
                if (count($errors) == 0) {
                    $query = "INSERT INTO users (username, email, password) VALUES(:username ,:email,:password)";
                    $stmt = $dbh->prepare($query);
                    $stmt->execute(array(':username' => $username,':email' => $email, ':password' =>$password1));
        
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);  
                    if($row['user_id'] > 0){
                        header("location:index.php");
                    }
                }
            }
            

        }
?>