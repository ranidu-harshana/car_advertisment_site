<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">Create New Admin</h4>
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
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card-box">
            <h4 class="card-title">Create Admin - Form</h4>
            <form action="" method="post">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">First Name</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="firstname">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Last Name</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="lastname">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Email Address</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control" name="email">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Password</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="password" onkeyup="passwordValidate()" id="pass">
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
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Repeat Password</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="cpassword">
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    if (isset($_POST['submit'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password) && !empty($cpassword)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if ($password === $cpassword) {
                    if (strlen($password) > 8) {
                        if (preg_match("/[0-9]/", $password)) {
                            if (preg_match("/[A-Z]/", $password)) {
                                if (preg_match("/[a-z]/", $password)) {
                                    $firstname = mysqli_real_escape_string($connection, $firstname);
                                    $lastname = mysqli_real_escape_string($connection, $lastname);
                                    $email = mysqli_real_escape_string($connection, $email);
                                    $password = mysqli_real_escape_string($connection, $password);

                                    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
                                    $insert_admin = "INSERT INTO admin(firstname, lastname, email, password) VALUES('{$firstname}', '{$lastname}', '{$email}', '{$password}')";
                                    $insert_admin_query = mysqli_query($connection, $insert_admin);
                                    if ($insert_admin_query) {
                                        header("Location: home.php?interface=view_all_admins&user_add=success");
                                    }else {
                                        header("Location: home.php?interface=add_new_admin&user_added=danger");
                                    }
                                }else {
                                    header("Location: home.php?interface=add_new_admin&user_added=invalid_pass");
                                }
                            }else {
                                header("Location: home.php?interface=add_new_admin&user_added=invalid_pass");
                            }
                        }else {
                            header("Location: home.php?interface=add_new_admin&user_added=invalid_pass");
                        }
                    }else {
                        header("Location: home.php?interface=add_new_admin&user_added=invalid_pass");
                    }
                    
                }else{
                    header("Location: home.php?interface=add_new_admin&user_added=mismatch");
                }
            }else{
                header("Location: home.php?interface=add_new_admin&user_added=invalid_mail");
                exit();
            }
        }
    }
?>

<script src="../user/js/signup.js"></script>