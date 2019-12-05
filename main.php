<?php
include_once 'config.php';

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
</head>
<body style='background-color:white;'>

<style>
    th {
        cursor: pointer;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    .link {
        margin: 10px 10px 10px 10px;
        padding: 10px 10px 10px 10px;
    }
</style>
<div align='left'>
    <h3> Welcome</h3>
    <h4> Login First or create an account</h4>

    <button onclick = "window.location.href = 'addCustomer.php';">Register</button>
    <button onclick = "window.location.href = 'login.php';">Login</button>
    <div align='left'>

</div>

</html>
