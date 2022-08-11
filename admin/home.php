<?php include('../includes/db.php'); ?>
<?php include('includes/header.php'); ?>
    <?php include('includes/top-nav.php'); ?>

        <?php include('includes/sidebar.php'); ?>

        <div class="page-wrapper">
            <div class="content">
                <?php 
                    if(isset($_GET['interface'])){
                        $interface = $_GET['interface'];
                        switch ($interface) {
                            case 'add_new_admin':
                                include('includes/add_new_admin.php');
                                break;
                            case 'view_all_users':
                                include('includes/view_all_users.php');
                                break;
                            case 'view_all_ads':
                                include('includes/view_all_ads.php');
                                break;
                            case 'view_all_admins':
                                include('includes/view_all_admins.php');
                                break;
                            default:
                                include('includes/dashboard.php');
                                break;
                        }
                    }else{
                        include('includes/dashboard.php');
                    }
                ?>
                
            </div>
            
        </div>

<?php include('includes/footer.php'); ?>    