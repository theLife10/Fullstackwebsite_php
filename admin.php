<?php

require_once 'credentials.php';
session_start();

print "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <title>Admin</title>
    </head>
    <style>
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        }
        th, td {
        padding: 15px;
        }
    </style>
    <body style='background-color:lightgray;'>
    
";

if (isset($_SESSION['uName'])) {
    $uName = $_SESSION['uName'];
    $uType = $_SESSION['uType'];
    if ($uType == 0) {
        print "
            <div 
                align='center'><h1> Admin </h1></div>
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
                <form action='addCustomer.php' method='post' >   
                    <input type='submit' name='addCustomer' value='Add User'> 
                </form>
            </div>
            
            <div align='center'>
                <br>
                <form action='deleteCustomer.php' method='post' >   
                    <input type='submit' name='delUser' value='Delete User'> 
                </form>
            </div>
            
            <div align='center'>
                <br>
                <form action='changePasswordAdmin.php' method='post' >   
                    <input type='submit' name='chPass' value='Change User Password'> 
                </form>
            </div>
            
            <div align='center'>
                <br>
                <form action='changeAddressAdmin.php' method='post' >   
                    <input type='submit' name='chUA' value='Change User Address'> 
                </form>
            </div>
            
            <div align='center'>
                <br>
                <form action='deleteAddress.php' method='post' >   
                    <input type='submit' name='delAdd' value='Delete Address'> 
                </form>
            </div>
            
            <div align='center'>
                <br>
                <form action='admin.php' method='post' >   
                    <input type='submit' name='sUsers' value='Show Registered Users'> 
                </form>
            </div>
            
            <div align='center'> 
                <br>
                <form action='user.php'>   
                    <button> User Page </button> 
                </form>
            </div>
        ";
    } else {
        print "
            <div align='center'>
                Not authorized to access this webpage!
            </div>
        ";
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
        <form action='mainpage.php'>   
            <button> Main Page </button> 
        </form>
    </div>
    </div>
    </body>
    </html>
";

if (isset($_POST['sUsers']) && $_POST['sUsers'] == 'Show Registered Users') {
    printUserts();
}

function printUsers()
{
    global $database, $hostname, $password, $username;
    $con = new mysqli($hostname, $username, $password, $database);
    $q = "SELECT * FROM userData";
    $r = $con->query($q);
    print " <table  style=\"width:100%\">
            <tr>
                <th>First Name</th>
                <th>Last Name</th> 
                <th>Username</th>
                <th>Account Creation</th>
                <th>Last Login</th>
                <th>Account Type</th>
            </tr>
    ";
    $rows = $r->num_rows;
    for ($i = 0; $i < $rows; ++$i) {
        print '<tr style="text-align:center;">';
        $r->data_seek($i);
        echo '<td >' . $r->fetch_assoc()['firstName'] . '</td>';
        $r->data_seek($i);
        echo '<td >' . $r->fetch_assoc()['lastName'] . '</td>';
        $r->data_seek($i);
        echo '<td >' . $r->fetch_assoc()['username'] . '</td>';
        $r->data_seek($i);
        echo '<td >' . $r->fetch_assoc()['accTime'] . '</td>';
        $r->data_seek($i);
        echo '<td >' . $r->fetch_assoc()['lastLogin'] . '</td>';
        $r->data_seek($i);
        if ($r->fetch_assoc()['userType']) {
            echo '<td > Normal </td>';
        } 
        else {
            echo '<td > Administrator </td>';
        }
        print '</tr><br>';

    }
    print "</table>";
}
