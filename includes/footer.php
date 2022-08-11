
<div class="container-fluid" style="position: fixed; bottom: 0; width: 100%;">
    <?php if($post_count < 5){?>
	<ul class="pager">
		<?php
			for ($i=1; $i < $number_of_pages + 1; $i++) { 
				
				if (isset($_GET['keyword'])){
					echo "<li><a href='index.php?page={$i}&keyword={$keyword}'>" .  $i . "</a></li>";
				}else{
					echo "<li><a href='index.php?page={$i}'>" .  $i . "</a></li>";
				}
			}
		?>
	</ul>
	<?php } ?>
    <div class="row " style="background-color:#000; color:white; padding:20px 0px 20px 0px; text-align:center">
        All Right Reserved. &#169; Copyright.
    </div>
</div>
<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
