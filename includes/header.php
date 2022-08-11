<?php ob_start(); ?>
<?php session_start(); ?>
<?php
    if (isset($_GET['reset'])){
        $_SESSION['fake_set'] = null;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        <?php
            if (isset($_GET['add_id'])) {
                $add_id = $_GET['add_id'];
                $query = "SELECT add_title FROM advertisments WHERE add_id = {$add_id}";
                $result = mysqli_query($connection, $query);
                $row = mysqli_fetch_assoc($result);
                $add_title = $row['add_title'];
                echo $add_title;
            }else{
                echo "cars.lk - Home";
            }
        ?>
    </title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap1.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a6c8896658.js" crossorigin="anonymous"></script>
</head>

<body>