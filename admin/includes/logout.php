<?php
	session_start();

    $_SESSION['admin_id'] = null;
    $_SESSION['email'] = null;
    $_SESSION['name'] = null;
	header("Location: ../../index.php");
?>