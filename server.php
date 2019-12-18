<?php
include 'config.php';
include 'functions.php';
$errors = array();

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
            if ($password1 != $password2) {
                array_push($errors, "The two passwords do not match");
            }
            echo $username;
            echo $email;
            echo $password1;
            if (count($errors) == 0) {
                $query = "INSERT INTO users (username, email, password) VALUES( username = :username ,email =:email, password = :password)";
                $stmt = $dbh->prepare($query);
                $stmt->execute(array(':username' => $username,':email' => $email, ':password' =>$password));
    
                $row = $stmt->fetch(PDO::FETCH_ASSOC);  
                if($row['user_id'] > 0){
                    func::createRecord($dbh, $row['username'], $row['user_id']);
                    header("location:index.php");
                }
            }

        }
?>