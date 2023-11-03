<?php
session_start();

if (isset($_SESSION['sesLogin']['btnLogin'])) {

    $sId = $_SESSION['sesShoeId'];

    require_once '../Database/DBConnection.php';
    $sql = "SELECT * FROM Shoe WHERE sId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $sId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // echo "<pre>";
        // print_r($row);
        // echo "</pre>";

        $brand = $row['brand'];
        $description = $row['description'];
        $category = $row['category'];
        $photo = $row['photo'];
        $price = $row['price'];
        $stock = $row['stock'];
    }

	if(isset($_POST['btnUpd'])){
		//    validations
        //    brand
        // if (!preg_match('/^[A-Z][a-z]{1,24}$/', $brand))
        //     echo "<script>alert('First character of brand name should be capital & length should be between 2-25 characters!');</script>";

		// echo "<pre>";
		// print_r($_FILES);
		// echo "</pre>";

		// if(!isset($_FILES['filePhoto']))
		// 	echo "<script>alert('Please upload the photo of shoes!');</script>";
		$fileName = $_FILES['filePhoto']['name'];
		$fileTmpName = $_FILES['filePhoto']['tmp_name'];
		$fileType = $_FILES['filePhoto']['type'];
		$fileSize = $_FILES['filePhoto']['size'];
		if($fileSize > 2097152)
			echo "<script>alert('Please upload the photo of less than or equal to 2 MB!');</script>";
		elseif($fileType != "image/jpeg")
			echo "<script>alert('Please upload the photo of type JPEG!');</script>";
		else{
			require_once '../Database/DBConnection.php';
            $sql = "UPDATE Shoe SET brand = ?, description = ?, category = ?, photo = ?, price = ?, stock = ? WHERE sId = '$sId'";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssii', $brand,$description,$category,$fileName,$price,$stock);
            $brand = $_POST['txtBrand'];
			$description = $_POST['txtaDescription'];
			$category = $_POST['selCategory'];
			$price = $_POST['txtPrice'];
			$stock = $_POST['txtStock'];
            $stmt->execute();
			if ($stmt){
				echo "<script>alert('Shoes updated Successful!');window.location.replace('./Dashboard.php');</script>";
				$dir = "../assets/images/".$fileName;
				move_uploaded_file($fileTmpName,$dir);
			}
			else
				echo "<script>alert('Shoes not updated!');</script>";
		}
    }
	?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>OSP Insert</title>
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="../assets/style.css">
        <style>
            a {
                font-size: 25px;
                float: right;
                padding-right: 30px;
                padding-top: 15px;
                text-decoration: none;
            }
        </style>
        <script>
            function hideShowPassword() {
                var pass = document.getElementById("pass");
                if (pass.type === "password")
                    pass.type = "text";
                else
                    pass.type = "password";
            }
        </script>
    </head>

    <body>
        <h1>
            &emsp;OSP
            <a href="../Logout.php">Logout</a>
            <a href="./Dashboard.php">Homepage</a>
        </h1>
        <hr>
        <form method="POST" enctype="multipart/form-data">
            <!-- Brand input -->
            <div class="form-outline mb-3">
                <input type="text" name="txtBrand" class="form-control" required="" value="<?php echo $brand ?>" <?php if (!isset($_POST['btnEdit'])) echo ' disabled'; ?> />
                <label class="form-label" for="form2Example1">Brand</label>
            </div>

            <!-- Description input -->
            <div class="form-outline mb-3">
                <textarea name="txtaDescription" class="form-control" required="" rows="3" cols="20" <?php if (!isset($_POST['btnEdit'])) echo ' disabled'; ?> ><?php echo $description ?></textarea>
                <label class="form-label" for="form2Example1">Description</label>
            </div>

            <!-- Category input -->
            <div class="form-outline mb-3">
				<select name="selCategory" class="form-control" required="" <?php if (!isset($_POST['btnEdit'])) echo ' disabled'; ?> >
					<option hidden>-- Select --</option>
					<option value="Running" <?php if($category == "Running") echo " selected" ?>>Running</option>
					<option value="Casual" <?php if($category == "Casual") echo " selected" ?>>Casual</option>
					<option value="Sports" <?php if($category == "Sports") echo " selected" ?>>Sports</option>
				</select>
                <label class="form-label" for="form2Example1">Category</label>
            </div>

			<!-- Photo input -->
            <div class="form-outline mb-3">
                <input type="file" name="filePhoto" class="form-control" required="" value="<?php echo $photo ?>" <?php if (!isset($_POST['btnEdit'])) echo ' disabled'; ?> />
                <label class="form-label" for="form2Example1">Photo</label>
            </div>

			<!-- Price input -->
            <div class="form-outline mb-3">
                <input type="text" name="txtPrice" class="form-control" required="" value="<?php echo $price ?>" <?php if (!isset($_POST['btnEdit'])) echo ' disabled'; ?> />
                <label class="form-label" for="form2Example1">Price</label>
            </div>

			<!-- Stock input -->
            <div class="form-outline mb-3">
                <input type="text" name="txtStock" class="form-control" required="" value="<?php echo $stock ?>" <?php if (!isset($_POST['btnEdit'])) echo ' disabled'; ?> />
                <label class="form-label" for="form2Example1">Stock</label>
            </div>

            <!-- Submit button -->
            <button type="submit" name="btnEdit" class="btn btn-primary btn-block mb-4" <?php if (isset($_POST['btnEdit'])) echo ' disabled'; ?>>Edit</button>
            <button type="submit" name="btnUpd" class="btn btn-primary btn-block mb-4" <?php if (!isset($_POST['btnEdit'])) echo ' disabled'; ?>>Update Profile</button>
        </form>
    </body>
    </html>
<?php
} else
    echo "Please <a href='./AdminLogin.php'>Login</a> first!";
?>