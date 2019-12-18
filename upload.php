<?php
include 'config.php';
include 'functions.php';
$errors= array();

if(isset($_POST['create_post'])){
    $title = htmlspecialchars(strip_tags($_POST['title']));
    $body = htmlspecialchars(strip_tags($_POST['body']));
    $user_id = $_SESSION['user_id'];

    if (empty($title)) {
        array_push($errors, "Title is required");
    }
	if (empty($body)) {
		array_push($errors, "Body is required");
    }
    if (count($errors) == 0) {
        $query = "INSERT INTO posts (user_id, title, message) VALUES(:user_id,:title ,:message)";
                    $stmt = $dbh->prepare($query);
                    $stmt->execute(array(':user_id'=> $user_id, ':title' => $title,':message' => $body));

                    $_SESSION['message'] = "Post created successfully";  
                    
                }
    }


?>