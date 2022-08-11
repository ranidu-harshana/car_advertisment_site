<?php include('../includes/db.php'); ?>
<?php include('includes/header.php'); ?>
		<!-- Sidebar -->
		<?php include('includes/sidebar.php'); ?>
		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<?php include('includes/top-nav.php'); ?>
				<!-- End of Topbar -->

				<!-- Begin Page Content -->
				<div class="container-fluid">
					<?php 
						if(isset($_GET['interface'])){
							$interface = $_GET['interface'];
							switch ($interface) {
								case 'add_post':
									include('includes/add_post.php');
									break;
								case 'view_all_adds':
									include('includes/view_all_adds.php');
									break;
								case 'edit_add':
									include('includes/edit_add.php');
									break;
								case 'profile':
									include('includes/profile.php');
									break;
								default:
								include('includes/add_post.php');
									break;
							}
						}else{
							include('includes/add_post.php');
						}
					?>
				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- End of Main Content -->
			
			<!-- Footer -->
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>All Right Reserved. &#169; Copyright.</span>
					</div>
				</div>
			</footer>
			<!-- End of Footer -->
			
		</div>
		<!-- End of Content Wrapper -->

	</div>
	<!-- End of Page Wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="includes/logout.php">Logout</a>
				</div>
			</div>
		</div>
	</div>
	<?php include('includes/footer.php'); ?>