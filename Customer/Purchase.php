<?php
session_start();

if (isset($_SESSION['sesLogin']['btnLogin'])) {
	$cId = $_SESSION['sesLogUser']['cId'];

	if (isset($_POST['btnBuy'])) {
		// print_r($_POST);
		require_once '../Database/DBConnection.php';
		$sql = "INSERT INTO PurchasedShoes VALUES(?,?,?,?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('iiis', $cId, $sId, $quantity, $purchasedDate);
		$sId = $_POST['btnBuy'];
		$quantity = $_POST['numQty'];
		$purchasedDate = date('Y-m-d h-i-s');
		$stmt->execute();
		if ($stmt)
			echo "<script>alert('Shoes purchased. It will be delivered to you on the day after tommorrow!');window.location.replace('./Homepage.php');</script>";
		else
			echo "<script>alert('Shoes not purchased!');</script>";
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
			a {
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
			<a href="./Homepage.php">Homepage</a>
		</h1>
		<hr>
		<!-- <h3 align='center'>List of Shoes</h3> -->
		<form method="POST">
			<?php
			require_once '../Database/DBConnection.php';
			$sql = "SELECT * FROM Shoe WHERE sId = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('i', $sId);
			$sId = $_SESSION['sesSId'];
			$stmt->execute();
			$result = $stmt->get_result();

			$output = "";
			$output .=  "<table cellspacing='30px' cellpadding='30px' align='center' id='result'><tr>";

			$row = $result->fetch_assoc();
			$output .=  "<td align='center' class='px-5'>
							<img src='../assets/images/" . $row['photo'] . "' width='150px' height='150px'></td><td>" .
							"Brand: " . $row['brand'] . "<br>" .
							"Description: " . $row['description'] . "<br>" .
							"Category: " . $row['category'] . "<br>" .
							"Price: " . $row['price'] . "<br>" .
							"Available Stock: " . $row['stock'] . 
						"</td></tr></table>";
			echo $output;
			?>
			<center>
				Quantity: <input type="number" name="numQty"  class="m-3" value="1" required style="width: 10%;"/><br>
				<!-- Total Amt. to be Paid: <b><span name="" id="total" class="m-3"></span></b><br> -->
				<button type='submit' name='btnBuy' class='px-5 py-2' value=' <?php echo $row['sId']; ?>'>Buy</button>
			</center>
		</form>
	</body>
	</html>
<?php
} else
	echo "Please <a href='./CustLogin.php'>Login</a> first!";
?>