<?php
include_once 'config.php';
session_start()
?>

<!DOCTYPE html>
<html>
<head>
</head>
<button onclick = "window.location.href = 'main.php';">Logout</button>
<p><b>Order By</b> </p>
<form action="filter.php" method="post">
    <select name='value'>
        <option value='PartID'>PartID</option>
        <option value='Price,'>Part Price,</option>
        <option value='Estimated Shipping Cost'>Estimated Shipping Cost ID</option>
        <option value='Shipping Weight.'>Shipping Weight.</option>
    </select> <br>



</form>
<style>
    th {
        cursor: pointer;
    }
    table, th, td {
        border: 1px solid white;
        border-collapse: collapse;
    }

</style>


<table id="myTable"> <!-- width="70%" cellpadding="5" cellspace="5"-->
    <tr>
        <th> <strong>Part ID</strong></th>
        <th> <strong> Part Name</strong></th>
        <th> <strong>Price</strong></th>
    </tr>

    <?php
    $sql = "SELECT PartID, PartName, Price FROM carparts";
    $result = $conn2->query($sql);
    if ($result->num_rows > 0 ){
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['PartID'];?></td>
                <td><?php echo $row['PartName'];?></td>

                <td><?php echo $row['Price'];?></td>
            </tr>

        <?php }
    }
    else {
        echo "NO PARTS TO SELL";
    }?>
</table>
</div>
</div>

</html>
