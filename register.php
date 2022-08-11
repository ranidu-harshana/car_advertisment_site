<?php include "includes/db.php"; ?>
<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="css/login-css/bootstrap.min.css">
    <link href="user/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/login-css/style.css">
</head>

<body>
    <div class="main-wrapper  account-wrapper">
        <div class="account-page">
            <div class="account-center">
                <div class="account-box">
                    <form action="" class="form-signin" method="POST">
						<div class="account-logo">
                            <a href="index.php"><img src="images/avatar-login.png" alt=""></a>
                        </div>
                        <?php 
                            if (isset($_GET['user_added'])) {
                                $msg = $_GET['user_added'];
                                if ($msg == 'danger') {
                                    echo "<div class='alert alert-danger' role='alert'>";
                                    echo    "This username is already taken!.";
                                    echo "</div>";
                                }else if ($msg == 'mismatch') {
                                    echo "<div class='alert alert-warning' role='alert'>";
                                    echo    "Password Mismatch.";
                                    echo "</div>";
                                }else if ($msg == 'invalid_pass') {
                                    echo "<div class='alert alert-warning' role='alert'>";
                                    echo    "Password should not be shorter than 8 characters and should include atleast one numeric, uppercases letter and a lowercase letter";
                                    echo "</div>";
                                }else if ($msg == 'invalid_mail') {
                                    echo "<div class='alert alert-warning' role='alert'>";
                                    echo    "Invalid Email";
                                    echo "</div>";
                                }
                            }
                        ?>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" required autocomplete="off" onkeypress="validateName(event)" maxlength="20">
                            <p id='name_err' style="display:none"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Name Can contain only letters</p>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="something@example.com" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required autocomplete="off" onkeyup="passwordValidate()" id="pass">
                        </div>
                        <div id="pass_check" style="display:none" class="mt-1">
                            <p style="display:block">
                                <span id="inc_char12_0" style="display:none;" ><i class="fa fa-check-circle" aria-hidden="true"></i> Length must be more than 8 characters</span>
                                <span id="inc_char12_1" style="display:inline;color:red"><i  class="fa fa-times-circle" aria-hidden="true"></i> Length must be more than 8 characters</span> 
                            </p>
                            <p style="display:block;">
                                <span  id="inc_onenumber_0" style="display:none;"><i class="fa fa-check-circle" aria-hidden="true"></i> At least include one number</span>
                                <span  id="inc_onenumber_1" style="display:inline;color:red"><i class="fa fa-times-circle" aria-hidden="true"></i> At least include one number</span> 
                            </p>
                            <p style="display:block;">
                                <span  id="inc_lowercase_0" style="display:none;"><i class="fa fa-check-circle" aria-hidden="true"></i> At least include one Lowercase letter</span>
                                <span  id="inc_lowercase_1" style="display:inline;color:red"><i class="fa fa-times-circle" aria-hidden="true"></i> At least include one Lowercase letter</span> 
                            </p>
                            <p style="display:block;">
                                <span id="inc_uppercase_0" style="display:none;" ><i class="fa fa-check-circle" aria-hidden="true"></i> At least include one Uppercase letter</span>
                                <span  id="inc_uppercase_1" style="display:inline;color:red"><i class="fa fa-times-circle" aria-hidden="true"></i> At least include one Uppercase letter</span> 
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="cpassword" required autocomplete="off">
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary account-btn" type="submit" name="signup">Signup</button>
                        </div>
                        <div class="text-center login-link">
                            Already have an account? <a href="login.php">Login</a>
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
    if (isset($_POST['signup'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        if (!empty($name) && !empty($email) && !empty($password) && !empty($cpassword)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if ($password === $cpassword) {
                    if (strlen($password) > 8) {
                        if (preg_match("/[0-9]/", $password)) {
                            if (preg_match("/[A-Z]/", $password)) {
                                if (preg_match("/[a-z]/", $password)) {
                                    $username = mysqli_real_escape_string($connection, $name);
                                    $email = mysqli_real_escape_string($connection, $email);
                                    $password = mysqli_real_escape_string($connection, $password);

                                    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
                                    $insert_user = "INSERT INTO users(user_name, user_email, user_password) VALUES('{$name}', '{$email}', '{$password}')";
                                    $insert_user_query = mysqli_query($connection, $insert_user);
                                    if ($insert_user_query) {
                                        header("Location: login.php?user_add=success");
                                    }else {
                                        header("Location: register.php?user_added=danger");
                                    }
                                }else {
                                    header("Location: register.php?user_added=invalid_pass");
                                }
                            }else {
                                header("Location: register.php?user_added=invalid_pass");
                            }
                        }else {
                            header("Location: register.php?user_added=invalid_pass");
                        }
                    }else {
                        header("Location: register.php?user_added=invalid_pass");
                    }
                    
                }else{
                    header("Location: register.php?user_added=mismatch");
                }
            }else{
                header("Location: register.php?user_added=invalid_mail");
                exit();
            }
        }
    }
?>

<script src="user/js/signup.js"></script>