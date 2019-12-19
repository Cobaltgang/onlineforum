<?php
session_start();
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






                        $id = $_GET['del']; 
                        $userID = $row['session_userid'];

                        $query = "SELECT * FROM posts WHERE user_id = :userid AND post_id = :post_id;";

			       

			            $stmt = $dbh->prepare($query);
			            $stmt->execute(array(':userid' => $userID, 
								 ':post_id' => $id));

			            $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($row1['user_id'] > 0){
                            deletepost();
                        }
                        else{
                            header('location: index.php');
                        }


                        

                    }
                    else{
                        header('location: index.php');
                    }


    }
}
else{
    header('location: index.php');
}
        }
        else{
            header('location: index.php');
        }
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