<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">View All Users</h4>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Start date</th>
                    <th>Action</th>
                </tr>
            </tfoot>

            <tbody>
                <?php
                    $query = "SELECT * FROM users";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $user_id = $row['user_id'];
                        $user_name = $row['user_name'];
                        $user_email  = $row['user_email'];
                        $created_at = $row['created_at'];
                        ?>
                            <tr>
                                <th><?php echo $user_id; ?></th>
                                <td><?php echo $user_name; ?></td>
                                <td><?php echo $user_email; ?></td>
                                <td><?php echo $created_at; ?></td>
                                <td>
                                    <form action='includes/delete_user.php' method='post'>
                                        <input type='hidden' name='user_d' value='<?php echo $user_id ?>'>
                                        <button class='btn btn-danger' name='udelete' type='submit'>Delete</button>
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