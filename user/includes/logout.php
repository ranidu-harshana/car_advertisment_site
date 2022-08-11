<?php
	include "db.php";
	session_start();

    $_SESSION['user_id'] = null;
    $_SESSION['username'] = null;
    $_SESSION['user_email'] = null;
    $_SESSION['fake_set'] = null;
	header("Location: ../../index.php");
?>