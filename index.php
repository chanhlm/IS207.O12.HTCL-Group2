<?php
session_start();
include_once "./libraries/connectDB.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.min.css">
    <link rel="stylesheet" href="./public/assets/css/base.css" />
    <link rel="stylesheet" href="./public/assets/fonts/themify-icons/themify-icons.css" />
    <link rel="stylesheet" href="./public/assets/css/magnify.css" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link href="./shared/img/logo-icon.png" rel="shortcut icon" type="image/x-icon">

    <?php
    $pageTitle = "ecoTech - Trang chủ";
    ?>

    <title><?php echo $pageTitle ?></title>

</head>

<body>
    <?php include "./public/components/header.php"; ?>

    <?php
    if (isset($_GET['quanly'])) {
        $tam = $_GET['quanly'];
    } else {
        $tam = '';
    }
    if ($tam == 'authentication') {
        include('./public/views/authentication.php');
    } elseif ($tam == 'category') {
        include('./public/views/category.php');
    } elseif ($tam == 'product') {
        include('./public/views/product.php');
    }
    // elseif($tam=='giohang') {
    //     include('include/giohang.php');}
    elseif ($tam == 'timkiem') {
        include('include/timkiem.php');
    }
    // elseif ($tam=='tintuc') {
    //     include('include/tintuc.php');}
    //elseif ($tam=='chitiettin') {
    //     include('include/chitiettin.php');}
    // elseif ($tam=='xemdonhang') {
    //     include('include/xemdonhang.php');}
    else {
        include('./public/views/home.php');
    }
    ?>

    <?php include "./public/components/footer.php" ?>

    <script>
        // Hàm để cuộc nhảy đến mục tiêu và chạy xuống chân mục tiêu
        function scrollToTarget(targetId) {
            var targetElement = document.getElementById(targetId);

            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        }
    </script>    
</body>

</html>