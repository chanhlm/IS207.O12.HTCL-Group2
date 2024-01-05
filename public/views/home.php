<?php
$sql_product = "SELECT * FROM products, promotion WHERE products.PRODUCT_ID = promotion.PRODUCT_ID";
$result_product = mysqli_query($connect, $sql_product);

$products = array();

while ($row = mysqli_fetch_assoc($result_product)) {
    $sql_promotion = "SELECT * from PROMOTION, CODE_DISCOUNT where PROMOTION.PROMOTION_CODE = CODE_DISCOUNT.CODE_ID and PROMOTION.PRODUCT_ID = '" . $row["PRODUCT_ID"] . "'";
    $result_promotion = mysqli_query($connect, $sql_promotion);

    while ($row_promotion = mysqli_fetch_assoc($result_promotion)) {
        $saleDiscountedPrice = $row["PRODUCT_SALEPRICE"] - ($row["PRODUCT_SALEPRICE"] * $row_promotion["CODE_PERCENT"] / 100);
        $salePercent = $row_promotion["CODE_PERCENT"];


        $products[] = array(
            "id" => $row["PRODUCT_ID"],
            "name" => $row["PRODUCT_NAME"],
            "price" => $row["PRODUCT_SALEPRICE"],
            "image" => $row["PRODUCT_IMAGE"],
            "saleDiscountedPrice" => $saleDiscountedPrice,
            "discountPercent" => $salePercent
        );
    }
}



?>

<link rel="stylesheet" href="./public/assets/css/style.css" />


<style>
    .hide {
        display: none;
    }

    .hot-deal {
        text-align: center;
    }

    .hot-deal-content {
        display: flex;
        overflow: hidden;
    }

    .product {
        width: 300px !important;
        text-align: center;
        transition: transform 0.5s;
    }

    .product img {
        max-width: 100%;
        height: auto;
    }

    .see-all-btn {
        margin-top: 20px;
    }

    .btn {
        cursor: pointer;
    }

    .product-name {
        font-size: 8px;
    }
</style>

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
            <i class="ti-angle-double-left slide-btn pre-btn btn prev-button"></i>
            <?php
            $index = 1;
            foreach ($products as $product) {
                // echo "<script>console.log('" . $product["name"] . "')</script>";
                echo "<div class='product align-center slide'  idx='" . $index . "'> ";
                echo "<img src='" . $product["image"] . "' alt=''>";
                echo "<a href='./index.php?page=product&product=" . $product["id"] . "'>";
                echo "<p class='product-name mb-1'>" . $product["name"] . "</p>";
                echo "</a>";
                echo "<div class='d-flex justify-content-evenly'>";
                echo "<p class='product-price mb-1 text-decoration-line-through' style='font-size: 10px; '>" . number_format($product["price"], 0, ',', '.') . "đ</p>";
                echo "<p class='product-price mb-1' style='font-size: 10px;'> (" . $product["discountPercent"] . "%) </p>";
                echo "</div>";
                echo "<em class='product-price' style='color: red;'>" .  number_format($product["saleDiscountedPrice"], 0, ',', '.') . "đ</em>";
                echo "</div>";
                $index++;
            }

            ?>

            <i class="ti-angle-double-right slide-btn next-btn btn next-button"></i>
        </div>

        <div class="see-all-btn">
            <a href="#">XEM TẤT CẢ</a>
        </div>
    </div>

    <div class="sale" id="sale">
        <h3>KHUYẾN MÃI</h3>
        <div class="sale-content">
            <i class="ti-angle-double-left slide-btn pre-btn btn"></i>
            <?php
            $index = 1;
            foreach ($products as $product) {
                // echo "<script>console.log('" . $product["name"] . "')</script>";
                echo "<div class='product align-center slide'  idx='" . $index . "'> ";
                echo "<img src='" . $product["image"] . "' alt=''>";
                echo "<a href='./index.php?page=product&product=" . $product["id"] . "'>";
                echo "<p class='product-name mb-1'>" . $product["name"] . "</p>";
                echo "</a>";
                echo "<div class='d-flex justify-content-evenly'>";
                echo "<p class='product-price mb-1 text-decoration-line-through' style='font-size: 10px; '>" . number_format($product["price"], 0, ',', '.') . "đ</p>";
                echo "<p class='product-price mb-1' style='font-size: 10px;'> (" . $product["discountPercent"] . "%) </p>";
                echo "</div>";
                echo "<em class='product-price' style='color: red;'>" .  number_format($product["saleDiscountedPrice"], 0, ',', '.') . "đ</em>";
                echo "</div>";
                $index++;
            }

            ?>
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

<script>
    const slider = document.querySelector('.hot-deal-content');
    const nextBtn = document.querySelector('.next-btn');
    const prevBtn = document.querySelector('.pre-btn');

    let counter = 0;

    nextBtn.addEventListener('click', () => {
        counter++;
        updateSlider();
    });

    prevBtn.addEventListener('click', () => {
        counter--;
        updateSlider();
    });

    function updateSlider() {
        const groupWidth = document.querySelector('.product-group').offsetWidth;
        slider.style.transform = 'translateX(' + (-groupWidth * counter) + 'px)';
    }
</script>


<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        var length = $(".slide").length;
        console.log(length);

        var begin = 1;
        var end = 5;
        var currentState = "firstSet"; // Thêm biến giữ trạng thái

        $(".prev-button").click(function() {
            if (begin > 1) {
                $(".slide[idx=" + begin + "]").addClass("hide");
                $(".slide[idx=" + --begin + "]").removeClass("hide");
            } else if (currentState === "secondSet") {
                resetClassToBegin();
            }
            clearInterval(interval);
            timer();
        });

        $(".next-button").click(function() {
            if (end < length) {
                $(".slide[idx=" + end + "]").addClass("hide");
                $(".slide[idx=" + ++end + "]").removeClass("hide");
            } else if (currentState === "firstSet") {
                resetClassToEnd();
            }
            clearInterval(interval);
            timer();
        });

        var timer = function() {
            interval = setInterval(function() {
                $(".next-button").click();
            }, 3000);
        };

        var resetClassToBegin = function() {
            for (var i = 1; i <= 5; i++) {
                $(".slide[idx=" + i + "]").removeClass("hide");
            }
            for (var i = 6; i <= length; i++) {
                $(".slide[idx=" + i + "]").addClass("hide");
            }
            begin = 1;
            end = 5;
            currentState = "firstSet"; // Cập nhật trạng thái
        }

        var resetClassToEnd = function() {
            for (var i = 1; i <= 5; i++) {
                $(".slide[idx=" + i + "]").addClass("hide");
            }
            for (var i = 6; i <= length; i++) {
                $(".slide[idx=" + i + "]").removeClass("hide");
            }
            begin = 6;
            end = length;
            currentState = "secondSet"; // Cập nhật trạng thái
        }

        timer();
    });
</script>