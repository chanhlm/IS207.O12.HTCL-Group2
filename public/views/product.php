<link rel="stylesheet" href="./public/assets/css/product.css" />
<link rel="stylesheet" href="./public/assets/css/magnify.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

<?php
if (isset($_GET['product'])) {
    $id = trim($_GET['product']);

    // Câu truy vấn lấy thông tin sản phẩm
    $sqlProduct = "SELECT
        P.PRODUCT_NAME,
        P.PRODUCT_DESCRIPTION,
        P.PRODUCT_IMAGE,
        P.IMAGE_SRC,
        P.PRODUCT_SALEPRICE,
        P.warranty_period,
        P.PRODUCT_STATUS,
        P.category_id,
        B.BRAND_NAME,
        C.CATEGORY_NAME
    FROM PRODUCTS P JOIN BRANDS B ON P.BRAND_ID = B.BRAND_ID JOIN CATEGORIES C ON P.CATEGORY_ID = C.CATEGORY_ID
    WHERE trim(P.PRODUCT_ID) = ?;";

    $stmtProduct = mysqli_prepare($connect, $sqlProduct);
    $resultProduct;

    if ($stmtProduct) {
        mysqli_stmt_bind_param($stmtProduct, "s", $id);
        mysqli_stmt_execute($stmtProduct);
        $resultProduct = mysqli_stmt_get_result($stmtProduct);

        if ($resultProduct) {
            $rowProduct = mysqli_fetch_assoc($resultProduct);

            if ($rowProduct) {
                $name = $rowProduct['PRODUCT_NAME'];
                $description = $rowProduct['PRODUCT_DESCRIPTION'];
                $image = $rowProduct['PRODUCT_IMAGE'];
                $warranty = $rowProduct['warranty_period'];
                $brand = $rowProduct['BRAND_NAME'];
                $category_id = $rowProduct['category_id'];
                $category = $rowProduct['CATEGORY_NAME'];

                $salePrice = $rowProduct['PRODUCT_SALEPRICE'];
                $formattedSalePrice = number_format($salePrice, 0, ',', '.');

                $imageSrc = $rowProduct['IMAGE_SRC'];
                $imageSrc = explode(",", $imageSrc);
            }
        }
    }

    // Câu truy vấn lấy thông tin khuyến mãi
    $sqlPromotions = "SELECT 
        P.PROMOTION_ID,
        P.PROMOTION_CODE,
        P.PROMOTION_STARTDATE,
        P.PROMOTION_ENDDATE,
        CD.CODE_NAME,
        CD.CODE_PERCENT,
        CD.CODE_DESCRIPTION
    FROM PROMOTION P JOIN CODE_DISCOUNT CD ON P.PROMOTION_CODE = CD.CODE_ID 
    WHERE P.PRODUCT_ID = ? ORDER BY CODE_PERCENT DESC";

    $stmtPromotions = mysqli_prepare($connect, $sqlPromotions);
    $resultPromotions;

    $promotions = array(); // Initialize outside the loop

    if ($stmtPromotions) {
        mysqli_stmt_bind_param($stmtPromotions, "s", $id);
        mysqli_stmt_execute($stmtPromotions);
        $resultPromotions = mysqli_stmt_get_result($stmtPromotions);

        while ($rowPromotion = mysqli_fetch_assoc($resultPromotions)) {
            // Lấy thông tin khuyến mãi
            $promotionId = $rowPromotion['PROMOTION_ID'];
            $promotionCode = $rowPromotion['PROMOTION_CODE'];
            $promotionStartDate = $rowPromotion['PROMOTION_STARTDATE'];
            $promotionEndDate = $rowPromotion['PROMOTION_ENDDATE'];
            $codeName = $rowPromotion['CODE_NAME'];
            $codePercent = $rowPromotion['CODE_PERCENT'];
            $codeDescription = $rowPromotion['CODE_DESCRIPTION'];

            $startDate = new DateTime($promotionStartDate);
            $endDate = new DateTime($promotionEndDate);
            $currentDate = new DateTime();

            // Check if the current date is within the promotion period
            if ($currentDate >= $startDate && $currentDate <= $endDate) {
                // Calculate the discounted price for the current promotion
                $discountedPrice = $salePrice * (1 - $codePercent / 100);
                // if ($discountedPrice < 0) {
                //     $discountedPrice = $salePrice;
                // }

                $formattedDiscountedPrice = number_format($discountedPrice, 0, ',', '.');

                

                // Store information about the current promotion in the array
                $promotions[] = array(
                    'promotionId' => $promotionId,
                    'promotionCode' => $promotionCode,
                    'promotionStartDate' => $promotionStartDate,
                    'promotionEndDate' => $promotionEndDate,
                    'codeName' => $codeName,
                    'codePercent' => $codePercent,
                    'codeDescription' => $codeDescription,
                    'discountedPrice' => $discountedPrice,
                    'formattedDiscountedPrice' => $formattedDiscountedPrice,
                );
            }
        }
    }
}
?>


