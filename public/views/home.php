<link rel="stylesheet" href="./public/assets/css/style.css" />

<nav>
    <ul class="header-nav row">
        <li class="nav-categories col-lg-3 col-md-3"><a href="#"><i class="ti-menu"></i> DANH MỤC SẢN PHẨM</a> </li>
        <li class="col-lg-2 col-md-2 align-right"><a href="#" onclick="scrollToTarget('hot-deal')">HOT DEAL</a></li>
        <li class="col-lg-3 col-md-2 align-right"><a href="#" onclick="scrollToTarget('sale')">KHUYẾN MÃI</a></li>
        <li class="col-lg-4 col-md-5 align-right"><a href="#" onclick="scrollToTarget('info')">HOTLINE: 1900xxxx - 1900xxxx</a></li>
    </ul>
</nav> 

<section>
    <div class="row">
        <ul class="pt-3 nav-categories-list col-lg-2 col-md-2">

            <?php

            $sql = "SELECT * FROM categories";
            $result = mysqli_query($connect, $sql);
            if (mysqli_num_rows($result) > 0) {
                $count = 0;
                while ($row1 = mysqli_fetch_assoc($result)) {
                    // Lấy một bản ghi tiếp theo
                    $row2 = mysqli_fetch_assoc($result);

                    // Hiển thị 10 mục đầu tiên dưới dạng <li> với hai tên danh mục khác nhau
                    if ($row2 !== null) {
                        echo "<li><a href='index.php?page=category&category=" . $row1["CATEGORY_ID"] . "'>" . $row1["CATEGORY_NAME"] . "</a>, <a href='index.php?page=category&category=" . $row2["CATEGORY_ID"] . "'>" . $row2["CATEGORY_NAME"] . "</a></li>";
                    }

                    // else {
                    //     // Nếu vượt quá 10 mục hoặc không còn đủ bản ghi, đưa dữ liệu vào mục xem thêm
                    //     echo "<div id='xemthem' style='display: none;'><li><a href='#'>" . $row1["CATEGORY_NAME"] . "</a><a href='#'>" . $row2["CATEGORY_NAME"] . "</a></li></div>";
                    // }

                    $count += 2; // Tăng count lên 2 vì mỗi lần lặp hiển thị 2 tên danh mục
                }

                // if ($count > 10) {
                //     echo "<button onclick='showMore()'>Xem thêm</button>";
                // }
            }
            ?>
        </ul>

        <div class="banner col-lg-6 col-md-6">
            <img class="" src="./public/assets/img/banner1.png" alt="">
        </div>
        <div class="ads col-lg col-md">
            <img class=" pb-8" src="./public./assets/img/ads1.png" alt="ads1">
            <img class=" " src="./public/assets/img/ads2.png" alt="ads2">
        </div>
    </div>

    <div class="hot-deal" id="hot-deal">
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

    <div class="sale" id="sale">
        <h3>KHYẾN MÃI</h3>
        <div class="sale-content">
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