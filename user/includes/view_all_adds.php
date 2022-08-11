<?php
	if (isset($_GET['add_id'])) {
		$msg = $_GET['add_id'];
		if ($msg == 'success') {
			echo "<div class='alert alert-success' role='alert'>";
				echo    "New Addvertisment was created";
			echo "</div>";
		}else if($msg == 'failed'){
			echo "<div class='alert alert-warning' role='alert'>";
				echo    "Creating New Addvertisment Failed!";
			echo "</div>";
		}else if($msg == 'update_success'){
			echo "<div class='alert alert-success' role='alert'>";
				echo    "Advertisment Updated Successfully!";
			echo "</div>";
		}else if($msg == 'update_failed'){
			echo "<div class='alert alert-warning' role='alert'>";
				echo    "Advertisment Update Failed!";
			echo "</div>";
		}
		
	}

	if(isset($_GET['post_limit'])){
		$msg = $_GET['post_limit'];
		if ($msg == 'reach') {
			echo "<div class='alert alert-warning' role='alert'>";
			echo    "One User can Add only 5 Posts!.";
			echo "</div>";
		}
	}
?>
<div class="table-responsive">
	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>#</th>
				<th>Title</th>
				<th>Brand</th>
				<th>Model</th>
				<th>Year of Manu.</th>
				<th>Mileage</th>
				<th>Price</th>
				<th>Contact No.</th>
				<th>Location</th>
				<th>Fuel Type</th>
				<th>Transmission</th>
				<th>Action</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tfoot>
			
			<tr>
				<th>#</th>
				<th>Title</th>
				<th>Brand</th>
				<th>Model</th>
				<th>Year of Manu.</th>
				<th>Mileage</th>
				<th>Price</th>
				<th>Contact No.</th>
				<th>Location</th>
				<th>Fuel Type</th>
				<th>Transmission</th>
				<th>Action</th>
				<th>Delete</th>
			</tr>
		</tfoot>
		<tbody>
			<?php
				$user_id = $_SESSION['user_id'];
				$query = "SELECT * FROM advertisments INNER JOIN brands ON brands.brand_id = advertisments.brand_id WHERE user_id = {$user_id}";
				$result = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_assoc($result)) {
					$add_id = $row['add_id'];
					$add_title = $row['add_title'];
					$brand = $row['brand_name'];
					$model = $row['model'];
					$year_of_man = $row['year_of_man'];
					$mileage = $row['mileage'];
					$price = $row['price'];
					$c_number = $row['c_number'];
					$province = $row['province'];
					$district = $row['district'];
					$fuel_type = $row['fuel_type'];
					$transmission = $row['transmission'];
					$status = $row['status'];
					?>
						<tr>
							<td><?php echo $add_id ?></td>
							<td><a href="index.php?interface=edit_add&add_id=<?php echo $add_id ?>"><?php echo $add_title ?></a></td>
							<td><?php echo $brand ?></td>
							<td><?php echo $model ?></td>
							<td><?php echo $year_of_man ?></td>
							<td><?php echo $mileage ?></td>
							<td><?php echo $price ?></td>
							<td><?php echo $c_number ?></td>
							<td><?php echo $province ?> Province, <?php echo $district ?> District</td>
							<td><?php echo $fuel_type ?></td>
							<td><?php echo $transmission ?></td>
							<?php
								if ($status == 1) {
									echo "<td>";
									echo "<form action='includes/post_unpost.php' method='post'>";
									echo "<input type='hidden' name='post_t' value='{$add_id}'>";
									echo "<button class='btn btn-warning' name='unpost' type='submit'>UnPost</button>";
									echo "</form>";
									echo "<a href='../item.php?add_id={$add_id}'>View Post</a>";
									echo "</td>";
								} else {
									echo "<td>";
									echo "<form action='includes/post_unpost.php' method='post'>";
									echo "<input type='hidden' name='unpost_t' value='{$add_id}'>";
									echo "<button class='btn btn-primary' name='post' type='submit'>Post</button>";
									echo "</form>";
									echo "<a href='../item.php?add_id={$add_id}'>View Post</a>";
									echo "</td>";
								}
							?>
							<td>
								<form action='includes/post_unpost.php' method='post'>
									<input type='hidden' name='post_d' value='<?php echo $add_id ?>'>
									<button class='btn btn-danger' name='delete' type='submit'>Delete</button>
								</form>
							</td>
						</tr>
					<?php
				}
			?>
			
		</tbody>
	</table>
</div>