<?php

require_once 'credentials.php';
date_default_timezone_set('America/Denver');
session_start();

$con = new mysqli($hostname, $username, $password, $database);
print "                
    <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <title>Title</title>
        </head>
        <body style='background-color:lightgray;'>
";

if (isset($_POST['submission'])) {
    if (isset($_POST['fName']) && isset($_POST['lName']) && isset($_POST['uName']) && isset($_POST['pWord']) && isset($_POST['uType'])) {
        $fName = mysqli_real_escape_string($con, $_POST['fName']);
        $lName = mysqli_real_escape_string($con, $_POST['lName']);
        $uName = mysqli_real_escape_string($con, $_POST['uName']);
        $pWord = mysqli_real_escape_string($con, $_POST['pWord']);
        $uType = mysqli_real_escape_string($con, $_POST['uType']);
        $salt = "e4djuki9";
        if (!existingCustomer($con, $uName)) {
            print " 
                <div align='center'><h1> Succesfully Added User! </h1></div>
                <div align='center'>
                    <br>
                    <form action='addCustomer.php'>   
                    <button> Register Another User </button> 
                    </form>
                </div>
                <div align='center'> 
                    <br> 
                    <form action='admin.php'> 
                    <button> Admin Page </button> 
                    </form> 
                </div> 
                <div align='center'> 
                    <br> 
                    <form action='user.php'> 
                    <button> User Page </button> 
                    </form> 
                </div> 
                <div align='center'>
                    <br>
                    <form action='main.php'>   
                    <button> Main Page </button> 
                    </form>
                </div>
                
            ";
            if ($uType == "nUser") {
                addCustomer($con, $fName, $lName, $uName, $pWord, 1, $salt);
            } else {
                addCustomer($con, $fName, $lName, $uName, $pWord, 0, $salt);
            }
        } else {
            header("Location:addCustomer.php?error=2");
            exit();
        }
    } else {
        header("Location:addCustomer.php?error=1");
        exit();
    }
} else {

    print " 
                <!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <title>Title</title>
                </head>
                <body style='background-color:lightgray;'>
                <div align='center'><h1> Register User </h1></div>
                <div align='center'>
                    <form action='addCustomer.php ' method='POST'>
                        First name<br>
                        <input type='text' name='fName'>
                        <br> Last name<br>
                        <input type='text' name='lName'>
                        <br> Username<br>
                        <input type='text' name='uName'>
                        <br> Password<br>
                        <input type='password' name='pWord'> <br><br>
                        <input type='radio' name='uType' value='nUser'>Normal User
                        <input type='radio' name='uType' value='admin'>Admin
                        <br><br>
                        <input type='submit' value='Submit'>
                        <input type='hidden' name='submission' value='sA'>
                    </form>
                </div>
            ";

    if (isset($_GET['error'])) {
        if ($_GET['error'] == 1) {
            print "
                        <br>
                        <div align='center'>
                            Missing fields!
                        </div>
                    ";
        } else {
            print "
                        <br>
                        <div align='center'>
                            Username already in use!
                        </div>
                    ";
        }
    }

    print "
        <div align='center'>
            <br>
            <form action='main.php'>   
            <button> Main Page </button> 
            </form>
        </div>
        
        </form>
        </body>
        </html>
    ";
}



function existingCustomer($con, $uName)
{
    $q = "SELECT * FROM userData WHERE username= '$uName'";
    $r = $con->query($q);
    if (!$r) die($con->error);
    elseif ($r->num_rows) {
        $row = $result->fetch_array(MYSQLI_NUM);
        $r->close();
        if ($row[2] == $uName){ 
            return true; 
        }
        else return false;
    }
    return false;
}

function addCustomer($con, $fName, $lName, $uName, $pWord, $uType, $salt)
{
    $time = date("Y-m-d H:i:s");
    $spWord = hash('ripemd128', "$salt$uName$pWord");
    $q = "INSERT INTO userData VALUES('$fName', '$lName', '$uName', '$spWord','$time','$time', '$uType')";
    $r = $con->query($q);
    if (!$r) {
        die($con->error);
    }
}