<?php ob_start(); ?>
<?php session_start(); ?>
<?php include('../includes/db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    
</head>

<body>
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
			<div class="account-center">
				<div class="account-box">
                    <form action="" method="post" class="form-signin">
						<div class="account-logo">
                            <a href="../index.php"><img src="../images/avatar-login.png" alt=""></a>
                        </div>

                        <?php 
                            if (isset($_GET['admin_add'])) {
                                $msg = $_GET['admin_add'];
                                if ($msg == 'wrong_credentials') {
                                    echo "<div class='alert alert-danger' role='alert'>";
                                    echo    "Username or Password is incorrect. Try Again!";
                                    echo "</div>";
                                }elseif ($msg == 'success') {
                                    echo "<div class='alert alert-success' role='alert'>";
                                    echo    "You have registered Successfully!. Login Here";
                                    echo "</div>";
                                }
                            }
                        ?>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" autofocus="" class="form-control" name="email" placeholder="something@example.com">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                       
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary account-btn" name="login">Login</button>
                        </div>
                        
                    </form>
                </div>
			</div>
        </div>
    </div>

</body>
</html>

<?php
	if (isset($_POST['login'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];

		$email = mysqli_real_escape_string($connection, $email);
		$password = mysqli_real_escape_string($connection, $password);

		$query = "SELECT * FROM admin WHERE email = '{$email}'";
		$result = mysqli_query($connection, $query);

		if (!$result) {
			header("Location: index.php?admin_add=wrong_credentials");
		}else if(mysqli_num_rows($result) > 0){
			while ($row = mysqli_fetch_assoc($result)) {
				$db_admin_id = $row['admin_id'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
				$db_email = $row['email'];

				$db_admin_password = $row['password'];
			}

			if($email === $db_email && password_verify($password, $db_admin_password)){
				$_SESSION['admin_id'] = $db_admin_id;
				$_SESSION['email'] = $db_email;
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['name'] = $firstname . " " . $lastname;

				header("Location: home.php");
			}else{
				header("Location: index.php?admin_add=wrong_credentials");
			}
		}else{
            header("Location: index.php?admin_add=wrong_credentials");
        }
	}
?>