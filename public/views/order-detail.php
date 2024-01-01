<?php
// Hàm giả định để lấy thông tin đơn hàng từ CSDL hoặc nơi khác
function getOrderDetails()
{
    //thay csdl sau này
    return array(
        'userName' => 'Minh Chánh',
        'orderNumber' => '428515030',
        'status' => 'delivered',
        'orderDate' => '22:08 09/08/2023',
        'deliveryAddress' => 'Ngõ A, KTX khu B làng ĐHQG, Dĩ An, Bình Dương',
        'userPhone' => '0909090909',
        'deliveryMethod' => 'Thanh toán khi nhận hàng',
        'products' => array(
            array(
                'productName' => 'Toshiba Smart TV 43V31MP',
                'imageURL' => 'https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/Products/Images/1942/279935/product-279935-110522-094032-550x340.jpg',
                'warranty' => 'Bảo hành: Còn BH đến 03/08/2024',
                'voucher' => '3 khuyến mãi',
                'quantity' => 1,
                'price' => '9.990.000₫',
                'originalPrice' => '12.390.000₫',
            ),
            // Thêm sản phẩm khác nếu cần
        ),
        'totalPrice' => '9.990.000₫',
    );
}

// Lấy thông tin đơn hàng
$orderDetails = getOrderDetails();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./public/assets/css/order-detail.css" />


<section class="container">
    <!-- <div class="profile_sidebar">
        <div class="account_shortInfo">
            <img src="https://lh4.googleusercontent.com/-Gy3L0NJRI-o/AAAAAAAAAAI/AAAAAAAAACM/-zKgibWkHLs/photo.jpg" alt="avatar">
            <div class="info">
                Tài khoản của
                <strong><?php echo $orderDetails['userName']; ?></strong>
            </div>
        </div>
        <div class="sidebar_nav">
            <div class="stardust-dropdown">
                <a class="header-holder" href="#">
                    <div class="header-icon">
                        <span class="fas fa-user-alt"></span>
                    </div>
                    <div class="header-content"><span class="header-ct">Thông tin tài khoản</span></div>
                </a>
            </div>
            <div class="stardust-dropdown">
                <a class="header-holder" href="#">
                    <div class="header-icon">
                        <span class="fas fa-user-alt"></span>
                    </div>
                    <div class="header-content"><span class="header-ct">Đơn mua</span></div>
                </a>
            </div>
            <div class="stardust-dropdown">
                <a class="header-holder" href="#">
                    <div class="header-icon">
                        <span class="fas fa-user-alt"></span>
                    </div>
                    <div class="header-content"><span class="header-ct">Thông báo</span></div>
                </a>
            </div>
            <div class="stardust-dropdown">
                <a class="header-holder" href="#">
                    <div class="header-icon">
                        <span class="fas fa-user-alt"></span>
                    </div>
                    <div class="header-content"><span class="header-ct">Voucher khuyến mãi</span></div>
                </a>
            </div>
        </div>
    </div> -->

    <div class="order__layout">
        <div style="display: contents">
            <div class="orderList-content">
                <div style="position: fixed; top: 0px; left: 0px;"></div>
                <div class="heading">
                    <span>Chi tiết đơn hàng #<?php echo $orderDetails['orderNumber']; ?></span>
                    <span class="split"> - </span>
                    <span class="status"><?php echo ($orderDetails['status'] === 'delivered') ? 'Đã nhận hàng' : 'Chưa giao hàng'; ?></span>
                    <div class="order__created__date">
                        Đã đặt lúc: <?php echo $orderDetails['orderDate']; ?>
                    </div>
                </div>

                <div class="order-detail">
                    <div class="productOrder-detail">
                        <div class="order__info">
                            <div class="style_orderInfo">
                                <div class="title">ĐỊA CHỈ NGƯỜI NHẬN </div>
                                <div class="content">
                                    <p class="cus__name"><?php echo $orderDetails['userName']; ?></p>
                                    <p class="cus__address">
                                        <span> Giao tại: </span>
                                        <?php echo $orderDetails['deliveryAddress']; ?>
                                    </p>
                                    <p class="cus__phone">
                                        <span>Điện thoại: </span> <?php echo $orderDetails['userPhone']; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="style_orderInfo">
                                <div class="title"> HÌNH THỨC GIAO HÀNG </div>
                                <div class="content">
                                    <p><?php echo $orderDetails['deliveryMethod']; ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="product-info">
                            <div class="title__orderproduct">Sản phẩm </div>
                            <div class="order-product-detail">
                                <?php foreach ($orderDetails['products'] as $product) : ?>
                                    <div class="detail-info">
                                        <div class="productDetail">
                                            <a href="#">
                                                <div class="image-product">
                                                    <img src="<?php echo $product['imageURL']; ?>" alt="<?php echo $product['productName']; ?>">
                                                </div>
                                                <div class="product_infoList">
                                                    <div class="product_name"><span><?php echo $product['productName']; ?></span></div>
                                                    <div class="product_warranty">
                                                        <span><?php echo $product['warranty']; ?></span>
                                                    </div>
                                                    <div class="voucher_shop">
                                                        <span><?php echo $product['voucher']; ?></span>
                                                    </div>
                                                    <div class="order_count"> Số lượng: <span><?php echo $product['quantity']; ?></span></div>
                                                </div>
                                                <div class="order_price" style="padding-left: 35%; margin-right: 10px;">
                                                    <strong class="price"><?php echo $product['price']; ?></strong>
                                                    <div class="box-p">
                                                        <p class="price-old black"><?php echo $product['originalPrice']; ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="order_total_price">
                            <div class="total_price">
                                <div class="text"> Tạm tính: </div>
                                <div class="text-price"><?php echo $orderDetails['totalPrice']; ?></div>
                            </div>
                            <div class="total_price">
                                <div class="text"> Tổng tiền: </div>
                                <div class="text-price"> 9.990.000₫ </div>
                            </div>
                            <div class="total_price">
                                <div class="txt"> Tổng tiền đã thanh toán: </div>
                                <div class="txt-price"> 9.990.000₫ </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="back_toOrder" style="padding-left: 35%">
                <a class="back_Order" href="./index.php?page=purchase-history"> Về trang danh sách đơn hàng </a>
            </div>
        </div>
    </div>
</section>