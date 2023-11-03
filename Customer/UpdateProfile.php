<?php
session_start();

if (isset($_SESSION['sesLogin']['btnLogin'])) {

    $email = $_SESSION['sesLogin']['txtEmail'];
    $pass = $_SESSION['sesLogin']['txtPass'];

    if (isset($_POST['btnUpdPro'])) {

        //    email
        if (!preg_match("/^[a-z][a-z0-9]+@(gmail|outlook|hotmail|yahoo|icloud)[.](com|in)$/", $email))
            echo "<script>alert('Email format is incorrect!');</script>";

        //    pass
        elseif (strlen($pass) < 5 || strlen($pass) > 8)
            echo "<script>alert('Length of Password should be between 5 to 8 characters!');</script>";

        else {
            require_once '../Database/DBConnection.php';
            $sql = "UPDATE Customer SET email = ?, password = ? WHERE email = '$email'";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $email, $md5Pass);
            $email = $_POST['txtEmail'];
            $pass = $_POST['txtPass'];
            $md5Pass = md5($pass);
            $stmt->execute();
            if ($stmt){
                $_SESSION['sesLogin']['txtEmail'] = $email;
                echo "<script>alert('Profile Updated Successful!');window.location.replace('./Homepage.php');</script>";
            }
            else
                echo "<script>alert('Profile not Updated!');</script>";
        }
    }
?>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>OSP</title>
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
            <a href="./CustLogout.php">Logout</a>
            <a href="./Homepage.php">Homepage</a>
        </h1>
        <hr>
        <form method="POST">
           <!-- Email input -->
            <div class="form-outline mb-3">
                <input type="text" name="txtEmail" class="form-control" required="" value="<?php echo $email ?>" <?php if (!isset($_POST['btnEdit'])) echo ' disabled'; ?> />
                <label class="form-label" for="form2Example1">Email Address</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
                <input type="password" name="txtPass" class="form-control" id="pass" required="" value="<?php echo $pass ?>" <?php if (!isset($_POST['btnEdit'])) echo ' disabled'; ?> onfocus="hideShowPassword()" onblur="hideShowPassword()" />
                <label class="form-label" for="form2Example2">Password</label>
            </div>

            <!-- Submit button -->
            <button type="submit" name="btnEdit" class="btn btn-primary btn-block mb-4" <?php if (isset($_POST['btnEdit'])) echo ' disabled'; ?>>Edit</button>
            <button type="submit" name="btnUpdPro" class="btn btn-primary btn-block mb-4" <?php if (!isset($_POST['btnEdit'])) echo ' disabled'; ?>>Update Profile</button>

        </form>

    </body>

    </html>
<?php
} else
    echo "Please <a href='./CustLogin.php'>Login</a> first!";
?>