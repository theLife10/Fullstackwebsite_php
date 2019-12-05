<?php

include_once 'config.php';
session_start();
if(!isset($_POST['Order'])){
    header("Location:main.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Part To Sell</title>
</head>
<body style='background-color:lightgray;'>
<div align='center'><h1> AutoParts  </h1></div>
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
<div align='center'>
    <h4> To buy any part you must login first</h4>
    <a href="login.php" class="link"> Login </a>
    <a href="addCustomer.php" class="link">      Register </a>
    <div align='left'>
        <table id="myTable">
            <tr class="header">
                <th <strong>Part ID</strong></a></th>
                <th <strong>Part Name</strong></a></th>
                
                <th <strong>Price</strong></a></th>
            </tr>

            <p><b>Order By</b> </p>
            <form action="filter.php" method="post">
                <select name='value'>
                    <option value='Price'>Price</option>
                    <option value='PartName'>Part Name</option>
                    <option value='PartID'>Part ID</option>
                </select> <br>
                <input name="Order" type="submit" value="Order"><br>
            </form>

<?php
echo '<a href="main.php"> Go to Home </a>' ."<br>";
if (isset($_POST['Order']) == 'Part ID') {

    $q = "SELECT PartID, PartName, Price FROM carparts ORDER BY PartID";
}
if (isset($_POST['Order']) == 'Part Name'){

    $q = "SELECT PartID, PartName, Price FROM carparts ORDER BY PartName";
}
if (isset($_POST['Order']) == 'Price'){

    $q = "SELECT PartID, PartName, Price FROM carparts ORDER BY Price";
}

$r = $con->query($q);

if ($r->num_rows > 0) {
while ($row = $r->fetch_assoc()) {
?>
<tr>
    <td><?php echo $row['PartID'];?></td>
    <td><?php echo $row['PartName'];?></td>
   
    <td><?php echo $row['Price'];?></td>
</tr>

<?php }
}
else {
    echo "Testing";
}

?>
        </table>
    </div>
</div>
</html>