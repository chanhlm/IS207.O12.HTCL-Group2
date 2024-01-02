<?php
function getOrderDetails()
{
    //thay csdl sau này
    global $connect;
    $user_phone = $_SESSION['phone'];
    $id = $_GET['id'];

    $sql_order = "SELECT * FROM `orders`, `users` WHERE `orders`.`user_phone` ='" . $user_phone . "' AND `order_id` = " . $id;
    $result_order = mysqli_query($connect, $sql_order);
    $order_row = $result_order->fetch_assoc();

    if ($order_row['ORDER_STATUS'] == 0) {
        $status = "Chờ tiếp nhận";
    } else if ($order_row['ORDER_STATUS'] == 1) {
        $status = "Đang xử lí";
    } else if ($order_row['ORDER_STATUS'] == 2) {
        $status = "Đang giao hàng";
    } else if ($order_row['ORDER_STATUS'] == 3) {
        $status = "Đã giao hàng";
    } else {
        $status = "Đã hủy";
    }

    if ($order_row['ORDER_SHIPPING'] == 0)
        $shipping = "Tại cửa hàng (Đường Hàn Thuyên, khu phố 6, phường Linh Trung, TP.Thủ Đức, TP.Hồ Chí Minh)";
    else if ($order_row['ORDER_SHIPPING'] == 1)
        $shipping = $order_row['USER_ADDRESS'];

    $product_list = array();
    $sql = "SELECT * FROM `order_details`, `products` WHERE `order_details`.`order_id` = " . $id . " and `order_details`.`product_id` = `products`.`product_id` ";
    $result = mysqli_query($connect, $sql);

    while ($product_row = $result->fetch_assoc()) {
        $product_list[] = array(
            'productId' => $product_row['PRODUCT_ID'],
            'productName' => $product_row['PRODUCT_NAME'],
            'imageURL' => $product_row['PRODUCT_IMAGE'],
            'warranty' => 'Bảo hành: Còn BH đến 03/08/2024',
            'voucher' => '0 khuyến mãi',
            'quantity' => $product_row['ORDER_DETAIL_QUANTITY'],
            'price' => number_format($product_row['ORDER_DETAIL_PRICE'], 0, ',', '.') . ' ₫',
            'originalPrice' => number_format($product_row['ORDER_DETAIL_PRICE'], 0, ',', '.') . ' ₫',
        );
    }
    $orderId = str_pad($order_row['ORDER_ID'], 6, '0', STR_PAD_LEFT);
    $date = date_format(date_create($order_row['ORDER_DATE']), 'd/m/Y H:i:s');

    return array(
        'userName' => $order_row['USER_NAME'],
        'orderNumber' => $orderId,
        'status' => $status,
        'orderDate' => $date,
        'deliveryAddress' => $shipping,
        'userPhone' => $order_row['USER_PHONE'],
        'deliveryMethod' => 'Thanh toán khi nhận hàng',
        'products' => $product_list,
        'totalPrice' => number_format($order_row['ORDER_TOTAL'], 0, ',', '.') . ' ₫',
    );
}

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
                    <span class="status"><?php echo $orderDetails['status']; ?></span>
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
                                    <p class="cus__address fs-6">
                                        <span> Địa chỉ nhận hàng: </span>
                                        <?php echo $orderDetails['deliveryAddress']; ?>
                                    </p>
                                    <p class="cus__phone">
                                        <span>Điện thoại: </span> <?php echo $orderDetails['userPhone']; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="style_orderInfo">
                                <div class="title"> HÌNH THỨC THANH TOÁN </div>
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
                                            <a href="./index.php?page=product&product=<?php echo $product['productId'] ?> ">
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
                                <div class="text-price"> <?php echo $orderDetails['totalPrice']; ?></div>
                            </div>
                            <div class="total_price">
                                <?php
                                if ($orderDetails['status'] == "Đã giao hàng" || $orderDetails['status'] == "Đã hủy") {
                                    echo '<div class="txt"> Tổng tiền đã thanh toán: </div>';
                                } else {
                                    echo '<div class="txt"> Tổng tiền cần thanh toán: </div>';
                                }
                                ?>
                                <div class="txt-price"> <?php echo $orderDetails['totalPrice']; ?> </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="back_toOrder align-center">
                <a class="back_Order" href="./index.php?page=purchase-history"> Về trang danh sách đơn hàng </a>
            </div>
        </div>
    </div>
</section>