<?php include "includes/db.php"; ?>

    
<?php include('includes/header.php'); ?>

    <!-- Navigation -->
    <?php include('includes/navigation.php'); ?>

    <!-- Page Content -->
<div class="container">

       <!-- Side Navigation -->

<div class="col-md-12">

<!--Row For Image and Short Description-->

<div class="row">
<?php
    if (isset($_GET['add_id'])) {
        $add_id = $_GET['add_id'];
        $query = "SELECT * FROM advertisments INNER JOIN brands ON brands.brand_id = advertisments.brand_id WHERE add_id = {$add_id} AND status = 1";
        if($result = mysqli_query($connection, $query)){
            if(mysqli_num_rows($result) > 0){
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
                $created_at = $row['created_at'];
            }else{
                header("Location: index.php");
            }
        }else{
            header("Location: index.php");
        }
    ?>
    <div class="col-md-7">
        <?php
            if ($image2 == "" && $image3 == "") {
                echo '<img class="img-responsive" src="images/' . $image1 . '" alt="" width="700" style="height: 450px;">';
            }else{
                ?>
                    <div class="row carousel-holder">
                        <div class="col-md-12">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img class="slide-image" src="images/<?php echo $image1 ?>" alt="" style="height: 450px;">
                                    </div>
                                    <?php if($image2 != ""){ ?>
                                    <div class="item">
                                        <img class="slide-image" src="images/<?php echo $image2 ?>" alt="" style="height: 450px;">
                                    </div>
                                    <?php } ?>
                                    <?php if($image3 != ""){ ?>
                                    <div class="item">
                                        <img class="slide-image" src="images/<?php echo $image3 ?>" alt="" style="height: 450px;">
                                    </div>
                                    <?php } ?>
                                </div>
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
            }
        ?>
    </div>

    <div class="col-md-5">

        <div class="thumbnail">

            <div class="caption-full">
                
                <h4><a href="item.php?add_id=<?php echo $add_id ?>"><?php echo $add_title; ?></a> </h4>
                <hr>
                
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <td>Brand</td>
                        <td><?php echo $brand_name; ?></td>
                    </tr>
                    <tr>
                        <td>Model</td>
                        <td><?php echo $model; ?></td>
                    </tr>
                    <tr>
                        <td>Engine Capacity</td>
                        <td><?php echo $capacity; ?></td>
                    </tr>
                    <tr>
                        <td>Year of Manufacture </td>
                        <td><?php echo $year_of_man; ?></td>
                    </tr>
                    <tr>
                        <td>Mileage </td>
                        <td><?php echo $mileage; ?> Km</td>
                    </tr>
                    <tr>
                        <td>Price </td>
                        <td>Rs. <?php echo number_format($price, 2); ?></td>
                    </tr>
                    <tr>
                        <td>Contact Number</td>
                        <td><?php echo $c_number; ?></td>
                    </tr>
                    <tr>
                        <td>Location</td>
                        <td><?php echo $district; ?> District, <?php echo $province; ?> Province</td>
                    </tr>
                    <tr>
                        <td>Fuel Type</td>
                        <td><?php echo $fuel_type; ?></td>
                    </tr>
                    <tr>
                        <td>Transmission</td>
                        <td><?php echo $transmission; ?></td>
                    </tr>
                    <tr>
                        <td>Posted On</td>
                        <td><?php echo $created_at; ?></td>
                    </tr>
                    <?php
                        if(($transmission == "Auto") && ($fuel_type == "Petrol" || $fuel_type == "Hybrid") && ($brand_name == "Honda" || $brand_name == "Toyota")){
                            ?>
                            <tr>
                                <td>Predicted Price</td>
                                <td>
                                    <?php
                                        function callAPI($method, $url) {
                                            $curl = curl_init();
                                
                                            // Optional Authentication:
                                            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                                            curl_setopt($curl, CURLOPT_USERPWD, "username:password");
                                
                                            curl_setopt($curl, CURLOPT_URL, $url);
                                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                                
                                            $result = curl_exec($curl);
                                
                                            curl_close($curl);
                                
                                            return $result;
                                        } 
                                        $result = json_decode(callAPI("GET", "http://localhost:8000/predict_price?Year=".$year_of_man."&Mileage=".$mileage."&Engine_Capacity=".$capacity."&Transmission=".$transmission."&Fuel_Type=".$fuel_type."&Brand=".$brand_name), true);
                                        if($result){
                                            echo ("Rs. ".$result['priceval']);
                                        }else{
                                            echo "API ERROR";
                                        }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                </table>

    </div>
 
</div>

</div>


</div><!--Row For Image and Short Description-->


        <hr>


<!--Row for Tab Panel-->

<div class="row">

    <div role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <p><pre><?php echo $description; ?></pre></p>
            </div>
        </div>

    </div>

</div><!--Row for Tab Panel-->

</div>

</div>
<script type="text/javascript" src="JS/checkout.js"></script>

    <!-- /.container -->





<div class="container-fluid">

<hr>

<!-- Footer -->

    <div class="row" style="background-color:#000; color:white; padding:20px 0px 20px 0px; text-align:center">
        All Right Reserved. &#169; Copyright.
    </div>
</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>

<?php    
    }else{
        header("Location: index.php");
    }
?>