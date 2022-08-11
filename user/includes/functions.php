<?php
function createAd(){
    global $connection;
    if (isset($_POST['add_post'])) {
        $add_title = $_POST['add_title'];
        $user_id = $_SESSION['user_id'];

        $image1 = $_FILES['image1']['name'];
	    $image1_temp = $_FILES['image1']['tmp_name'];

        move_uploaded_file($image1_temp, "../images/$image1");

        $image2 = $_FILES['image2']['name'];
        if(!empty($image2)){
            $image2_temp = $_FILES['image2']['tmp_name'];
            move_uploaded_file($image2_temp, "../images/$image2");
        }else{
            $image2 = NULL;
        }

        $image3 = $_FILES['image3']['name'];
        if(!empty($image3)){
            $image3_temp = $_FILES['image3']['tmp_name'];
            move_uploaded_file($image3_temp, "../images/$image3");
        }else{
            $image3 = NULL;
        }

        $brand_id = $_POST['brand_id'];
        $model = $_POST['model'];
        $capacity = $_POST['capacity'];
        $year_of_man = $_POST['year_of_man'];
        $mileage = $_POST['mileage'];
        $price = $_POST['price'];
        if ($price < 100000) {
            header("Location: index.php?interface=add_post&err=price_err");
            exit();
        }
        $c_number = $_POST['c_number'];
        if (strlen($c_number) != 10) {
            header("Location: index.php?interface=add_post&err=contact_err");
            exit();
        }
        $province = $_POST['province'];
        $district = $_POST['district'];
        $fuel_type = $_POST['fuel_type'];
        $transmission = $_POST['transmission'];
        $description = $_POST['description'];

        $add_title = mysqli_real_escape_string($connection, $add_title);
        $image1 = mysqli_real_escape_string($connection, $image1);
        $image2 = mysqli_real_escape_string($connection, $image2);
        $image3 = mysqli_real_escape_string($connection, $image3);
        $brand_id = mysqli_real_escape_string($connection, $brand_id);
        $model = mysqli_real_escape_string($connection, $model);
        $capacity = mysqli_real_escape_string($connection, $capacity);
        $year_of_man = mysqli_real_escape_string($connection, $year_of_man);
        $mileage = mysqli_real_escape_string($connection, $mileage);
        $price = mysqli_real_escape_string($connection, $price);
        $c_number = mysqli_real_escape_string($connection, $c_number);
        $province = mysqli_real_escape_string($connection, $province);
        $district = mysqli_real_escape_string($connection, $district);
        $fuel_type = mysqli_real_escape_string($connection, $fuel_type);
        $transmission = mysqli_real_escape_string($connection, $transmission);
        $description = mysqli_real_escape_string($connection, $description);

        $query = "INSERT INTO advertisments(user_id, add_title, image1, image2, image3, brand_id, model, capacity, year_of_man, mileage, price, c_number, province, district, fuel_type, transmission, description) ";
        $query.= "VALUES({$user_id}, '{$add_title}', '{$image1}', '{$image2}', '{$image3}', '{$brand_id}', '{$model}', '{$capacity}', '{$year_of_man}', {$mileage}, '{$price}', '{$c_number}', '{$province}', '{$district}', '{$fuel_type}', '{$transmission}', '{$description}')";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            header("Location: index.php?interface=view_all_adds&add_id=failed");
        }else{
            $add_id = mysqli_insert_id($connection);
            header("Location: index.php?interface=view_all_adds&add_id=success");
        }
    }
}