<section style="clear: both;" class="">
    <ul class="breadcrumb">
        <li>
            <a href="./index.php">Trang chủ</a>
        </li>
        <li>
            <span> > </span>
            <a href="./index.php?page=category&category=<?php echo $category_id; ?>"> <?php echo $category; ?> </a>
        </li>
        <li>
            <span> > </span>
            <a href="#"> <?php echo $brand; ?> </a>
        </li>
        <li>
            <span> > </span>
            <a href=""> <?php echo $name; ?> </a>
        </li>


    </ul>
    <div class="f-flex">
        <div class="name-product">
            <h1> <?php echo $name ?></h1>
        </div>
        <div class="rate--box">
            <div class="rate--box-left">
                <div class="detail-rate">
                    <p>
                        <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                        <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                        <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                        <i class="fa-solid fa-star" style="color: #fafe16;"></i>
                        <i class="fa-solid fa-star" style="color: #fafe16;"></i>

                    </p>
                    <p class="detail-rate-total">
                        119
                        <span> đánh giá </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="main--box ">
        <div class="left-box col-7 row">
            <div class="main--img-box">
                <img src="<?php echo $image ?>" id="mainImage" class="main-image zoom" data-magnify-src="<?php echo $image ?>">
            </div>
            <div class="small--imgs">
                <?php
                echo '<div class="img-box" onclick="changeMainImage(\'' . $image . '\')"><img src="' . $image . '" class="image" ></div>';
                for ($i = 0; $i < count($imageSrc); $i++) {
                    echo '<div class="img-box" onclick="changeMainImage(\'' . $imageSrc[$i] . '\')"><img src="' . $imageSrc[$i] . '" class="image"></div>';
                }
                ?>
            </div>
            <div class="rating--box row">
                <div class="boxrate-topzone">
                    <h2 class="boxrate-title"> Đánh giá <?php echo $name ?></h2>
                    <div class="boxrate-top">
                        <div class="boxrate-top-left">
                            <div class="total-star">
                                <div class="point">F
                                    <span> 5.0/5 </span> <br>
                                    <i class="fa-solid fa-star checked"></i>
                                    <i class="fa-solid fa-star checked"></i>
                                    <i class="fa-solid fa-star checked"></i>
                                    <i class="fa-solid fa-star checked"></i>
                                    <i class="fa-solid fa-star checked"></i>

                                </div>
                            </div>
                        </div>
                        <div class="boxrate-top-right">
                            <div class="box-star">
                                <div class="star-rating">
                                    <div class="5-star">
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <span class="number-rating"> 1 </span>
                                        <em> đánh giá </em>
                                    </div>
                                    <div class="4-star">
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star "></i>
                                        <span class="number-rating"> 0 </span>
                                        <em> đánh giá </em>
                                    </div>
                                    <div class="3-star">
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star "></i>
                                        <i class="fa-solid fa-star "></i>
                                        <span class="number-rating"> 0 </span>
                                        <em> đánh giá </em>
                                    </div>
                                    <div class="2-star">
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star "></i>
                                        <i class="fa-solid fa-star "></i>
                                        <i class="fa-solid fa-star "></i>
                                        <span class="number-rating"> 0 </span>
                                        <em> đánh giá </em>
                                    </div>
                                    <div class="1-star">
                                        <i class="fa-solid fa-star checked"></i>
                                        <i class="fa-solid fa-star "></i>
                                        <i class="fa-solid fa-star "></i>
                                        <i class="fa-solid fa-star "></i>
                                        <i class="fa-solid fa-star "></i>
                                        <span class="number-rating"> 0 </span>
                                        <em> đánh giá </em>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rating-list">
                    <div class="par">
                        <div class="comment-list">
                            <div class="comment-top">
                                <p class="name-user"> Lê Minh Chánh </p>
                            </div>
                            <div class="comment-star">
                                <div class="comment-top-star">
                                    <i class="fa-solid fa-star checked"></i>
                                    <i class="fa-solid fa-star checked"></i>
                                    <i class="fa-solid fa-star checked"></i>
                                    <i class="fa-solid fa-star checked"></i>
                                    <i class="fa-solid fa-star checked"></i>
                                </div>
                            </div>
                            <div class="comment-content">
                                <p class="cmt-text">
                                    Sản phẩm rất tốt, hình ảnh sắc nét, âm thanh rất hay
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rating-write">
                    <form onsubmit="" class="content-rating-write">
                        <input id="skw" type="text" class="input-rating" placeholder="Viết đánh giá của bạn..." name="ratetext" autocomplete="off" maxlength="10000">
                        <input type="submit" value="Gửi" id="submit-rating" onclick="">
                    </form>
                </div>

            </div>
        </div>
        <div class="right-box col">
            <!-- <div class="pick-size-box">
                    <a href="#" class="size-box"> 43 inch </a>
                    <a href="#" class="size-box"> 50 inch </a>
                    <a href="#" class="size-box"> 55 inch </a>
                    <a href="#" class="size-box"> 65 inch </a>
                    <a href="#" class="size-box"> 75 inch </a>
                </div> -->
            <!-- <div class="locate-price-box">
                    Giá tại
                    <a href="#" onclick=""> Hồ Chí Minh </a>
                </div> -->
            <div class="post--box">
                <div class="bs-title">
                    <div class="bs-price">
                        <?php
                        if (count($promotions) > 0 && $promotions[0]['discountedPrice'] > 0) {
                            echo '<strong>' . $promotions[0]['formattedDiscountedPrice'] . ' VNĐ </strong>';
                            echo '<em>' . $formattedSalePrice . ' VNĐ</em> ' . '  (-' . $promotions[0]['codePercent'] . '%)';
                        } else {
                            echo '<strong>' . $formattedSalePrice . ' VNĐ</strong>';
                        }
                        ?>


                    </div>
                    <!-- <div class="bs-time">
                            <span> Kết thúc sau </span>
                            <div class="clock" id="clock-bb">
                                <b>22</b>
                                <i>:</i>
                                <b>55</b>
                            </div>
                            <div class="date" id="date-bb">
                                <b>30</b>
                                <b>/</b>
                                <b>10</b>
                            </div>
                        </div> -->
                </div>
                <div class="bs-content">
                    <div class="promo-box">
                        <div class="pr-top">
                            <?php
                            if (count($promotions) > 0)
                                echo '<p class="pr-text-box">Khuyến mãi</p>
                                <i class="pr-text">Giá và khuyến mãi có thể kết thúc sớm hơn dự kiến </i>';
                            ?>

                        </div>
                        <div class="pr-content">
                            <div class="pr-item">
                                <div class="content-pr-box">
                                    <?php
                                    $stt = 1;
                                    echo '<div class="content-pr">';
                                    for ($i = 0; $i < count($promotions); $i++) {
                                        echo '<p> <bold>' . $stt . '</bold> - ' . $promotions[$i]['codeName'] . ' <a href="#">(Xem chi tiết tại đây) </a> </p>';
                                        $stt++;
                                    }
                                    echo '</div>';
                                    ?>
                                </div>

                                <div class="content-pr-box">
                                    <div class="content-pr">
                                        <ul class="content-pr-box-li">
                                            <li> Giao hàng nhanh chóng (tùy khu vực)</li>
                                            <!-- <li> Mỗi số điện thoại chỉ mua 3 sản phẩm trong 1 tháng</li> -->
                                            <li> Giá và khuyến mãi có thể kết thúc sớm </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="content-pr-box">
                                    <!-- <div class="content-pr">
                                        <p> Giao tới KTX Khu A, phường Linh Trung, TP. Thủ Đức, TP. Hồ Chí Minh
                                            <a href="#">(Đổi) </a>
                                        </p>
                                    </div> -->
                                </div>
                                <div class="content-pr-box">
                                    <div class="content-pr">
                                        <p> Thời gian giao hàng trong ngày từ 8h - 20h</p>
                                    </div>
                                </div>
                                <div class="content-pr-box">
                                    <div class="content-pr">
                                        <p> Miễn phí giao hàng
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="add-to-card">
                <!-- <form action="?" method="post"> -->
                <fieldset>
                    <input type="hidden" name="productId" id="productId" value="<?php echo $id ?>">
                    <input type="hidden" name="productName" id="productName" value="<?php echo $name ?>">
                    <input type="hidden" name="productPrice" id="productPrice" value="<?php echo $salePrice ?>">
                    <input type="hidden" name="productImage" id="productImage" value="<?php echo $image ?>">
                    <input type="hidden" name="productQuantity" id="productQuantity" value="1">
                    <input type="hidden" name="productDiscountedPrice" id="productDiscountedPrice" value="<?php echo $discountedPrice ?>">
                    <input type="submit" name="addcart-button" value="Thêm vào giỏ hàng" class="btn btn-warning opacity-75 mt-2 w-50" onclick="addToCart()">
                </fieldset>
                <!-- </form> -->
            </div>

            <div class="product-detail">
                <div class="card p-3 mt-5">
                    <h5>THÔNG TIN SẢN PHẨM:</h5>
                    <?php echo  $description ?>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="details--box"></div> -->
