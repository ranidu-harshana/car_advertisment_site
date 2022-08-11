<?php 
    if (isset($_GET['add_id'])) {
        $add_id = $_GET['add_id'];
        $query = "SELECT * FROM advertisments INNER JOIN brands ON brands.brand_id = advertisments.brand_id WHERE add_id = {$add_id}";
        if($result = mysqli_query($connection, $query)){
            $row = mysqli_fetch_assoc($result);
            $add_id = $row['add_id'];
            $add_title = $row['add_title'];
            $image1 = $row['image1'];
            $image2 = $row['image2'];
            $image3 = $row['image3'];
            $brand_name = $row['brand_name'];
            $brand_id = $row['brand_id'];
            $model = $row['model'];
            $capacity = $row['capacity'];
            $year_of_man = $row['year_of_man'];
            $mileage = $row['mileage'];
            $price = $row['price'];
            $c_number = $row['c_number'];
            $province = $row['province'];
            $district = $row['district'];
            $fuel_type = $row['fuel_type'];
            $transmission = $row['transmission'];
            $description = $row['description'];
        }else{
            header("Location: index.php?interface=view_all_adds");
        }
    }else{
        header("Location: index.php?interface=view_all_adds");
    }
?>
<h1 class="h3 mb-4 text-gray-800">Edit Detaiils of the Advertisment : Title >> <?php echo $add_title ?></h1>
<?php
    if (isset($_GET['err'])) {
        $err = $_GET['err'];
        if ($err == "price_err") {
        ?>
            <div class="alert alert-warning" role="alert">
                The entered price is lower than Rs. 100,000
            </div>
        <?php
        }elseif ($err == "contact_err") {
            ?>
                <div class="alert alert-warning" role="alert">
                    Contact Number should have 10 numbers
                </div>
            <?php
        }
    }
?>
<div class="row">
    <div class="col-md-6">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="add_title">Add Title</label>
                <input type="text" name="add_title" id="" class="form-control" value="<?php echo $add_title ?>" autocomplete="off" required maxlength="35">
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="image1">Add Image(1)</label><br>
                        <img src="../images/<?php echo $image1 ?>" height="40px" alt="">
                        <input type="file" name="image1" id="" class="form-control-file">
                    </div>
                    <div class="col-md-4">
                        <label for="image2">Add Image(2)</label><br>
                        <img src="../images/<?php echo $image2 ?>" height="40px" alt="">
                        <input type="file" name="image2" id="" class="form-control-file">
                    </div>
                    <div class="col-md-4">
                        <label for="image3">Add Image(3)</label><br>
                        <img src="../images/<?php echo $image3 ?>" height="40px" alt="">
                        <input type="file" name="image3" id="" class="form-control-file">
                    </div>

                </div>
            </div>

            <div class="form-group">
                <label for="brand">Brand</label>
                <select name="brand_id" id="" class="form-control" required>
                    <option value="<?php echo $brand_id ?>"><?php echo $brand_name ?></option>
                    <?php
                        $query = "SELECT * FROM brands";
                        $result = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $brand_id2 = $row['brand_id'];
                            $brand_name2 = $row['brand_name'];
                            if ($brand_name === $brand_name2) {
                                continue;
                            }
                            echo "<option value='$brand_id2'>$brand_name2</option>";
                        }
                    ?>
                    <option value="">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" name="model" id="" class="form-control" value="<?php echo $model ?>" autocomplete="off" required>
            </div>

            <div class="form-group">
                <label for="model">Capacity</label>
                <input type="text" name="capacity" id="" class="form-control" value="<?php echo $capacity ?>" autocomplete="off" required>
            </div>

            <div class="form-group">
                <label for="year_of_man">Year of Manufacture</label>
                <select name="year_of_man" id="" class="form-control" required>
                    <option value="<?php echo $year_of_man ?>"><?php echo $year_of_man ?></option>
                    <?php
                        for ($year=2021; $year >= 1990; $year--) { 
                            if ($year_of_man == $year) {
                                continue;
                            }
                            echo "<option value='$year'>$year</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="mileage">Mileage (Km)</label>
                <input type="number" name="mileage" id="" class="form-control" value="<?php echo $mileage ?>" autocomplete="off" required>
            </div>

            <div class="form-group">
                <label for="price">Price (Rs.)</label>
                <input type="number" name="price" id="" class="form-control" value="<?php echo $price ?>" autocomplete="off" required>
            </div>

            <div class="form-group">
                <label for="c_number">Contact Number</label>
                <input type="text" name="c_number" id="" class="form-control" value="0<?php echo $c_number ?>" autocomplete="off" required onkeypress="return this.value.length != 10">
            </div>

            <div class="form-group">
                
                <div class="row">
                    <div class="col-md-6">
                        <label for="province">Province</label>
                        <select name="province" id="province" class="form-control" required>
                            <option value="<?php echo $province ?>"><?php echo $province ?></option>
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
                        <label for="district">District</label>
                        <div id="display_area"></div>
                        <select name="district" id="district" class="form-control" required>

                            <option value="<?php echo $district ?>"><?php echo $district ?></option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="fuel_type">Fuel Type</label>
                <select name="fuel_type" id="" class="form-control" required>
                    <option value="<?php echo $fuel_type; ?>"><?php echo $fuel_type; ?></option>
                    <?php
                        if ($fuel_type == 'Petrol') {
                            echo '<option value="Diesel">Diesel</option>';
                            echo '<option value="Hybrid">Hybrid</option>';
                            echo '<option value="Other">Other</option>';
                        }elseif ($fuel_type == 'Diesel') {
                            echo '<option value="Petrol">Petrol</option>';
                            echo '<option value="Hybrid">Hybrid</option>';
                            echo '<option value="Other">Other</option>';
                        }elseif ($fuel_type == 'Hybrid') {
                            echo '<option value="Petrol">Petrol</option>';
                            echo '<option value="Diesel">Diesel</option>';
                            echo '<option value="Other">Other</option>';
                        }else{
                            echo '<option value="Petrol">Petrol</option>';
                            echo '<option value="Diesel">Diesel</option>';
                            echo '<option value="Hybrid">Hybrid</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="transmission">Transmission</label>
                <select name="transmission" id="" class="form-control" required>
                    <option value="<?php echo $transmission; ?>"><?php echo $transmission; ?></option>
                    <?php
                        if ($transmission == 'Auto') {
                            echo '<option value="Manual">Manual</option>';
                            echo '<option value="Other">Other</option>';
                        }elseif ($transmission == 'Manual') {
                            echo '<option value="Auto">Auto</option>';
                            echo '<option value="Other">Other</option>';
                        }else{
                            echo '<option value="Manual">Manual</option>';
                            echo '<option value="Auto">Auto</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description (max = 250 words)</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10"><?php echo $description ?></textarea>
            </div>

            <div class="form-group">
                <form action="" method="post">
                    <input type="submit" value="Update Post" class="btn btn-success" name="update_post">
                </form>
            </div>
        </form>
    </div>
</div>
<?php updateAdd(); ?> 
<script src="js/custom.js"></script>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
        $("#province").on('change',function(){
        	var province = $("#province").val();
            console.log(province);
        	$.ajax({
        		url: "includes/ajax.php",
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
