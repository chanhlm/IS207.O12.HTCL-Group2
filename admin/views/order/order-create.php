<?php
$sql_order = mysqli_query($connect, "SELECT * FROM ORDERS");
$count_order = mysqli_num_rows($sql_order);

date_default_timezone_set('Asia/Ho_Chi_Minh');

$max = ((mysqli_query($connect, "SELECT MAX(ORDER_ID) AS MAXID FROM ORDERS"))->fetch_assoc())['MAXID'] + 1;
?>

<style>
    .cart {
        max-width: 500px;
        /* Điều chỉnh độ rộng của giỏ hàng */
        margin: 20px auto;
        /* Đưa giỏ hàng vào giữa trang */
        background-color: #f8f9fa;
        /* Màu nền */
        padding: 20px;
        border-radius: 8px;
        /* Bo tròn viền giỏ hàng */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        /* Đổ bóng */
    }

    .cart-body {
        display: flex;
        flex-direction: column;
    }

    .add-product,
    .remove-product {
        cursor: pointer;
    }

    /* .add-product {} */

    .remove-product {
        color: red;
        padding-right: 50px;
    }

    .cart-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .cart-item input {
        margin-right: 10px;
        /* Khoảng cách giữa các trường nhập liệu */
        padding: 5px;
        border: 1px solid #ccc;
        /* Viền trường nhập liệu */
        border-radius: 4px;
    }

    .cart-item .remove-product {
        margin-left: auto;
        /* Dấu trừ ở phía bên phải */
    }

    .expand-icon {
        margin-right: 5px;
        /* Khoảng cách giữa dấu cộng và nội dung */
        transition: transform 0.3s;
        /* Hiệu ứng chuyển động dấu cộng */
    }
</style>

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
                        <li class="breadcrumb-item active" aria-current="page">Tạo mới đơn hàng</li>
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
                                <input type="text" class="form-control" id="order-date" name="order-date" required value="<?php echo date("d/m/Y H:i:s") ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Mã đơn hàng</label>
                                <input type="text" class="form-control" id="status" name="status" value="#<?php echo str_pad($max, 6, '0', STR_PAD_LEFT) ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- Các trường thông tin khác -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên khách hàng</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Tên khách hàng" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="pt-4">
                                <label for="in-store" class="form-label">Nhận tại cửa hàng </label>
                                <input type="checkbox" id="in-store" name="in-store" placeholder="Địa chỉ nhận hàng" required onclick="toggleDeliveryAddress()">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="mb-3">
                                <label for="delivery-address" class="form-label">Địa chỉ nhận hàng</label>
                                <input type="text" class="form-control" id="delivery-address" name="delivery-address" placeholder="Địa chỉ nhận hàng" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Số sản phẩm</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" value="0" readonly>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="total" class="form-label">Tổng hóa đơn</label>
                                <input type="text" class="form-control" id="total" name="total" value="0 đ" readonly>
                            </div>
                        </div>
                    </div>

                <button type="submit" class="btn btn-success" >Thêm</button>


            </div>
        </div>
        <br>
        <div class="cart">
            <div class="cart-body">
                <!-- Dấu cộng để thêm sản phẩm -->
                <div class="add-product" onclick="addProductRow()">
                    <span class="expand-icon">+</span> Thêm sản phẩm
                </div>
            </div>
        </div>

        </form>

    </div>
</div>
<!--end page wrapper -->



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>
    function toggleDeliveryAddress() {
        // Lấy thẻ checkbox và trường nhập liệu
        var checkBox = document.getElementById("in-store");
        var deliveryAddress = document.getElementById("delivery-address");

        // Nếu checkbox được chọn, vô hiệu hóa trường nhập liệu
        if (checkBox.checked) {
            deliveryAddress.value = ""; // Xóa giá trị trong trường nhập liệu
            deliveryAddress.disabled = true;
            checkBox.removeAttribute("required"); // Xóa thuộc tính "required" của trường nhập liệu
        } else {
            deliveryAddress.disabled = false;
            deliveryAddress.required = true;
            deliveryAddress.focus();
            deliveryAddress.addAttribute("required", "");
        }
    }

    function addProductRow() {
        // Tạo một div mới làm row sản phẩm
        var productRow = document.createElement('div');
        productRow.classList.add('cart-item');

        // Nội dung của row (ví dụ: input, select, v.v.)
        productRow.innerHTML = `
        <input type="text" id="product-code" placeholder="Mã sản phẩm">
        <input type="number" id="quantity" placeholder="Số lượng" min="0" step="1">

        <!-- <span class="see-detail" onclick="goToProductDetail()"><a href="#">Xem chi tiết</a></span> -->
        

        <span class="remove-product" onclick="removeProductRow(this)"><i class='bx bx-trash'></i></span>

    `;

        // Thêm row sản phẩm vào cart-body
        var cartBody = document.querySelector('.cart-body');
        cartBody.appendChild(productRow);
    }

    function goToProductDetail() {
        // Lấy giá trị từ trường nhập liệu "Mã sản phẩm"
        var productCode = document.getElementById('product-code').value;

        // Kiểm tra xem mã sản phẩm có tồn tại không
        if (productCode.trim() !== "") {
            // Tạo URL mới dựa trên mã sản phẩm và chuyển hướng đến trang chi tiết sản phẩm
            var url = "./index.php?page=product-update&product_id=" + encodeURIComponent(productCode);
            window.location.href = url;
        } else {
            alert("Vui lòng nhập mã sản phẩm trước khi xem chi tiết.");
        }
    }

    function removeProductRow(removeBtn) {
        // Lấy div cha của dấu trừ (div sản phẩm) và xóa nó
        var productRow = removeBtn.closest('.cart-item');
        productRow.remove();
    }
</script>


<?php

?>