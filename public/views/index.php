<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.min.css">
    <link rel="stylesheet" href="../assets/css/base.css" />
    <link rel="stylesheet" href="../assets/fonts/themify-icons/themify-icons.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link href="../../shared/img/logo-icon.png" rel="shortcut icon" type="image/x-icon">

    <?php
        $pageTitle = "ecoTech - Trang chủ";
    ?>
    <title><?php echo $pageTitle ?></title>
</head>

<body>  
    <?php include "../components/header.php"?>

    <nav>
        <ul class="header-nav row">
            <li class="nav-categories col-lg-3 col-md-3"><a href="#"><i class="ti-menu"></i> DANH MỤC SẢN PHẨM</a> </li>
            <li class="col-lg-2 col-md-2 align-right"><a href="#">HOT DEAL</a></li>
            <li class="col-lg-3 col-md-2 align-right"><a href="#">KHUYẾN MÃI</a></li>
            <li class="col-lg-4 col-md-5 align-right"><a href="#">HOTLINE: 1900xxxx - 1900xxxx</a></li>
        </ul>
    </nav>

    <section>
    <div class="row">
        <ul class="nav-categories-list col-lg-2 col-md-2">
            <li><a href="#">Điện lạnh</a></li>
            <li><a href="#">Điện gia dụng</a></li>
            <li><a href="#">Điện thoại - Máy tính bảng</a></li>
            <li><a href="#">Laptop - Thiết bị IT</a></li>
            <li><a href="#">Máy ảnh - Quay phim</a></li>
            <li><a href="#">Điện tử - Điện máy khác</a></li>
            <li><a href="#">Điện tử - Điện máy khác</a></li>
            <li><a href="#">Điện tử - Điện máy khác</a></li>
            <li><a href="#">Điện tử - Điện máy khác</a></li>
            <li><a href="#">Xem thêm</a></li>
        </ul>

        <div class="banner col-lg-6 col-md-6">
            <img class="" src="../assets/img/banner1.png" alt="">
        </div>
        <div class="ads col-lg col-md">
            <img class=" pb-8" src="../assets/img/ads1.png" alt="ads1">
            <img class=" " src="../assets/img/ads2.png" alt="ads2">
        </div>
    </div>

    <div class="hot-deal">
        <h3>HOT DEAL</h3>
        <div class="hot-deal-content">
            <i class="ti-angle-double-left slide-btn pre-btn btn"></i>
            <div class="product col"></div>
            <div class="product col"></div>
            <div class="product col"></div>
            <div class="product col"></div>
            <div class="product col"></div>
            <i class="ti-angle-double-right slide-btn next-btn btn"></i>
        </div>

        <div class="see-all-btn">
            <a href="#">XEM TẤT CẢ</a>
        </div>
    </div>

    <div class="top-product">
        <h3>SẢN PHẨM BÁN CHẠY</h3>
        <div class="top-product-content">
            <i class="ti-angle-double-left slide-btn pre-btn btn"></i>
            <div class="product"></div>
            <div class="product"></div>
            <div class="product"></div>
            <div class="product"></div>
            <div class="product"></div>
            <i class="ti-angle-double-right slide-btn next-btn btn"></i>
        </div>
        <div class="see-all-btn">
            <a href="#">XEM TẤT CẢ</a>
        </div>
    </div>
    </section>


    <footer>
    <hr>
        <div class="service row">  
            <div class="col-lg-3">
                <h6 class="service-title">VẬN CHUYỂN</h6>
                <p class="service-content">MIỄN PHÍ 20KM</p>
            </div>
            <div class="col-lg-4">
                <h6 class="service-title">THANH TOÁN COD</h6>
                <p class="service-content">THANH TOÁN TRỰC TIẾP KHI NHẬN HÀNG</p>
            </div>
            <div class="col-lg-5">
                <h6 class="service-title">ĐỔI TRẢ HÀNG</h6>
                <p class="service-content">THỜI GIAN ĐỔI TRẢ HÀNG LÊN ĐẾN 1 THÁNG</p>
            </div>
        </div>
        <hr>
    </footer>

    <?php include "../components/footer.php" ?>
    
</body>

</html>