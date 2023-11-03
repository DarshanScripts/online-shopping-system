<?php
session_start();

if (isset($_SESSION['sesLogin']['btnLogin'])) {
	$cId = $_SESSION['sesLogUser']['cId'];

	if (isset($_POST['btnATC'])) {
		// print_r($_POST);
		require_once '../Database/DBConnection.php';
		$sql = "INSERT INTO Cart VALUES(?,?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('ii',$cId,$sId);
		$sId = $_POST['btnATC'];
		$stmt->execute();
		if ($stmt)
			echo "<script>alert('Shoes is added to Cart!');window.location.replace('./Homepage.php');</script>";
		else
			echo "<script>alert('Shoes not added to cart!');</script>";
	}

	if (isset($_POST['btnBuy'])) {
		$_SESSION['sesSId'] = $_POST['btnBuy'];
		header('location:Purchase.php');
	}
	?>

	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="UTF-8">
		<title>OSP</title>
		<!-- <link rel="stylesheet" href="../assets/style.css"> -->
		<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
		<style>
			a{
				font-size: 25px;
				float: right;
				padding-right: 40px;
				padding-top: 15px;
			}
		</style>
	</head>

	<body>
		<h1>
			&emsp;OSP
			<a href="./CustLogout.php">Logout</a>
			<a href="./UpdateProfile.php">Update Profile</a>
			<a href="./Cart.php">Go to Cart</a>
			<input type="text" id="search" placeholder="Search..." style="float:right; width:20%" class="form-control mt-3 mx-4">
		</h1>
		<hr>
		<h3 align='center'>List of Shoes</h3>
		<form method="POST">
		<?php
		require_once '../Database/DBConnection.php';
		$output = "";
		$output .=  "<table cellspacing='30px' cellpadding='30px' align='center' id='result'><tr>";
		$sql = "SELECT * FROM Shoe";
		$result = mysqli_query($conn,$sql);

		$i = 1;
		while($row = $result->fetch_assoc()){
			if($row['stock'] == 0)
				$status = " disabled";
			else
				$status = "";

			$sql2 = "SELECT * FROM Cart WHERE ccId = ? AND csId = ?";
			$stmt = $conn->prepare($sql2);
			$stmt->bind_param('ii',$cId,$sId);
			$sId = $row['sId'];
			$stmt->execute();
			$result2 = $stmt->get_result();

			if($result2->num_rows > 0)
				$cartStatus = " disabled";
			else
				$cartStatus = "";
				
			if(strlen($row['description']) > 40)
				$desc = substr($row['description'],0,39);
			else
				$desc = $row['description'];
				$output .=  "<td align='center' class='px-5'>
							<img src='../assets/images/".$row['photo']."' width='150px' height='150px'><br>".
							$row['brand']."<br>".
							$desc."...<br>".
							$row['category']."<br>".
							$row['price']."<br>
							<button type='submit' name='btnATC' value='".$row['sId']."' ".$cartStatus.">Add to Cart</button>
							<button type='submit' name='btnBuy' class='px-3' value='".$row['sId']."' ".$status.">Buy</button>
						</td>";
			if($i%4==0)
				$output .= "</tr><tr>";
			$i++;
		}
		echo $output;
		?>
		</form>

		<script src="../assets/jquery-3.2.1.min.js"></script>
		<script>
			$(document).ready(function(){
				$("#search").keyup(function(){
					var input = $(this).val();
					$.ajax({
						url: "./FetchShoes.php",
						type: "POST",
						data: {
							"name": input
						},
						success: function(data){
							$("#result").html(data);
						}
					});
				});
			});
		</script>
	</body>

	</html>
<?php
} else
    echo "Please <a href='./CustLogin.php'>Login</a> first!";
?>