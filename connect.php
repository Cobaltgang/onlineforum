<?php
// Require composers autoloader
require_once './vendor/autoload.php';

// Initiate a new instance of the Pwned class
$pwned = new \MFlor\Pwned\Pwned();
echo $pwned->passwords()->occurences('password');

?>