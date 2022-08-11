<?php
include('../../includes/db.php');

if (isset($_POST['udelete'])) {
    $user_id = $_POST['user_d'];
    $query = "DELETE FROM users WHERE user_id = {$user_id}";
    if(mysqli_query($connection, $query)){
        header("Location: ../home.php?interface=view_all_users");
    }
}