<?php
    include('../../includes/db.php');

    if (isset($_POST['unpost'])) {
        $add_id = $_POST['post_t'];
        $query = "UPDATE advertisments SET status = 0 WHERE add_id = {$add_id}";
        if(mysqli_query($connection, $query)){
            header("Location: ../index.php?interface=view_all_adds");
        }
    }

    if (isset($_POST['post'])) {
        $add_id = $_POST['unpost_t'];
        $query = "UPDATE advertisments SET status = 1 WHERE add_id = {$add_id}";
        if(mysqli_query($connection, $query)){
            header("Location: ../index.php?interface=view_all_adds");
        }
    }

    if (isset($_POST['delete'])) {
        $add_id = $_POST['post_d'];
        $query = "DELETE FROM advertisments WHERE add_id = {$add_id}";
        if(mysqli_query($connection, $query)){
            header("Location: ../index.php?interface=view_all_adds");
        }else{
            echo "vfszfz";
        }
    }