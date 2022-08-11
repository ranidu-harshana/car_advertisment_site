<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">View All Ads</h4>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Ads</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
			<tr>
				<th>#</th>
				<th>Title</th>
                <th>Creater Name</th>
				<th>Brand</th>
				<th>Model</th>
				<th>Mileage</th>
				<th>Price</th>
				<th>Contact No.</th>
				<th>Location</th>
				<th>Fuel Type</th>
				<th>Transmission</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tfoot>
			
			<tr>
				<th>#</th>
				<th>Title</th>
                <th>Creater Name</th>
				<th>Brand</th>
				<th>Model</th>
				<th>Mileage</th>
				<th>Price</th>
				<th>Contact No.</th>
				<th>Location</th>
				<th>Fuel Type</th>
				<th>Transmission</th>
				<th>Delete</th>
			</tr>
		</tfoot>

        <tbody>
			<?php
				$query = "SELECT * FROM advertisments INNER JOIN brands ON brands.brand_id = advertisments.brand_id INNER JOIN users ON advertisments.user_id = users.user_id;";
				$result = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_assoc($result)) {
                    $user_name = $row['user_name'];
					$add_id = $row['add_id'];
					$add_title = $row['add_title'];
					$brand = $row['brand_name'];
					$model = $row['model'];
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
							<td><a href='../item.php?add_id=<?php echo $add_id ?>'><?php echo $add_title ?></a></td>
                            <td><?php echo $user_name ?></td>
							<td><?php echo $brand ?></td>
							<td><?php echo $model ?></td>
							<td><?php echo $mileage ?></td>
							<td><?php echo $price ?></td>
							<td><?php echo $c_number ?></td>
							<td><?php echo $province ?> Province, <?php echo $district ?> District</td>
							<td><?php echo $fuel_type ?></td>
							<td><?php echo $transmission ?></td>
							<td>
								<form action='includes/delete_post.php' method='post'>
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
    </div>
</div>