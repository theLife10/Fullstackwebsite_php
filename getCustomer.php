<?php

require_once 'credentials.php';
date_default_timezone_set('America/Denver');

$con = new mysqli($hostname, $username, $password, $database);

if (isset($_POST['uName']) && isset($_POST['pWord'])) {
    $uName = mysqli_real_escape_string($con, $_POST['uName']);
    $pWord = mysqli_real_escape_string($con, $_POST['pWord']);
    if (existingCustomer($con, $uName) && verifyCustomer($con, $uName, $pWord)) {
        header("Location:sucessfullogin.php");
        exit();
    } 
    else {
        header("Location:login.php?error=1");
        exit();
    }
} 
else {
    header("Location:login.php?error=1");
    exit();
}

function existingCustomer($con, $uName)
{
    $q = "SELECT * FROM userData WHERE username= '$uName'";
    $r = $con->query($q);
    if (!$r) {
        die($con->error); 
    }
    elseif ($r->num_rows) {
        $row = $r->fetch_array(MYSQLI_NUM);
        $r->close();
        if ($row[2] == $uName){ 
            return true;
        }
        else return false;
    }
    return false;
}

function verifyCustomer($con, $uName, $pWord)
{
    $time = date("Y-m-d H:i:s");
    $q = "SELECT * FROM userData WHERE username= '$uName'";
    $r = $con->query($q);
    if (!$r) {
        die($con->error); 
    }
    elseif ($r->num_rows) {
        $s = "e4djuki9";
        $row = $r->fetch_array(MYSQLI_NUM);
        $r->close();
        $spWord = $row[3];
        if ($spWord == hash('ripemd128', "$s$uName$pWord")) {
            $q = "UPDATE userData SET lastLogin='$time' WHERE username= '$uName'";
            $result = $con->query($q);
            if (!$r){ 
                die($con->error);
            }
            session_start();
            $_SESSION['uName'] = $uName;
            $_SESSION['fName'] = $row[0];
            $_SESSION['lName'] = $row[1];
            $_SESSION['aTime'] = $row[4];
            $_SESSION['lTime'] = $row[5];
            $_SESSION['uType'] = $row[6];
            return true;
        } 
        else {
            return false;
        }
    }
    return false;
}
