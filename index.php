<?php include "includes/db.php"; ?>
<?php include('includes/header.php'); ?>

	<!-- Navigation -->
	<?php include('includes/navigation.php'); ?>

	<!-- Page Content -->
	<div class="container">

		<div class="row">

			<?php // include('includes/categories_list.php')?>
			
			<div class="col-md-12">
				<div class="row">
					<?php
						if(isset($_GET['search']) || isset($_GET['keyword'])){
							$keyword = $_GET['keyword'];
							$query = "SELECT * FROM advertisments INNER JOIN brands ON brands.brand_id = advertisments.brand_id WHERE add_title LIKE '%" . $keyword . "%'";
						}elseif(isset($_SESSION['fake_set'])){
							$fuel_type = $_SESSION['fuel_type'];
							$transmission = $_SESSION['transmission'];
							$brand = $_SESSION['brand'];
							$province = $_SESSION['province'];
							$district = $_SESSION['district'];
							$min_price = $_SESSION['min_price'];
							$max_price = $_SESSION['max_price'];
							$min_year = $_SESSION['min_year'];
							$max_year = $_SESSION['max_year'];

							$extra_query = "";
							if ($brand != ""){
								$extra_query .= "AND brands.brand_id = {$brand} ";
							}

							if ($min_price != "" && $max_price != ""){
								$extra_query .= "AND (price BETWEEN $min_price AND $max_price) ";
							}

							if ($min_year != "" && $max_year != ""){
								$extra_query .= "AND (year_of_man BETWEEN $min_year AND $max_year) ";
							}

							if ($province != ""){
								$extra_query .= "AND province = '{$province}' ";
							}

							if ($district != ""){
								$extra_query .= "AND district = '{$district}' ";
							}

							if ($fuel_type != ""){
								$extra_query .= "AND fuel_type = '{$fuel_type}' ";
							}

							if ($transmission != ""){
								$extra_query .= "AND transmission = '{$transmission}'";
							}
							$query = "SELECT * FROM advertisments INNER JOIN brands ON brands.brand_id = advertisments.brand_id WHERE status = 1 " .$extra_query. "";
						}else{
							$query = "SELECT * FROM advertisments INNER JOIN brands ON brands.brand_id = advertisments.brand_id WHERE status = 1";
						}
						
						$result = mysqli_query($connection, $query);
						$count = mysqli_num_rows($result);
						$number_of_pages = ceil($count / 6);
						
						if(isset($_GET['page'])){
							$page = $_GET['page'];
							$start = ($page - 1) * 6;
						}else{
							$start = 0;
						}

						if(isset($_GET['search']) || isset($_GET['keyword'])){
							$keyword = $_GET['keyword'];
							$query = "SELECT * FROM advertisments INNER JOIN brands ON brands.brand_id = advertisments.brand_id WHERE add_title LIKE '%$keyword%' AND status = 1 LIMIT {$start}, 6";
						}elseif(isset($_SESSION['fake_set'])){
							$query = "SELECT * FROM advertisments INNER JOIN brands ON brands.brand_id = advertisments.brand_id WHERE status = 1 " . $extra_query . " LIMIT {$start}, 6";
						}else{
							$query = "SELECT * FROM advertisments INNER JOIN brands ON brands.brand_id = advertisments.brand_id WHERE status = 1 LIMIT {$start}, 6";
						}
						$result = mysqli_query($connection, $query);
						if($result){
							$post_count = mysqli_num_rows($result);
							if($post_count > 0) {
								while ($row = mysqli_fetch_assoc($result)) {
									$add_id = $row['add_id'];
									$add_title = $row['add_title'];
									$image = $row['image1'];
									$brand_name = $row['brand_name'];
									$price = $row['price'];
									$created_at = $row['created_at'];
								?>
								<div class="col-sm-4 col-lg-4 col-md-4">
									<div class="thumbnail">
										<img src="images/<?php echo $image; ?>" alt="" style="height:150px; width:auto; ">
										<div class="caption">
											<h4 class="pull-right">Rs. <?php echo number_format($price, 2)?></h4>
											<h4><a href="item.php?add_id=<?php echo $add_id ?>"><?php echo $add_title?></a></h4>
											<p><?php echo $brand_name?><a href="item.php?add_id=<?php echo $add_id ?>"> <br>click here for more details.</a>.</p>
											<p style="color:gray">Posted On 
												<?php 
													$datetime1 = new DateTime();
													$datetime2 = new DateTime($created_at);
													$interval = $datetime1->diff($datetime2);
													$elapsed = $interval->format('%a days %h hours');
													echo $elapsed . " before";
												?>
											</p>
										</div>
										
									</div>
								</div>
								<?php
								}
							}else{
								?>
									<div class="alert alert-warning" role="alert">
										There are no any Advertisments
									</div>
								<?php
							}
						}else{
							?>
								<div class="alert alert-warning" role="alert">
									There are no any Advertisments
								</div>
							<?php
						}
					?>
				</div>

			</div>


		</div>

	</div>
	<!-- /.container -->
	<?php if($post_count >= 5){?>
	<ul class="pager" style="margin-bottom: 80px;">
		<?php
			for ($i=1; $i < $number_of_pages + 1; $i++) {
				if (isset($_GET['keyword'])){
					echo "<li><a href='index.php?page={$i}&keyword={$keyword}'>" . $i . "</a></li>";
				}else{
					echo "<li><a href='index.php?page={$i}'>" . $i . "</a></li>";
				}
			}
		?>
	</ul>
	<?php } ?>
<?php include('includes/footer.php'); ?>