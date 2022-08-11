<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php?reset" class="">Cars.lk</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <form class="navbar-form" action="" method="GET">
						<div class="form-group">
                            <?php
                                if(isset($_GET['keyword'])){
                                    $keyword = $_GET['keyword'];
                                }else{
                                    $keyword = "";
                                }
                            ?>
						    <input type="search" placeholder="Search" name="keyword" class="form-control" value="<?php echo $keyword ?>">
						</div>
						<button type="submit" name="search" class="btn btn-warning">Search</button>
                        <a href="" class="btn btn-success" data-toggle="modal" data-target="#filterModal">Filters</a>
					</form>
                </li>
                
                <li>
                    <a href="index.php?reset" class="custom-a">Home</a>
                </li>

                <?php
                    if (isset($_SESSION['admin_id'])) {
                        ?>
                            <li>
                                <a href="admin/home.php" class="custom-a">Admin</a>
                            </li>
                        <?php
                    }
                ?>

                
                <!-- <li>
                    <a href="admin">Admin</a>
                </li> -->
                <?php 
                    if (isset($_SESSION['user_email'])) {
                        $user_name = $_SESSION['username'];
                        ?>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" class="custom-a">
                                    <?php echo $user_name; ?>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    
                                    <?php
                                        $user_id = $_SESSION['user_id'];
                                        $query = "SELECT * FROM advertisments WHERE user_id = {$user_id}";
                                        $result = mysqli_query($connection, $query);
                                        $count = mysqli_num_rows($result);

                                        if ($count == 5){
                                            echo '<li><a tabindex="-1" href="user/index.php?interface=view_all_adds&post_limit=reach">Post an Ad</a></li>';
                                        }else{
                                            echo '<li><a tabindex="-1" href="user/index.php?interface=add_post">Post an Ad</a></li>';
                                        }
                                    ?>
                                    <li><a tabindex="-1" href="user/index.php?interface=profile">Profile</a></li>
                                    <li><a tabindex="-1" href="user/includes/logout.php">Logout</a></li>
                                </ul>
                            </li>
                        <?php
                    }else{
                        ?>
                            <li>
                                <a href="login.php" class="custom-a">Login</a>
                            </li>
                            <li>
                                <a href="register.php" class="custom-a">SignUp</a>
                            </li>
                        <?php
                    }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Choose your Filters</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                                <div class="form-group">
                                    Brand <br>
                                    <select name="brand" id="" class="form-control">
                                        <option value="">Select</option>
                                        <?php
                                            $query = "SELECT * FROM brands";
                                            $result = mysqli_query($connection, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $brand_id = $row['brand_id'];
                                                $brand_name = $row['brand_name'];
                                                echo "<option value='$brand_id'>$brand_name</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group form-inline">
                                    Price Range <br>
                                    <input type="text" name="min_price" class="form-control" placeholder="Min"> to <input class="form-control" name="max_price" placeholder="Max" type="text" name="" id="">
                                </div>
                                <div class="form-group form-inline">
                                    Year Range <br>
                                    <input type="text" name="min_year" class="form-control" placeholder="Min"> to <input class="form-control" placeholder="Max" type="text" name="max_year" id="">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            Province <br>
                                            <select name="province" id="province" class="form-control" required>
                                                <option value="Central">Central</option>
                                                <option value="Eastern">Eastern</option>
                                                <option value="North Central">North Central</option>
                                                <option value="Northern">Northern</option>
                                                <option value="North Western">North Western</option>
                                                <option value="Sabaragamuwa">Sabaragamuwa</option>
                                                <option value="Southern">Southern</option>
                                                <option value="Uva">Uva</option>
                                                <option value="Western">Western</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            District <br>
                                            <div id="display_area"></div>
                                            <select name="district" id="district" class="form-control" required>
                                                <option value='Kandy'>Kandy</option>
                                                <option value='Matale'>Matale</option>
                                                <option value='Nuwara Eliya'>Nuwara Eliya</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    Fuel Type <br>
                                    <select name="fuel_type" class="form-control" id="" >
                                        <option value="">Select</option>
                                        <option value="Petrol">Petrol</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Hybrid">Hybrid</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    Transmission <br>
                                    <select name="transmission" class="form-control" id="" >
                                        <option value="">Select</option>
                                        <option value="Auto">Auto</option>
                                        <option value="Manual">Manual</option>
                                    </select>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" type="submit" name="filt">Search</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>

<?php

if(isset($_POST['filt'])){
    $_SESSION['fake_set'] = 0;
    $_SESSION['fuel_type'] = $_POST['fuel_type'];
    $_SESSION['transmission'] = $_POST['transmission'];
    $_SESSION['brand'] = $_POST['brand'];
    $_SESSION['province'] = $_POST['province'];
    $_SESSION['district'] = $_POST['district'];
    $_SESSION['min_price'] = $_POST['min_price'];
    $_SESSION['max_price'] = $_POST['max_price'];
    $_SESSION['min_year'] = $_POST['min_year'];
    $_SESSION['max_year'] = $_POST['max_year'];
    
    header("Location: index.php");
}
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
        $("#province").on('change',function(){
        	var province = $("#province").val();
            console.log(province);
        	$.ajax({
        		url: "user/includes/ajax.php",
        		type: "POST",
        		async: false,
        		data: {
        			"display" : 1,
        			"province": province
        		},
        		success: function(data){
                    $("#district").remove();
        			$("#display_area").html(data);
        		}
        	})
        });
		
	});
	
</script>