<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">View All Admins</h4>
        <?php 
        if (isset($_GET['user_add'])) {
            $msg = $_GET['user_add'];
            if ($msg == 'success') {
                echo "<div class='alert alert-success' role='alert'>";
                echo    "New Admin Added Successfully!.";
                echo "</div>";
            }
        }
    ?>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Admins</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Registered Date</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Registered Date</th>
                </tr>
            </tfoot>

            <tbody>
                <?php
                    $query = "SELECT * FROM admin";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $admin_id = $row['admin_id'];
                        $firstname = $row['firstname'];
                        $lastname = $row['lastname'];
                        $email  = $row['email'];
                        $created_at = $row['created_at'];
                        ?>
                            <tr>
                                <th><?php echo $admin_id; ?></th>
                                <td><?php echo $firstname; ?></td>
                                <td><?php echo $lastname; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $created_at; ?></td>
                            </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
        </div>
    </div>
</div>