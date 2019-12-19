<?php
include 'config.php';
include 'functions.php';
$errors= array();

if(isset($_POST['create_post'])){
    if (isset($_COOKIE['session_userid']) && isset($_COOKIE['token']) && isset($_COOKIE['serial']))
		{

			$query = "SELECT * FROM sessions WHERE session_userid = :userid AND session_token = :token AND session_serial = :serial;";

			$userid = $_COOKIE['session_userid'];
			$token = $_COOKIE['token'];
            $serial = $_COOKIE['serial'];
            $sessID= $_SESSION['user_id'];

			$stmt = $dbh->prepare($query);
			$stmt->execute(array(':userid' => $userid, 
								 ':token' => $token, 
								 ':serial' => $serial));

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($row['session_userid'] > 0)
			{
				if (
					$row['session_userid'] == $_COOKIE['session_userid'] &&
					$row['session_token']  == $_COOKIE['token']  &&
					$row['session_serial'] == $_COOKIE['serial']
					)
				{
					if (
					$row['session_userid'] == $sessID &&
					$row['session_token']  == $_SESSION['token']  &&
					$row['session_serial'] == $_SESSION['serial']
						)
					{


                        $user_id = $row['session_userid'];
                        $query = "SELECT * FROM sessions WHERE users= :userid;";

            
                        $stmt = $dbh->prepare($query);
                        $stmt->execute(array(':userid' => $userid));
            
                        $row1= $stmt->fetch(PDO::FETCH_ASSOC);
                        $username = $row1['username'];

                        createpost($dbh, $errors, $user_id, $username);
                        

                    }
                    else{
                        header('location: index.php');
                    }


    }
    
}
    
    


    }
}

function createpost($dbh, $errors, $user_id, $username){
    $title = htmlspecialchars(strip_tags($_POST['title']));
    $body = htmlspecialchars(strip_tags($_POST['body']));
    

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