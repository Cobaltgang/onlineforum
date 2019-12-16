<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$config = parse_ini_file('db.ini');
$host = $config['host'];
$dbname =$config['db'];
$password =$config['password'];
$user = $config['username'] ;
$dbh = new PDO('mysql:host=35.228.244.41;dbname=forum',$user, $password);

$stmt = $dbh->prepare("SELECT * FROM users;");
$stmt->execute();



$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row)
{
    echo $row[username];
}
?>