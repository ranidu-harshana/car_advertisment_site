<?php
include('../../includes/db.php');

if (isset($_POST['delete'])) {
    $add_id = $_POST['post_d'];
    $query = "DELETE FROM advertisments WHERE add_id = {$add_id}";
    if(mysqli_query($connection, $query)){
        header("Location: ../home.php?interface=view_all_ads");
    }
}