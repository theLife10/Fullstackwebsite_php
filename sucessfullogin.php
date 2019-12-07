<html>
<head>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/> 
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.18/sl-1.2.6/datatables.min.js"></script> 

</head>



<?php
$con=mysqli_connect("cssrvlab01.utep.edu","jdgarcia9","*utep2020!","jdgarcia9_f19_db");

if (mysqli_connect_errno())
{
	echo "Failed Connection: " . mysqli_connect_error();
}

?>



<body >
	<nav class="navbar navbar-expand-sm navbar-light bg-light">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="sucessfullogin.php">Home <span class="sr-only"></span></a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="editEntry.php">Edit</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php">Log out</a>
				</li>
				
			</ul>

		</div>
	</nav>
	<div>
		<h1 style="text-align: center; font-size: 100"></h1>
	</div>
	<div class = "container">
		<table id="table" class="table table-striped table-bordered table-hover" style="width:100%">
			<thead>
				<tr>
					<th>PartID</th>
					<th>PartName</th>
					<th>Price</th>
					<th>Estimated Shipping Cost</th>
					<th>Shipping Weight</th>
					
				</tr>
			</thead>
			<tbody>
				<?php
				$r = mysqli_query($con,"SELECT PartID,PartName, Price, `Estimated Shipping Cost` , `Shipping Weight` FROM carparts");
				if(mysqli_num_rows($r) >0){
					while($row = mysqli_fetch_array($r)){
						$style = '';
						$class='';

						echo " 
                        <tr>
                        <td>".$row['PartID']."</td>
						<td>".$row['PartName']."</td>
                        <td>".$row['Price']."</td>
						<td>".$row['Estimated Shipping Cost']."</td>
						<td>".$row['Shipping Weight']."</td>
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
	</body>
	</html>
