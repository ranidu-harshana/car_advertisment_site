<h1 class="h3 mb-4 text-gray-800">User Profile</h1>
<div class="row">
    <div class="col-md-6">
        <?php
            if(isset($_SESSION['user_id'])){
                $user_id = $_SESSION['user_id'];
                $query = "SELECT * FROM users WHERE user_id = {$user_id}";
                $result = mysqli_query($connection, $query);
                $row = mysqli_fetch_assoc($result);
                $user_name = $row['user_name'];
                $user_email = $row['user_email'];
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="user_name" id="" class="form-control" value="<?php echo $user_name ?>" onkeypress="validateName(event)" maxlength="20">
                <p id='name_err' style="display:none"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Name Can contain only letters</p>
            </div>

            <div class="form-group">
                <label for="user_email">Email (Username)</label>
                <input type="email" name="user_email" id="" class="form-control" value="<?php echo $user_email ?>">
            </div>

            <div class="form-group">
                <form action="" method="post">
                    <input type="submit" value="Save" class="btn btn-success" name="save">
                </form>
            </div>
        </form>
    </div>

</div>

<?php updateProfile(); ?>
<script src="js/signup.js"></script>