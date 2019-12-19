<?php

include 'config.php';
$errors= array();

function getAllPostTitles(){
    global $dbh;
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM posts where user_id = :user_id";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':user_id' => $user_id));
    
    $titles = array();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $titles[] = $row['title'];
}
return $titles;

}
if(isset($_GET['del'])){
    deletepost();
    }
function deletepost(){
    $id = $_GET['del'];  
    global $dbh;
    $query = "DELETE FROM posts WHERE post_id=:id";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':id' => $id));
    header('location: myposts.php');
    
}
function getAllPostMessages(){
    global $dbh;
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM posts where user_id = :user_id";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':user_id' => $user_id));
   
    $messages = array();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $messages[]=$row['message'];
}
return $messages;
}
function getAllPostAuthors(){
    global $dbh;
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM posts where user_id = :user_id";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':user_id' => $user_id));
   
    $authors = array();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $authors[]=$row['message'];
}
}
function getid(){
    global $dbh;
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM posts where user_id = :user_id";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':user_id' => $user_id));
   
    $authors = array();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $authors[]=$row['post_id'];
}
return $authors;
}
?>