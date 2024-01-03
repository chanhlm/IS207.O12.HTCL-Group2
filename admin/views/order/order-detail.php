<?php
$order_id = $_GET['order_id'];
$sql = "SELECT * FROM ORDERS, USERS WHERE ORDERS.USER_PHONE = USERS.USER_PHONE AND ORDERS.ORDER_ID = $order_id";
$result = mysqli_query($connect, $sql);
$order = mysqli_fetch_assoc($result);


if ($order['ORDER_STATUS'] == 0) {
    $status = "Chờ tiếp nhận";
} else if ($order['ORDER_STATUS'] == 1) {
    $status = "Đang xử lí";
} else if ($order['ORDER_STATUS'] == 2) {
    $status = "Đang giao hàng";
} else if ($order['ORDER_STATUS'] == 3) {
    $status = "Đã giao hàng";
} else {
    $status = "Đã hủy";
}

$sql = "SELECT * FROM ORDER_DETAILS, PRODUCTS WHERE ORDER_ID = $order_id AND ORDER_DETAILS.PRODUCT_ID = PRODUCTS.PRODUCT_ID";
$result = mysqli_query($connect, $sql);
// $order_detail = mysqli_fetch_assoc($result);

$sql = "SELECT sum(ORDER_DETAIL_QUANTITY) AS count FROM ORDER_DETAILS WHERE ORDER_ID = $order_id";
$count = mysqli_query($connect, $sql);
$count_product = mysqli_fetch_assoc($count);

?>

