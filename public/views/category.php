<link rel="stylesheet" href="./public/assets/css/list-product.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

<?php
if (isset($_GET['category'])) {
    $id = $_GET['category'];

    $sql = "SELECT * FROM products WHERE CATEGORY_ID = ? AND PRODUCT_STATUS = 'active'";
} else if (isset($_GET['search'])) {
    $search = $_GET['search'];

    $sql = "SELECT * FROM products WHERE PRODUCT_NAME LIKE '%$search%' AND PRODUCT_STATUS = 'active'";
}
?>

<section class="cate-main-container">
    <div class="box-filter top-box block-scroll-main cate">
        <section>
            <div class="jsfix scrolling__inner">
                <div class="box-filter block-scroll-main scrolling">
                    <div class="scroll-btn show-right" style="display:none;">
                        <div class="btn-right-scroll"></div>
                    </div>
                    <div class="filter-total">
                        <div class="filter-item__title jsTitle" onclick="toggleFilter('show-total')">
                            <div class="arrow-filter">
                                <i class="ti-filter"> Bộ lọc </i>
                                <strong class="number count-total" style="display:none;"></strong>
                            </div>
                        </div>
                        <div class="filter-show" id="show-total">
                            <div class="list-filter-active" style="display:none;"> </div>
                            <div class="show-total-main"> </div>
                        </div>
                    </div>

                    <div class="filter-item block-manu">
                        <div class="filter-item__title jsTitle" onclick="toggleFilter('filter-show')">
                            <div class="arrow-filter"></div>
                            <span> Hãng </span>
                        </div>
                        <div class="filter-show hascount" id="filter-show" style="display:none;">
                            <div class="filter-list filter-list--hang manu">
                                <a href="#" data-href="tivi-samsung" data-index="0" class="c-btnbox filter-manu" onclick="filterByBrand('Samsung')">
                                    <img src="E:\PHATTRIENWEB\ĐỒ ÁN\asset\IMG\Samsung1942-b_51.png" width="68" height="30" alt="Samsung">
                                </a>
                                <!-- Add more brand filter links as needed -->
                            </div>
                            <div class="filter-button">
                                <a href="#" class="btn-filter-close" onclick="toggleFilter('filter-show')"> Bỏ chọn </a>
                                <a href="#" class="btn-filter-readmore">
                                    Xem <b class="total-reloading"> xxx </b> kết quả
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="filter-item">
                        <div class="filter-item__title jsTitle noselecttext">
                            <div class="arrow-filter"></div>
                            <span> Kích cỡ màn hình </span>
                        </div>
                        <div class="filter-show" style="display:none;"></div>
                    </div> -->
                    <div class="filter-item warpper-price-outside">
                        <div class="filter-item__title jsTitle" onclick="toggleFilter('filter-show-price')">
                            <div class="arrow-filter"></div>
                            <span> Giá </span>
                        </div>
                        <div class="filter-show p-3" id="filter-show-price" style="display:none;">
                            <label for="price-range">Price Range:</label>

                            <!-- Buttons for predefined price ranges -->
                            <button class="price-range-button" data-min="0" data-max="500000">0 - 500,000</button>
                            <button class="price-range-button" data-min="500000" data-max="1000000">500,000 - 1,000,000</button>
                            <button class="price-range-button" data-min="1000000" data-max="5000000">1,000,000 - 5,000,000</button>
                            <button class="price-range-button" data-min="5000000" data-max="10000000">5,000,000 - 10,000,000</button>
                            <button class="price-range-button" data-min="10000000" data-max="20000000">10,000,000 - 20,000,000</button>
                            <button class="price-range-button" data-min="20000000" data-max="max">20,000,000 - Trở lên</button>

                            <!-- Display values for the selected buttons -->
                            <div id="selected-range"></div>

                            <button onclick="applyPriceFilter()">Apply</button>
                        </div>

                    </div>
                    <!-- <div class="filter-item">
                        <div class="filter-item__title jsTitle noselecttext">
                            <div class="arrow-filter"></div>
                            <span> Độ phân giải </span>
                        </div>
                        <div class="filter-show" style="display:none;"></div>
                    </div> -->
                    <!-- <div class="filter-item">
                        <div class="filter-item__title jsTitle noselecttext">
                            <div class="arrow-filter"></div>
                            <span> Loại Tivi </span>
                        </div>
                        <div class="filter-show" style="display:none;"></div>
                    </div> -->
                    <!-- <div class="filter-item">
                        <div class="filter-item__title jsTitle noselecttext">
                            <div class="arrow-filter"></div>
                            <span> Tiện ích </span>
                        </div>
                        <div class="filter-show" style="display:none;"></div>
                    </div> -->
                    <!-- <div class="filter-item">
                        <div class="filter-item__title jsTitle noselecttext">
                            <div class="arrow-filter"></div>
                            <span> Hệ điều hành </span>
                        </div>
                        <div class="filter-show" style="display:none;"></div>
                    </div> -->
                </div>
            </div>
            <!-- <div class="box-quicklink block-scroll-main">
                <div class="list-quickfilter q-manu">
                    <a href="#" data-href="tivi-samsung" data-index="0" class="box-quicklink__item bd-radius quicklink-logo">
                        <img src="E:\PHATTRIENWEB\ĐỒ ÁN\asset\IMG\Samsung1942-b_51.png" width="30" class="no-text">
                    </a>
                    
                </div>
                <div class="list-quicklink"></div>
            </div> -->
        </section>
    </div>
    <div id="categoryPage" class="desktop cate" data-name="TV" data-template="cate">
        <div class="box-sort">
            <p class="sort-total">
                <?php
                if (isset($_GET['category'])) {
                    $name;
                    $count;

                    $stmt = mysqli_prepare($connect, $sql);

                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "s", $id);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $count = mysqli_num_rows($result);
                        echo "<b> " . $count . " </b> ";
                    }
                    $sql_name = "SELECT * FROM categories WHERE CATEGORY_ID = ?";
                    $stmt = mysqli_prepare($connect, $sql_name);

                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "s", $id);
                        mysqli_stmt_execute($stmt);
                        $categoryResult = mysqli_stmt_get_result($stmt);

                        if ($category = mysqli_fetch_assoc($categoryResult)) {
                            $name = $category['CATEGORY_NAME'];
                        }
                        echo "<span> - " . $name . " </span>";
                    }
                } else {
                }

                ?>
            </p>
            <!-- <div class="box-checkbox extend">
                <label for="checkbox1" class="c-checkitem">
                    <input type="checkbox" id="checkbox1" data-href data-type="sp2020" class=" tick-checkbox filter-checkbox">
                    <p class="pb-0"> Giảm giá </p>
                </label>

                <label for="checkbox2" class="c-checkitem">
                    <input type="checkbox" id="checkbox2" data-href="-tra-gop-0-phan-tram" data-type="installment0" class="tick-checkbox filter-checkbox">
                    <p> Góp 0% - 1% </p>
                </label>

                <label for="checkbox3" class="c-checkitem">
                    <input type="checkbox" id="checkbox3" data-href data-type="monopoly" class="tick-checkbox filter-checkbox">
                    <p> Đặc quyền tại SHOP </p>
                </label>

                <label for="checkbox4" class="c-checkitem">
                    <input type="checkbox" id="checkbox4" data-href="-moi" data-type="new" class="tick-checkbox filter-checkbox">
                    <p> Mới nhất </p>
                </label>
            </div> -->
            <div class="sort-select">
                <p class="click-sort">
                    Xếp theo:
                    <span class="sort-show">
                        Nổi bật
                    </span>
                </p>
                <div class="sort-select-main-sort"></div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="container-productbox">
            <div id="preloader">
                <div id="loader"></div>
            </div>
            <ul class="listproduct">
                <?php

                $stmt = mysqli_prepare($connect, $sql);

                if ($stmt) {
                    if (isset($_GET['category'])) {
                        mysqli_stmt_bind_param($stmt, "s", $id);
                    }

                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $salePrice = $row['PRODUCT_SALEPRICE'];
                        $formattedSalePrice = number_format($salePrice, 0, ',', '.');

                        // Bổ sung phần hiển thị thông tin khuyến mãi
                        $productPromotions = getProductPromotions($connect, $row['PRODUCT_ID']);
                        $promotionInfo = getAppliedPromotionInfo($productPromotions);

                        if ($promotionInfo) {
                            $discountedPrice = $salePrice * (100 - $promotionInfo['CODE_PERCENT']) / 100;
                            $formattedDiscountedPrice = number_format($discountedPrice, 0, ',', '.');

                            $str = 'data-price=' . $discountedPrice .' ';
                        } else {
                            $formattedDiscountedPrice = $formattedSalePrice;
                            $str = 'data-price=' . $salePrice .' ';
                        }
                        

                        

                        echo "<li class='item__cate' data-index='1' style='height: 420px' $str >
                                <a href='index.php?page=product&product=" . $row['PRODUCT_ID'] . "' data-s='TwoPrice' data-site='2' data-pro='3' data-name='" . $row['PRODUCT_NAME'] . "' class='main-contain'>
                            <div class='item-img item-img'>
                                <img class='thumb ls-is-cached lazyloaded' src='" . $row['PRODUCT_IMAGE'] . "'>
                            </div>
                                <h3>" . $row['PRODUCT_NAME'] . "</h3>
                                    <div class='box-p'>";

                        if ($promotionInfo) {
                            echo "<p class='price-old black m-0'>$formattedSalePrice VNĐ</p>";
                            echo "<span class='percent'> - {$promotionInfo['CODE_PERCENT']}% </span>";
                            echo '</div>';
                            echo '<strong class="item"  >' . $formattedDiscountedPrice . ' VNĐ </strong>';
                        } else {
                            echo "<p class='price-old black m-0' style='visibility: hidden;'>$formattedSalePrice VNĐ</p>";
                            echo "<span class='percent' style='visibility: hidden;'> - 0% </span>";
                            echo '</div>';
                            echo '<strong class="item" data-price="' . $salePrice . ' " >' . $formattedSalePrice . ' VNĐ </strong>';
                        }
                        echo "
                        <div class='item-rating'>
                            <p>
                                <i class='fa-solid fa-star' style='color: #fafe16;'></i>
                                <i class='fa-solid fa-star' style='color: #fafe16;'></i>
                                <i class='fa-solid fa-star' style='color: #fafe16;'></i>
                                <i class='fa-solid fa-star' style='color: #fafe16;'></i>
                                <i class='fa-solid fa-star' style='color: #fafe16;'></i>
                            </p>
                            <p class='item-rating-total'> 133 </p>
                        </div>
                    </a>
                </li>";
                    }
                }

                // Hàm lấy thông tin khuyến mãi của sản phẩm
                function getProductPromotions($connect, $productId)
                {
                    $promotions = array();

                    $sqlPromotions = "SELECT 
                        P.PROMOTION_ID,
                        P.PROMOTION_CODE,
                        P.PROMOTION_STARTDATE,
                        P.PROMOTION_ENDDATE,
                        CD.CODE_NAME,
                        CD.CODE_PERCENT,
                        CD.CODE_DESCRIPTION
                    FROM PROMOTION P JOIN CODE_DISCOUNT CD ON P.PROMOTION_CODE = CD.CODE_ID 
                    WHERE P.PRODUCT_ID = ?;";

                    $stmtPromotions = mysqli_prepare($connect, $sqlPromotions);

                    if ($stmtPromotions) {
                        mysqli_stmt_bind_param($stmtPromotions, "s", $productId);
                        mysqli_stmt_execute($stmtPromotions);
                        $resultPromotions = mysqli_stmt_get_result($stmtPromotions);

                        while ($rowPromotion = mysqli_fetch_assoc($resultPromotions)) {
                            $promotions[] = $rowPromotion;
                        }
                    }

                    return $promotions;
                }

                // Hàm lấy thông tin khuyến mãi được áp dụng
                function getAppliedPromotionInfo($promotions)
                {
                    foreach ($promotions as $promotion) {
                        $now = time();
                        $startDate = strtotime($promotion['PROMOTION_STARTDATE']);
                        $endDate = strtotime($promotion['PROMOTION_ENDDATE']);

                        // Kiểm tra xem khuyến mãi có hiệu lực không
                        if ($now >= $startDate && $now <= $endDate) {
                            return $promotion;
                        }
                    }

                    return null;
                }
                ?>



            </ul>

            <!-- ... Your existing HTML code ... -->

            <!-- <div class="view-more">
                <a href="#" class="show-more">Xem thêm <span class="remain"><?php echo $count - 20; ?></span> Sản phẩm</a>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script>
                $(document).ready(function() {
                    var itemsToShow = 20;

                    // Show only the first 20 items initially
                    $('.listproduct li:lt(' + itemsToShow + ')').show();

                    // Show more button click event
                    $('.show-more').click(function() {
                        // Toggle visibility of additional products
                        $('.listproduct li:hidden').toggle();
                    });
                });
            </script> -->

        </div>
    </div>