</section>

<script src="./public/assets/js/jquery.magnify.js" charset="UTF-8"></script>

<script>
    function changeMainImage(newSrc) {
        // Thay đổi thuộc tính src của ảnh lớn
        $('#mainImage').attr('src', newSrc);
        $('#mainImage').attr('data-magnify-src', newSrc);

        //cho ảnh nhỏ sau khi click
        $(document).ready(function() {
            $('.zoom').magnify();
        });
    }
</script>

<!-- Cho ảnh lớn đầu tiên -->
<script>
    $(document).ready(function() {
        $('.zoom').magnify();
    });
</script>


<script>
    function addToCart() {
        // Lấy thông tin sản phẩm từ các thẻ HTML
        let productId = document.querySelector('#productId').value;
        let productName = document.querySelector('#productName').value;
        let productPrice = document.querySelector('#productPrice').value;
        let productImage = document.querySelector('#productImage').value;
        let productDiscountedPrice;
        if (document.querySelector('#productDiscountedPrice').value == 0) {
            productDiscountedPrice = productPrice;
        } else
            productDiscountedPrice = document.querySelector('#productDiscountedPrice').value;

        let productQuantity = 1; // Số lượng mặc định là 1

        // Lưu sản phẩm vào giỏ hàng trong local storage
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let itemIndex = cart.findIndex(item => item.productId === productId);

        if (itemIndex >= 0) {
            // Nếu sản phẩm đã có trong giỏ hàng, tăng số lượng lên 1
            cart[itemIndex].productQuantity++;
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, thêm sản phẩm vào giỏ hàng
            cart.push({
                productId: productId,
                productName: productName,
                productPrice: productPrice,
                productImage: productImage,
                productQuantity: productQuantity,
                productDiscountedPrice: productDiscountedPrice
            });
            alert('Thêm sản phẩm vào giỏ hàng thành công!');
        }

        localStorage.setItem('cart', JSON.stringify(cart));
    }
</script>