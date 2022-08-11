<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Add Detaiils for the Advertisment</h1>
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
                <label for="add_title">Ad Title</label>
                <input type="text" name="add_title" id="" class="form-control" autocomplete="off" required maxlength="35">
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="image1">Add Image(1)<span style="color: red;">*</span></label>
                        <input type="file" name="image1" id="" class="form-control-file" required>
                    </div>

                    <div class="col-md-4">
                        <label for="image">Add Image(2)</label>
                        <input type="file" name="image2" id="" class="form-control-file">
                    </div>

                    <div class="col-md-4">
                        <label for="image">Add Image(3)</label>
                        <input type="file" name="image3" id="" class="form-control-file">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="brand_id">Brand</label>
                <select name="brand_id" id="" class="form-control" required>
                    <?php
                        $query = "SELECT * FROM brands";
                        $result = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $brand_id = $row['brand_id'];
                            $brand_name = $row['brand_name'];
                            echo "<option value='$brand_id'>$brand_name</option>";
                        }
                    ?>
                    <option value="">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" name="model" id="" class="form-control" autocomplete="off" required maxlength="15">
            </div>

            <div class="form-group">
                <label for="model">Capacity</label>
                <input type="text" name="capacity" id="" class="form-control" autocomplete="off" required>
            </div>

            <div class="form-group">
                <label for="year_of_man">Year of Manufacture</label>
                <select name="year_of_man" id="" class="form-control" required>
                    <?php
                        for ($year=2021; $year >= 1990; $year--) { 
                            echo "<option value='$year'>$year</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="mileage">Mileage (Km)</label>
                <input type="number" name="mileage" id="" class="form-control" autocomplete="off" required onkeypress="return this.value.length != 10">
            </div>

            <div class="form-group">
                <label for="price">Price (Rs.)</label>
                <input type="number" name="price" id="" class="form-control" autocomplete="off" required onkeypress="return this.value.length != 10">
            </div>

            <div class="form-group">
                <label for="c_number">Contact Number</label>
                <input type="number" name="c_number" id="" class="form-control" autocomplete="off" required onkeypress="return this.value.length != 10">
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="province">Province</label>
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
                        <label for="district">District</label>
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
                <label for="fuel_type">Fuel Type</label>
                <select name="fuel_type" id="" class="form-control" required>
                    <option value="Petrol">Petrol</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Hybrid">Hybrid</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="transmission">Transmission</label>
                <select name="transmission" id="" class="form-control" required>
                    <option value="Auto">Auto</option>
                    <option value="Manual">Manual</option>
                    <option value="Hybrid">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description (max = 250 words)</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
            </div>

            <div class="form-group">
                <input type="submit" value="Add Post" class="btn btn-success" name="add_post">
            </div>
        </form>
    </div>
</div>
<?php createAd(); ?>
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