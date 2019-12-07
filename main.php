<?php
include_once 'config.php';

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.18/sl-1.2.6/datatables.min.js"></script>
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
<?php
$con=mysqli_connect("cssrvlab01.utep.edu","jdgarcia9","*utep2020!","jdgarcia9_f19_db");

if (mysqli_connect_errno())
{
	echo "Failed Connection: " . mysqli_connect_error();
}

?>

<div class = "container">
		<table id="table" class="table table-striped table-bordered table-hover" style="width:100%">
			<thead>
				<tr>
					<th>PartName</th>
                    <th>Category</th>
                    <th>Description</th>
					
					
				</tr>
			</thead>
			<tbody>
				<?php
				$r = mysqli_query($con,"SELECT PartName,Category,Description01 FROM carparts");
				if(mysqli_num_rows($r) >0){
					while($row = mysqli_fetch_array($r)){
						$style = '';
						$class='';
						echo " 
                        <tr>
                        <td>".$row['PartName']."</td>
						<td>".$row['Category']."</td>
                        <td>".$row['Description01']."</td>
						</tr>";
                    } 
                }
                else
                {
						echo "0 results";
                } 
                    ?>
				</tbody>
			</table>
			<script>
				$(document).ready( function () {
					$('#table').DataTable();
				} );
			</script>
			<?php 
			mysqli_close($con);
			?>
		</div>

</html>
