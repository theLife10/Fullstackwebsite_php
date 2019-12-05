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
            <form action='changeAddress.php' method='post' >   
                <input type='submit' name='chAdr' value='Change Address'> 
            </form>               
        </div>
        
        <div align='center'>
            <br>
            <form action='changePassword.php' method='post' >   
                <input type='submit' name='chPass' value='Change Password'> 
            </form>  
        </div>
        
        <div align='center'>
            <br>
            <form action='logout.php' method='post' >   
                <input type='submit' name='vOrd' value='View Past Orders'> 
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
        printUserAddress($uName);
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

function printUserAddress($uName)
{
    global $con;
    $query = "SELECT * FROM userAddress WHERE username= '$uName'";
    $r = $con->query($query);
    print " <table  style=\"width:75%\">
            <tr>
                <th>Address Line</th>
                <th>City</th> 
                <th>State</th>
                <th>Country</th>
                <th>Postal</th>
            </tr>
    ";
    $rows = $r->num_rows;
    for ($i = 0; $i < $rows; ++$i) {
        print '<tr style="text-align:center;">';
        $r->data_seek($i);
        echo '<td >' . $r->fetch_assoc()['address'] . '</td>';
        $r->data_seek($i);
        echo '<td >' . $r->fetch_assoc()['city'] . '</td>';
        $r->data_seek($i);
        echo '<td >' . $r->fetch_assoc()['state'] . '</td>';
        $r->data_seek($i);
        echo '<td >' . $r->fetch_assoc()['country'] . '</td>';
        $r->data_seek($i);
        echo '<td >' . $r->fetch_assoc()['postal'] . '</td>';
        print '</tr><br>';

    }
    print "</table>";
}