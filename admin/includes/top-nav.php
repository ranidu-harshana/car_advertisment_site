<div class="header">
    <div class="header-left">
        <a href="home.php" class="logo" style="text-decoration: none;">
            <span>ADMIN PROFILE</span>
        </a>
    </div>
    <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
    <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
    <ul class="nav user-menu float-right">
        <li class="nav-item">
            <a href="../index.php" class="nav-link">Visit Site</a>
        </li>
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                
                <span>
                    <?php
                        if (isset($_SESSION['name'])) {
                            echo $_SESSION['name'];
                        }
                    ?>
                </span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="includes/logout.php">Logout</a>
            </div>
        </li>
    </ul>
    <div class="dropdown mobile-user-menu float-right">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-ellipsis-v"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="includes/logout.php">Logout</a>
        </div>
    </div>
</div>