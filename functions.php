<?php
	require_once './includes/CryptoLib.php';
	header("strict-transport-security: max-age=600");

class func{
    public static function checkLoginState($dbh)
	{
		if (!isset($_SESSION))
		{
			session_start();
		}
		if (isset($_COOKIE['session_userid']) && isset($_COOKIE['token']) && isset($_COOKIE['serial']))
		{
			$query = "SELECT * FROM sessions WHERE session_userid = :userid AND session_token = :token AND session_serial = :serial;";

			$userid = $_COOKIE['session_userid'];
			$token = $_COOKIE['token'];
			$serial = $_COOKIE['serial'];

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
					$row['session_userid'] == $_SESSION['user_id'] &&
					$row['session_token']  == $_SESSION['token']  &&
					$row['session_serial'] == $_SESSION['serial']
						)
					{
						return true;
					}
					else
					{
						func::createSession($_COOKIE['username'], $_COOKIE['session_userid'], $_COOKIE['token'], $_COOKIE['serial']);
						return true;
					}
				}
			}
		}
	}

public static function createRecord($dbh, $username, $user_id){
    $query =('DELETE FROM sessions WHERE session_userid= :session_userid;');

    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':session_userid' => $user_id));
    echo'session deleted';

    $date = date('d/m/Y');
    $token = CryptoLib::randomString(64);
    $serial = CryptoLib::randomString(64);

    func::createCookie($username, $user_id, $token, $serial);
    func::createSession($username, $user_id, $token, $serial);
    $query = "INSERT INTO sessions (session_userid, session_token, session_serial, session_date) VALUES (:user_id, :token, :serial, :date);";
		$stmt = $dbh->prepare($query);
		$stmt->execute(array(':user_id' => $user_id,
							 ':token' => $token,
                             ':serial' => $serial,
                            ':date'=>$date));
                             


}

public static function createCookie($username, $user_id, $token, $serial){
setcookie('username', $username, time() + (86400) *10, "/", null, true, true, /*['samesite'=>'Strict']*/);
setcookie('session_userid', $user_id, time() + (86400) *10, "/", null, true, true, /*['samesite'=>'Strict']*/);
setcookie('token', $token, time() + (86400) *10, "/", null, true, true, /*['samesite'=>'Strict']*/);
setcookie('serial', $serial, time() + (86400) *10, "/", null, true, true, /*['samesite'=>'Strict']*/);
}

public static function deleteCookie(){
    setcookie('username', "", time() - 3600);
    setcookie('session_userid', "", time() - 3600);
    setcookie('token',  "", time() - 3600);
    setcookie('serial',"",  time() - 3600);
}

public static function createSession($username, $user_id, $token, $serial){
    if(!isset($_SESSION)){
        session_start();
    }
    
    $_SESSION['username'] = $username;
    $_SESSION['serial'] = $serial;
    $_SESSION['token'] = $token;
    $_SESSION['user_id'] = $user_id;

    
   

}
public static function deleteRecord($dbh, $serial, $token){
    $query =('DELETE FROM sessions WHERE session_serial= :session_serial AND session_token=:session_token');

    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':session_serial' => $serial, ':session_token' => $token));



}

}