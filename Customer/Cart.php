<?php
session_start();

if (isset($_SESSION['sesLogin']['btnLogin'])) {
	$cId = $_SESSION['sesLogUser']['cId'];

	if (isset($_POST['btnRFC'])) {
		// print_r($_POST);
		require_once '../Database/DBConnection.php';
		$sql = "DELETE FROM Cart WHERE ccId = ? AND csId = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('ii',$cId,$sId);
		$sId = $_POST['btnRFC'];
		$stmt->execute();
		if ($stmt)
			echo "<script>alert('Shoes removed from Cart!');window.location.replace('./Cart.php');</script>";
		else
			echo "<script>alert('Shoes notremoved from cart!');</script>";
	}

	if (isset($_POST['btnBuy'])) {
		// print_r($_POST);
		require_once '../Database/DBConnection.php';
		$sql = "INSERT INTO PurchasedShoes VALUES(?,?,?,?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('iiis',$cId,$sId,$quantity,$purchasedDate);
		$sId = $_POST['btnBuy'];
		// $quantity = ;
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
			<a href="./Homepage.php">Homepage</a>
		</h1>
		<hr>
		<h3 align='center'>Your Cart</h3>
		<form method="POST">
		<?php
		require_once '../Database/DBConnection.php';
		$output = "";
		$output .=  "<table cellspacing='30px' cellpadding='30px' align='center'><tr>";
		$sql = "SELECT * FROM Shoe S, Cart C
				WHERE sId = csId";
		$result = mysqli_query($conn,$sql);

		$sql2 = "SELECT SUM(price) AS 'total' FROM Shoe S, Cart C
				WHERE sId = csId";
		$result2 = mysqli_query($conn,$sql2);
		$row2 = $result2->fetch_assoc();
		
		$i = 1;
		$noOfItems = 0;
		if($result->num_rows > 0){
			$noOfItems = $result->num_rows;
			while($row = $result->fetch_assoc()){
				if($row['stock'] == 0)
					$status = " disabled";
				else
					$status = "";
					
				if(strlen($row['description']) > 40)
					$desc = substr($row['description'],0,39);
				else
					$desc = $row['description'];
					$output .=  "<td align='center' class='px-5'>".
					"<img src='../assets/images/" . $row['photo'] . "' width='150px' height='150px'><br>".
								$row['brand']."<br>".
								$desc."...<br>".
								$row['category']."<br>".
								$row['price']."<br>
								<button type='submit' name='btnRFC' value='".$row['sId']."'>Remove from Cart</button>
								<button type='submit' name='btnBuy' class='px-3' value='".$row['sId']."' ".$status.">Buy</button>
							</td>";
				if($i%4==0)
					$output .= "</tr><tr>";
				$i++;
			}
		}
		else
			$output = "No Shoes in cart!";
		
			$output .= "</table><br><br><center>Total No. of Items: <b>".$noOfItems."</b>";
			$output .= "<br><center>Total Amount: <b>".$row2['total']."</b>";
					
		echo $output;
		?>
		</form>
	</body>

	</html>
<?php
} else
    echo "Please <a href='./CustLogin.php'>Login</a> first!";
?>