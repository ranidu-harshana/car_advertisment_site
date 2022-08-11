<?php include "includes/db.php"; ?>
<?php ob_start(); ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>User Login</title>
    <link rel="stylesheet" type="text/css" href="css/login-css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login-css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/login-css/style.css">
</head>

<body>
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
			<div class="account-center">
				<div class="account-box">
                    <form action="" class="form-signin" method="POST">
						<div class="account-logo">
                            <a href="index.php"><img src="images/avatar-login.png" alt=""></a>
                        </div>
                        <?php 
                            if (isset($_GET['user_add'])) {
                                $msg = $_GET['user_add'];
                                if ($msg == 'success') {
                                    echo "<div class='alert alert-success' role='alert'>";
                                    echo    "You have registered Successfully!. Login Here";
                                    echo "</div>";
                                }elseif ($msg == 'wrong_credentials') {
                                    echo "<div class='alert alert-danger' role='alert'>";
                                    echo    "Username or Password is incorrect. Try Again!";
                                    echo "</div>";
                                }
                            }
                        ?>
                        
                        <div class="form-group">
                            <label>Username(Email)</label>
                            <input type="email" autofocus="" class="form-control" required name="username" placeholder="something@example.com" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary account-btn" name="login">Login</button>
                        </div>
                        <div class="text-center register-link">
                            Don’t have an account? <a href="register.php">Register Now</a>
                        </div>
                        <div class="text-center register-link">
                            <a href="index.php">Home</a>
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
		$username = $_POST['username'];
		$password = $_POST['password'];

		$username = mysqli_real_escape_string($connection, $username);
		$password = mysqli_real_escape_string($connection, $password);

		$query = "SELECT * FROM users WHERE user_email = '{$username}'";
		$result = mysqli_query($connection, $query);

		if (!$result) {
			header("Location: login.php?user_add=wrong_credentials");
		}else if(mysqli_num_rows($result) > 0){
			while ($row = mysqli_fetch_assoc($result)) {
				$db_user_id = $row['user_id'];
				$db_username = $row['user_name'];
				$db_user_email = $row['user_email'];
				$db_user_password = $row['user_password'];

			}

			if($username === $db_user_email && password_verify($password, $db_user_password)){
				$_SESSION['user_id'] = $db_user_id;
				$_SESSION['username'] = $db_username;
                $_SESSION['user_email'] = $db_user_email;

				header("Location: index.php");
			}else{
				header("Location: login.php?user_add=wrong_credentials");
			}
		}else{
            header("Location: login.php?user_add=wrong_credentials");
        }
	}
?>