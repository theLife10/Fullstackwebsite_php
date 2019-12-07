<?php

require_once 'credentials.php';
session_start();

$con = new mysqli($hostname, $username, $password, $database);

print "
    <!DOCTYPE html>
    <html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\">
        <title>Users Page</title>
    </head>
    <body style=\"background-color:lightgray;\">
    
";

if (isset($_SESSION['uName'])) {
    $uName = $_SESSION['uName'];
    print "
        <div 
            align='center'><h1> Users Page </h1></div>
        <div>

        <div align='center'>
            Logged in as: $uName
            <br> <br>
            <form action='logout.php' method='post' >   
                <input type='submit' name='Logout' value='Logout'> 
            </form>               
        </div>
        
        
        
        
        
        
        
        
        
        <div align='center'>
            <br>
            <form action='user.php' method='post' >   
                <input type='submit' name='uInfo' value='View User Data'> 
            </form>               
        </div>
        
    ";
    if (isset($_POST['uInfo'])) {
        printUserData();
       
    }
} else {
    print "
        <div align='center'>
            Not authorized to access this webpage!
        </div>
    ";
}

print "
    <div align='center'> 
        <br>
        <form action='main.php'>   
            <button> Main Page </button> 
        </form>
    </div>
    </div>
    </body>
    </html>
";

function printUserData()
{
    print "
        <div align='center'>
            <br> First Name: " . $_SESSION['fName'] . "<br><br>
            Last Name: " . $_SESSION['lName'] . "<br><br>
            Account Creation Date: " . $_SESSION['aTime'] . "<br><br>
            Last Login: " . $_SESSION['lTime'] . "<br>
        </div>";
}

