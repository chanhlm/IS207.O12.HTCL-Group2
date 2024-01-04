<?php
include_once "../libraries/connectDB.php";
session_start();

date_default_timezone_set('Asia/Ho_Chi_Minh');

if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) 
{
    header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--plugins-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.min.css">
    <!-- loader-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/pace-theme-default.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="./assets/css/app.css" rel="stylesheet">
    <link href="./assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="./assets/css/semi-dark.css" />

    <link href="../shared/img/logo-icon.png" rel="shortcut icon" type="image/x-icon">

    <?php
    $pageTitle = "ElectroTech - Admin";
    ?>
    <title><?php echo $pageTitle ?></title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <?php
        // if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') 
        {
            include_once "./components/sidebar.php";

            include_once "./components/header.php";


            if (isset($_GET['page'])) {
                $tam = $_GET['page'];
            } else {
                $tam = '';
            }

            if ($tam == 'category') {
                include('./views/category/category.php');
            } elseif ($tam == 'category-insert') {
                include('./views/category/category-insert.php');
            } elseif ($tam == 'category-update') {
                include('./views/category/category-update.php');
            } 
            
            elseif ($tam == 'product') {
                include('./views/product/product.php');
            } elseif ($tam == 'product-insert') {
                include('./views/product/product-insert.php');
            } elseif ($tam == 'product-update') {
                include('./views/product/product-update.php');
            }
            
            elseif ($tam =='brand') {
                include('./views/brand/brand.php');
            }elseif ($tam =='brand-insert') {
                include('./views/brand/brand-insert.php');
            }elseif ($tam =='brand-update') {
                include('./views/brand/brand-update.php');
            } 
            
            elseif ($tam == 'warehouse') {
                include('./views/warehouse/warehouse.php');
            } elseif ($tam == 'warehouse-import') {
                include('./views/warehouse/warehouse-import.php');
            } elseif ($tam == 'warehouse-export') {
                include('./views/warehouse/warehouse-export.php');
            } 
            
            elseif ($tam == 'customer') {
                include('./views/user/customer.php');
            } elseif ($tam == 'employee') {
                include('./views/user/employee.php');
            }
            
            elseif ($tam == 'order') {
                include('./views/order/order.php');
            } elseif ($tam == 'order-detail') {
                include('./views/order/order-detail.php');
            } elseif ($tam == 'order-create') {
                include('./views/order/order-create.php');
            } 
                
            elseif ($tam == 'statistic') {
                include('./views/statistic/statistic.php');
            }

            elseif ($tam == 'code') {
                include('./views/promotion/code.php');
            } elseif ($tam == 'code-insert') {
                include('./views/promotion/code-insert.php');
            } elseif ($tam == 'code-update') {
                include('./views/promotion/code-update.php');
            }   
            elseif ($tam == 'promotion') {
                include('./views/promotion/promotion.php');
            } elseif ($tam == 'promotion-insert') {
                include('./views/promotion/promotion-insert.php');
            } elseif ($tam == 'promotion-update') {
                include('./views/promotion/promotion-update.php');
            }

            elseif ($tam == 'feedback') {
                include('./views/feedback.php');
            }

            else include('./views/dashboard.php');



            include_once "./components/footer.php";
        }
        ?>
    </div>
    <!--end wrapper-->

    <!-- Bootstrap JS -->
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.min.js"></script>
    <script src="./assets/plugins/chartjs/chart.min.js"></script>
    <script src="./assets/js/index.js"></script>
    <!--app JS-->
    <script src="./assets/js/app.js"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->

</body>

</html>