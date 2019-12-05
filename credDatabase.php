<?php

require_once 'credentials.php';
date_default_timezone_set('America/Denver');

$con = new mysqli($hostname, $username, $password, $database);

$query = "SHOW DATABASES LIKE 'dbname'";

if ($con->connect_error) die($con->connect_error);
$q = "CREATE TABLE IF NOT EXISTS userData (
    firstName VARCHAR(32) NOT NULL,
    lastName VARCHAR(32) NOT NULL,
    username VARCHAR(32) NOT NULL UNIQUE,
    saltpassword VARCHAR(32) NOT NULL UNIQUE,
    timex DATETIME NOT NULL,
    lastLogin DATETIME NOT NULL, 
    userType TINYINT(1) NOT NULL
    )";

$r = $con->query($q);
if (!$r){ 
    die($con->error); 
}

addCustomer($con, "jesus", "garcia", "admin", "nimda339", 0, "e4djuki9");

function addCustomer($con, $fName, $lName, $uName, $pWord, $uType, $salt)
{
    $time = date("Y-m-d H:i:s");
    $spWord = hash('ripemd128', "$salt$uName$pWord");
    $q = "INSERT INTO userData VALUES('$fName', '$lName', '$uName', '$spWord','$time','$time', '$uType')";
    $r = $con->query($q);
    if (!$r){
         die($con->error);
    }
}