</section>

<script>
    function filterByBrand(brand) {
        console.log('Filtering by brand:', brand);
    }

    function toggleFilter(filterId) {
        var filterShow = document.getElementById(filterId);
        filterShow.style.display = (filterShow.style.display === 'none') ? 'block' : 'none';
    }

    function applyPriceFilter() {
        var selectedButton = document.querySelector('.price-range-button.selected');

        if (selectedButton) {
            var minPrice = parseFloat(selectedButton.getAttribute('data-min')) || 0;
            var maxPrice = parseFloat(selectedButton.getAttribute('data-max')) || Number.POSITIVE_INFINITY;

            // Hide all items
            var items = document.querySelectorAll('.item__cate');
            console.log('Items:', items);
            items.forEach(function(item) {
                item.style.display = 'none';
            });

            // Show items within the selected price range
            items.forEach(function(item) {
                var itemPrice = parseFloat(item.getAttribute('data-price'));
                console.log('Item price:', itemPrice);
                if (itemPrice >= minPrice && itemPrice <= maxPrice) {
                    item.style.display = 'block';
                }
            });
        } else {
            // Handle the case where no button is selected (e.g., "None" case)
            console.log('No button selected');
        }
    }



    function updateDisplayedValues() {
        var selectedButton = document.querySelector('.price-range-button.selected');
        var selectedValue = selectedButton ? `${selectedButton.getAttribute('data-min')} - ${selectedButton.getAttribute('data-max')}` : 'None';
        document.getElementById('selected-range').textContent = selectedValue;
    }

    // Event listener for the buttons
    var buttons = document.querySelectorAll('.price-range-button');
    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            buttons.forEach(function(btn) {
                btn.classList.remove('selected');
            });
            this.classList.add('selected');
            updateDisplayedValues();
        });
    });
</script>