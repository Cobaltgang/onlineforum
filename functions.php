<?php

class func{
    public static function checkLoginState($dbh)
    {
        if(!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID'])){
            session_start();
        }
        else if (isset($_COOKIE['id']) && isset($_COOKIE['token']) && isset($_COOKIE['serial'])){
            $query = "SELECT * FROM sessions WHERE session_userid= :userid AND session_token = :token AND session_serial = :serial";

            $userid = $_COOKIE['userid'];
            $token = $_COOKIE['token'];
            $serial = $_COOKIE['serial'];

            $stmt = $dbh->prepare($query);
            $stmt->execute(array(':userid' =>$userid, ':token' => $token, ':serial' =>$serial));

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row['session_userid'] >0){
                if(
                    $row['session_userid'] ==$_COOKIE['userid']&&
                    $row['session_token']==$_COOKIE['token'] &&
                    $row['session_serial']==$_COOKIE['serial']
                ){
                    if($row['session_userid'] ==$_SESSION['userid']&&
                    $row['session_token']==$_SESSION['token'] &&
                    $row['session_serial']==$_SESSION['serial']){
                        return true;
                    }
                }

            
        }
    }
}

public static function createRecord($dbh){
    $query =('DELETE FROM sessions WHERE session_userid= :session_userid;');

    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':session_userid' => $userid));
    

    $date = date('d/m/Y');
    $token = CryptoLib::randomString(64);
    $serial = CryptoLib::randomString(64);

    func::createCookie($username, $user_id, $token, $serial);
    func::createSession($username, $token, $serial);
    
    $dbh -> prepare('INSERT INTO sessions(session_userid, session_token, session_serial, session_date) VALUES (:session_userid,:token, :serial, :date )');
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':session_userid' => $userid, ':token' => $token, ':serial' =>$serial, ':date' =>$date));

}

public static function createCookie($username, $user_id, $token, $serial){
    setcookie('user_id', $user_id, time() + (86400) *30, "/");
    setcookie('token', $token, time() + (86400) *30, "/");
    setcookie('serial', $serial, time() + (86400) *30, "/");
}

public static function createSession($username, $user_id, $token, $serial){
    if(!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID'])){
        session_start();
    }
    else{

    
    setcookie('user_id', $user_id, time() + (86400) *30, "/");
    setcookie('token', $token, time() + (86400) *30, "/");
    setcookie('serial', $serial, time() + (86400) *30, "/");
    }
}

}