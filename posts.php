<?php
include 'config.php';
include 'functions.php';
$errors= array();

if(isset($_POST['create_post'])){
    createpost($dbh, $errors);
    }

    
function createpost($dbh,$errors){
    $title = htmlspecialchars(strip_tags($_POST['title']));
    $body = htmlspecialchars(strip_tags($_POST['body']));
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];

    if (empty($title)) {
        array_push($errors, "Title is required");
    }
	if (empty($body)) {
		array_push($errors, "Body is required");
    }
    if (count($errors) == 0) {
        $query = "INSERT INTO posts (user_id, title, message, username) VALUES(:user_id,:title ,:message,:username)";
                    $stmt = $dbh->prepare($query);
                    $stmt->execute(array(':user_id'=> $user_id, ':title' => $title,':message' => $body, ':username'=> $username));

                    $_SESSION['message'] = "Post created successfully";  
                    
                }
                return $errors;
}

function getAllPostTitles(){
    global $dbh;
    $query = "SELECT * FROM posts";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($query));
    
    $titles = array();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $titles[] = $row['title'];
}
return $titles;

}
function getAllPostMessages(){
    global $dbh;
    $query = "SELECT * FROM posts";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($query));
   
    $messages = array();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $messages[]=$row['message'];
}
return $messages;
}
function getAllPostAuthors(){
    global $dbh;
    $query = "SELECT * FROM posts";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($query));
   
    $authors = array();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $authors[]=$row['username'];
}
return $authors;
}
?>