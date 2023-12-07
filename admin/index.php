<?php
include_once "../libraries/connectDB.php";
session_start();

// if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') 
// {
//     header('location: ../index.php');
// }
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
    $pageTitle = "ecoTech - Dashboard";
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


            if (isset($_GET['quanly'])) {
                $tam = $_GET['quanly'];
            } else {
                $tam = '';
            }

            if ($tam == 'category') {
                include('./views/category.php');
            } elseif ($tam == 'category-insert') {
                include('./views/category-insert.php');
            } elseif ($tam == 'category-update') {
                include('./views/category-update.php');
            } elseif ($tam == 'product') {
                include('./views/products.php');
            } elseif ($tam == 'order') {
                include('./views/order.php');
            } elseif ($tam == 'customer') {
                include('./views/customer.php');
            } elseif ($tam == 'employee') {
                include('./views/employee.php');
            } elseif ($tam == 'supplier') {
                include('./supplier.php');
            } elseif ($tam == 'warehouse') {
                include('./warehouse.php');
            }
            // elseif ($tam=='report') {
            //     include('./reports.php');
            // }
            // elseif ($tam=='setting') {
            //     include('./settings.php');
            // }
            // elseif ($tam=='logout') {
            //     include('./logout.php');
            // }

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