function updateAdd(){
    global $connection;
    if (isset($_POST['update_post'])) {
        $add_id = $_GET['add_id'];
        $add_title = $_POST['add_title'];
        
        $image1 = $_FILES['image1']['name'];
        $image2 = $_FILES['image2']['name'];
        $image3 = $_FILES['image3']['name'];

        if (empty($image1)) {
            $query = "SELECT * FROM advertisments WHERE add_id ='{$add_id}'";
            $result = mysqli_query($connection, $query);
            if(!$result){
                die("Query Failed" . mysqli_error($connection));
            }
            $row = mysqli_fetch_assoc($result);
            $image1 = $row['image1'];
        }else{
            $image1_temp = $_FILES['image1']['tmp_name'];
            move_uploaded_file($image1_temp, "../images/$image1");
        }

        if (empty($image2)) {
            $query = "SELECT * FROM advertisments WHERE add_id ='{$add_id}'";
            $result = mysqli_query($connection, $query);
            if(!$result){
                die("Query Failed" . mysqli_error($connection));
            }
            $row = mysqli_fetch_assoc($result);
            $image2 = $row['image2'];
        }else{
            $image2_temp = $_FILES['image2']['tmp_name'];
            move_uploaded_file($image2_temp, "../images/$image2");
        }

        if (empty($image3)) {
            $query = "SELECT * FROM advertisments WHERE add_id ='{$add_id}'";
            $result = mysqli_query($connection, $query);
            if(!$result){
                die("Query Failed" . mysqli_error($connection));
            }
            $row = mysqli_fetch_assoc($result);
            $image3 = $row['image3'];
        }else{
            $image3_temp = $_FILES['image3']['tmp_name'];
            move_uploaded_file($image3_temp, "../images/$image3");
        }

        $brand_id = $_POST['brand_id'];
        $model = $_POST['model'];
        $capacity = $_POST['capacity'];
        $year_of_man = $_POST['year_of_man'];
        $mileage = $_POST['mileage'];
        $price = $_POST['price'];
        if ($price < 100000) {
            header("Location: index.php?interface=edit_add&add_id={$add_id}&err=price_err");
            exit();
        }
        $c_number = $_POST['c_number'];
        if (strlen($c_number) != 10) {
            header("Location: index.php?interface=edit_add&add_id={$add_id}&err=contact_err");
            exit();
        }
        $province = $_POST['province'];
        $district = $_POST['district'];
        $fuel_type = $_POST['fuel_type'];
        $transmission = $_POST['transmission'];
        $description = $_POST['description'];

        $add_title = mysqli_real_escape_string($connection, $add_title);
        $image1 = mysqli_real_escape_string($connection, $image1);
        $image2 = mysqli_real_escape_string($connection, $image2);
        $image3 = mysqli_real_escape_string($connection, $image3);
        $brand_id = mysqli_real_escape_string($connection, $brand_id);
        $model = mysqli_real_escape_string($connection, $model);
        $capacity = mysqli_real_escape_string($connection, $capacity);
        $year_of_man = mysqli_real_escape_string($connection, $year_of_man);
        $mileage = mysqli_real_escape_string($connection, $mileage);
        $price = mysqli_real_escape_string($connection, $price);
        $c_number = mysqli_real_escape_string($connection, $c_number);
        $province = mysqli_real_escape_string($connection, $province);
        $district = mysqli_real_escape_string($connection, $district);
        $fuel_type = mysqli_real_escape_string($connection, $fuel_type);
        $transmission = mysqli_real_escape_string($connection, $transmission);
        $description = mysqli_real_escape_string($connection, $description);

        $query = "UPDATE advertisments SET add_title = '{$add_title}', image1 = '{$image1}', image2 = '{$image2}', image3 = '{$image3}', brand_id = '{$brand_id}', model = '{$model}', capacity = '{$capacity}', year_of_man = '{$year_of_man}', mileage = '{$mileage}', price = '{$price}', c_number = '{$c_number}', province = '{$province}', district = '{$district}', fuel_type = '{$fuel_type}', transmission = '{$transmission}', description = '{$description}' WHERE add_id = {$add_id}";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            // die("FAILEd ".  mysqli_error($connection));
            header("Location: index.php?interface=view_all_adds&add_id=update_failed");
        }else{
            $add_id = mysqli_insert_id($connection);
            header("Location: index.php?interface=view_all_adds&add_id=update_success");
        }
    }
}

function updateProfile(){
    global $connection;
    if(isset($_POST['save'])){
        $user_id = $_SESSION['user_id'];
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
       

        $user_name = mysqli_real_escape_string($connection, $user_name);
        $user_email = mysqli_real_escape_string($connection, $user_email);
        

        $query = "UPDATE users SET user_name = '{$user_name}', user_email = '{$user_email }' WHERE user_id = {$user_id}";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            // die("FAILEd ".  mysqli_error($connection));
            header("Location: index.php?interface=profile");
        }else{
            $add_id = mysqli_insert_id($connection);
            header("Location: index.php?interface=profile");
        }
    }
}