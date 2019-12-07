<?php

session_start();

$con=mysqli_connect("cssrvlab01.utep.edu","jdgarcia9","*utep2020!","jdgarcia9_f19_db");
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


if($_SERVER["REQUEST_METHOD"] == "POST") {

	$price = mysqli_real_escape_string($con,$_POST['Price']);
	$name = mysqli_real_escape_string($con,$_POST['PartName']);
    $partId = mysqli_real_escape_string($con,$_POST['PartId']);
	$sql = "UPDATE carparts SET Price = '$Price', PartName = '$name' WHERE PartID = '$partId'";
	if ($con->query($sql) === TRUE) {
	} else {
		$error=  $sql . "<br>" . $con->error;
	}
}
?>

<html>
<head>
	

</head>

<body >
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item ">
					<a class="nav-link" href="sucessfullogin.php">Home <span class="sr-only"></span></a>
				</li>
				<li class="nav-item active">
					<a class="nav-link active" href="editEntry.php">Edit</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="signout.php">Log out</a>
				</li>
			</ul>

		</div>
	</nav>

	<div class="container" style="padding-top: 10px">
		<?php echo"<h1>Edit Item: " .$loggenOnUser. "</h1> <br>"; ?>
		<form method="post">
			<div class="form-group">
				<label for="exampleFormControlInput1">Name</label>
				<input type="Text" class="form-control" id = "text" >
			</div>
			<div class="form-group">
				<label for="exampleFormControlTextarea1">Part Id</label>
				<input type="number" class="form-control" id="number" >
			</div>
            <div class="form-group">
				<label for="exampleFormControlTextarea1">Price</label>
				<input type="number" class="form-control" id="number" >
			</div>
			<input type="submit" class="btn btn-primary" name="Submit">
		</form>
	</div>
</body>

</html>