<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:#0275d8">

    <!-- Sidebar - Brand -->
    <!-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
    <div class="sidebar-brand-text mx-3">User Profile</div>
    </a> -->

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
    <a class="nav-link" href="index.php?interface=profile">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Profile</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item active">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Options</span>
    </a>
    <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Advertisments:</h6>
            <?php
                $user_id = $_SESSION['user_id'];
                $query = "SELECT * FROM advertisments WHERE user_id = {$user_id}";
                $result = mysqli_query($connection, $query);
                $count = mysqli_num_rows($result);

                if ($count == 5){
                    echo '<a class="collapse-item" href="index.php?interface=view_all_adds&post_limit=reach">Post an Ad</a>';
                }else{
                    echo '<a class="collapse-item" href="index.php?interface=add_post">Post an Ad</a>';
                }
            ?>
            <a class="collapse-item" href="index.php?interface=view_all_adds">View My Ads</a>
        </div>
    </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>