<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="./index.php"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Đơn hàng </li>
                        <li class="breadcrumb-item active" aria-current="page">Mã đơn #<?php echo str_pad($order_id, 6, '0', STR_PAD_LEFT) ?> </li>
                    </ol>
                </nav>
            </div>
        </div>


        <hr />
        <!-- insert form -->
        <div class="card">
            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="order-date" class="form-label">Ngày đặt hàng</label>
                                <input type="text" class="form-control" id="order-date" name="order-date" value="<?php echo date_format(date_create($order['ORDER_DATE']), 'd/m/Y H:i:s'); ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Trạng thái đơn hàng</label>
                                <input type="text" class="form-control" id="status" name="status" value="<?php echo $status ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- Các trường thông tin khác -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $order['USER_PHONE']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên khách hàng</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $order['USER_NAME']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="delivery-address" class="form-label">Địa chỉ nhận hàng</label>
                            <input type="text" class="form-control" id="delivery-address" name="delivery-address" value="<?php echo $order['USER_ADDRESS']; ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Số sản phẩm</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $count_product['count'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="total" class="form-label">Tổng hóa đơn</label>
                                <input type="text" class="form-control" id="total" name="total" value="<?php echo number_format($order['ORDER_TOTAL'], 0, ',', '.') . ' ₫' ?>" readonly>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <br>
        <div class="cart">
            <div class="cart-body">
                <?php
                while ($row_order_detail = mysqli_fetch_assoc($result)) {
                    $sql_warranty = "SELECT * FROM `order_details` INNER JOIN `warranty` ON `warranty`.`order_detail_id` = `order_details`.`order_detail_id` and `order_details`.`order_detail_id` = " . $row_order_detail['ORDER_DETAIL_ID'] . "";
                    $result_warranty = mysqli_query($connect, $sql_warranty);

                    if ($result_warranty->num_rows > 0) {
                        $warranty_row = $result_warranty->fetch_assoc();

                        if ($warranty_row['END_DATE'] > date("Y-m-d H:i:s"))
                            $warranty = "Bảo hành: Còn BH đến " . date_format(date_create($warranty_row['END_DATE']), 'd/m/Y');
                        else
                            $warranty = "Bảo hành: Đã hết hạn";
                    } else {
                        $warranty = "null";
                    }

                    // echo '<div class="cart-item">';
                    echo '<div class="row">';
                    echo '<div class="col-md-2">';
                    echo '<img src="' . $row_order_detail['PRODUCT_IMAGE'] . '" alt="" class="img-fluid">';
                    echo '</div>';
                    echo '<div class="col-md-10">';
                    echo '<div class="row">';
                    echo '<div class="col-md-8">';
                    echo '<p>Mã sản phẩm: ' . $row_order_detail['PRODUCT_ID'] . '</p>';
                    echo '<h5>' . $row_order_detail['PRODUCT_NAME'] . '</h5>';
                    echo '</div>';
                    echo '<div class="col-md-4">';
                    echo '<h5 class="text-end">' . number_format($row_order_detail['ORDER_DETAIL_PRICE'], 0, ',', '.') . ' ₫</h5>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="row">';
                    echo '<div class="col-md-8">';
                    echo '<p>Số lượng: ' . $row_order_detail['ORDER_DETAIL_QUANTITY'] . '</p>';
                    echo '</div>';
                    echo '<div class="col-md-4">';
                    echo '<p class="text-end">Tổng: ' . number_format($row_order_detail['ORDER_DETAIL_PRICE'] * $row_order_detail['ORDER_DETAIL_QUANTITY'], 0, ',', '.') . ' ₫</p>';
                    echo '</div>';
                    echo '<div class="col-md-8">';
                    if ($warranty != "null") {
                        echo '<p>' . $warranty . '</p>';
                        if ($warranty_row['WARRANTY_STATUS'] != 'Cancelled') echo '<button class="btn btn-danger" id="cancel-warranty" onclick="cancelWarranty(' . $row_order_detail['ORDER_DETAIL_ID'] . ')">Dừng bảo hành</button>';
                    }
                    echo '</div>';

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '<hr>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        // Lấy giá trị của thẻ select
        var selectedValue = $('#category-list').val();

        // Kiểm tra nếu giá trị khác rỗng, tự động kích hoạt sự kiện change
        if (selectedValue) {
            // console.log('Triggering change event');
            handleCategoryListChange();
        }

        // Sự kiện khi thay đổi giá trị trong #category-list
        $(document).on('change', '#category-list', handleCategoryListChange);
    });

    function handleCategoryListChange() {
        var categoryId = $('#category-list').val();
        // console.log('Selected Category ID:', categoryId);

        // Gọi hàm để fetch dữ liệu
        $.ajax({
            type: 'POST',
            url: './backend/category_fetch_data.php',
            data: {
                category_id: categoryId
            },
            success: function(response) {
                // Parse JSON response
                var responseData = JSON.parse(response);

                // Access data properties
                var categoryName = responseData.category_name;
                var categoryQuantity = responseData.category_quantity;
                var categoryPicture = responseData.category_picture;
                var categoryDescription = responseData.category_description;

                // Update other form fields with the fetched data
                $('#category-name').val(categoryName);
                $('#category-quantity').val(categoryQuantity);
                $('#category-picture').val(categoryPicture);
                $('#product-description').val(categoryDescription);

                // Log the values for debugging
                // console.log('Category Quantity:', categoryQuantity);
                // console.log('Category Picture:', categoryPicture);
                // console.log('Category Description:', categoryDescription);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' - ' + error);
                alert('Failed to fetch data for category ID ' + categoryId);
            }
        });
    }
</script>

<script>
    function cancelWarranty(orderDetailId) {

        $.ajax({
            url: './backend/cancel_warranty.php', // Adjust the URL to your server-side script
            method: 'POST',
            data: { order_detail_id: orderDetailId },
            success: function(response) {
                // Handle the response from the server
                alert(response);
                location.reload();

            },
            error: function(error) {
                // Handle errors
                console.error(error);
            }
        });
    }
</script>



<?php
if (isset($_POST['update'])) {
    $category_id = trim($_POST['category-list']);
    if ($category_id == '') {
        echo "<script>alert('Vui lòng chọn danh mục!')</script>";
        exit();
    }

    $category_name = $_POST['category-name'];
    $category_picture = $_POST['category-picture'];
    $category_description = $_POST['product-description'];
    // echo "<script>alert('$category_id - $category_name - $category_picture - $category_description' )</script>";

    $sql_update = mysqli_query($connect, "UPDATE CATEGORIES SET CATEGORY_NAME = '$category_name', CATEGORY_IMAGE = '$category_picture', CATEGORY_DESCRIPTION = '$category_description' WHERE CATEGORY_ID = '$category_id'");

    if ($sql_update) {
        echo "<script>alert('Cập nhập thành công!')</script>";
    } else {
        echo "<script>alert('Cập nhập thất bại!')</script>";
    }
}
?>