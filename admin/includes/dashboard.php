<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">Dashboard</h4>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    <div class='huge'>
                    <?php
                        $query = "SELECT * FROM advertisments";
                        $result = mysqli_query($connection, $query);
                        echo mysqli_num_rows($result);
                    ?>
                    </div>
                        <div>Addvertisments</div>
                    </div>
                </div>
            </div>
            <a href="home.php?interface=view_all_ads">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                     <div class='huge'>
                     <?php
                        $query = "SELECT * FROM users";
                        $result = mysqli_query($connection, $query);
                        echo mysqli_num_rows($result);
                    ?>
                     </div>
                      <div>Users</div>
                    </div>
                </div>
            </div>
            <a href="home.php?interface=view_all_users">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'>
                        <?php
                            $query = "SELECT * FROM admin";
                            $result = mysqli_query($connection, $query);
                            echo mysqli_num_rows($result);
                        ?>
                        </div>
                         <div>Admins</div>
                    </div>
                </div>
            </div>
            <a href="home.php?interface=view_all_admins">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php
    if (isset($_SESSION['admin_id'])) {
        $admin_id = $_SESSION['admin_id'];
        $query = "SELECT * FROM admin WHERE admin_id = {$admin_id}";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
    }
?>
<div class="row">
    <div class="col-md-6">
        <div class="card-box">
            <h4 class="card-title">Profile</h4>
            <?php
                if (isset($_GET['admin_update'])) {
                    $msg = $_GET['admin_update'];
                    if ($msg == 'failed') {
                        echo "<div class='alert alert-danger' role='alert'>";
                        echo    "Update Failed. Try Again!";
                        echo "</div>";
                    }elseif ($msg == 'success') {
                        echo "<div class='alert alert-success' role='alert'>";
                        echo    "Admin Updated Successfully!.";
                        echo "</div>";
                    }
                }
            ?>
            <form action="" method="post">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">First Name</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="firstname" value="<?php echo $firstname?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Last Name</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="lastname" value="<?php echo $lastname?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Email Address</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control" name="email" value="<?php echo $email ?>">
                    </div>
                </div>
                
                <div class="text-right">
                    <button type="submit" class="btn btn-primary" name="save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    if (isset($_POST['save'])) {
        $admin_id = $_SESSION['admin_id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];

        $admin_id = mysqli_real_escape_string($connection, $admin_id);
        $firstname = mysqli_real_escape_string($connection, $firstname);
        $lastname = mysqli_real_escape_string($connection, $lastname);
        $email = mysqli_real_escape_string($connection, $email);

        $query = "UPDATE admin SET firstname = '{$firstname}', lastname = '{$lastname}', email = '{$email}' WHERE admin_id = {$admin_id}";
        $result = mysqli_query($connection, $query);

        if($result){
            header("Location: home.php?admin_update=success");
        }else{
            header("Location: home.php?admin_update=failed");
        }
    }
?>