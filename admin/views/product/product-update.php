<?php
$sql_product = mysqli_query($connect, "SELECT * FROM PRODUCTS");
$count_product = mysqli_num_rows($sql_product);

$sql_category = mysqli_query($connect, "SELECT * FROM CATEGORIES");

$sql_brand = mysqli_query($connect, "SELECT * FROM BRANDS");
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
                        <li class="breadcrumb-item active" aria-current="page">Sản phẩm </li>
                        <li class="breadcrumb-item active" aria-current="page">Cập nhập sản phẩm </li>
                    </ol>
                </nav>
            </div>
        </div>


        <h6 class="mb-0 text-uppercase">Sản phẩm - <?php echo $count_product ?> sản phẩm</h6>
        <hr />
        <!-- insert form -->
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="product-id" class="form-label">Mã sản phẩm</label>
                                <input type="text" class="form-control" id="product-id" name="product-id" placeholder="ID" value="<?php if (isset($_GET['product_id'])) {
                                                                                                                                        echo $_GET['product_id'];
                                                                                                                                    } ?>" required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="categorySelect" class="form-label">Danh mục sản phẩm</label>
                                <select class="form-control" id="categorySelect" name="category">
                                    <?php
                                    // Hiển thị danh sách danh mục trong combobox
                                    echo '<option value="null">Chọn danh mục</option>';
                                    if ($sql_category->num_rows > 0) {
                                        while ($row = $sql_category->fetch_assoc()) {
                                            echo '<option value="' . $row['CATEGORY_ID'] . '">' . $row['CATEGORY_NAME'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="brandSelect" class="form-label">Hãng</label>
                                <select class="form-control" id="brandSelect" name="brand">
                                    <?php
                                    // Hiển thị danh sách danh mục trong combobox
                                    echo '<option value="null">Chọn hãng</option>';
                                    if ($sql_brand->num_rows > 0) {
                                        while ($row = $sql_brand->fetch_assoc()) {
                                            echo '<option value="' . $row['BRAND_ID'] . '">' . $row['BRAND_NAME'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="price" class="form-label">Giá bán</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="Nhập giá bán" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="price" class="form-label">Trạng thái</label>
                                <select type="text" class="form-control" id="status" name="status" placeholder="Trạnng thái" required>
                                    <option value="active">Đang bán</option>
                                    <option value="inactive">Ngừng bán</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="warranty_period" class="form-label">Thời gian bảo hành</label>
                                <select type="text" class="form-control" id="warranty_period" name="warranty_period" placeholder="0" required>
                                    <option value="0">Không bảo hành</option>
                                    <option value="1">1 tháng</option>
                                    <option value="3">3 tháng</option>
                                    <option value="6">6 tháng</option>
                                    <option value="12">12 tháng</option>
                                    <option value="24">24 tháng</option>
                                    <option value="36">36 tháng</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="product-picture" class="form-label">Hình ảnh</label>
                            <input type="text" class="form-control" id="product-picture" name="product-picture" placeholder="Hình ảnh" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="product-picture_detail" class="form-label">Hình ảnh chi tiết</label>
                            <input type="text" class="form-control" id="product-picture_detail" name="product-picture_detail" placeholder="Hình ảnh chi tiết, mỗi ảnh cách nhau bởi một dấu phẩy. Giới hạn: 5">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="product-description" class="form-label">Mô tả</label>
                            <input type="text" class="form-control" id="product-description" name="product-description" placeholder="Mô tả chi tiết" required>
                        </div>
                    </div>

                    <button type="submit" name="update" class="btn btn-primary">Sửa</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    $(document).ready(function() {

        var productId =$("#product-id").val();
        
        // Kiểm tra nếu ô input có giá trị từ ban đầu
        if (productId) {
            // Gọi hàm để xử lý sự kiện change
            handleProductChange();
        }

        $("#product-id").on("input", handleProductChange);

        function handleProductChange() {
            productId = $("#product-id").val();
            // Kiểm tra nếu product_id không rỗng
            $.ajax({
                type: "POST",
                url: "./backend/product_fetch_data.php",
                data: {
                    product_id: productId
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    console.log(data);

                    // Gán dữ liệu vào các ô input
                    $("#name").val(data.name);
                    $("#categorySelect").val(data.category_id);
                    $("#brandSelect").val(data.brand_id);
                    $("#price").val(data.price);
                    $("#status").val(data.status);
                    $("#warranty_period").val(data.warranty_period);
                    $("#product-picture").val(data.product_picture);
                    $("#product-picture_detail").val(data.product_picture_detail);
                    $("#product-description").val(data.product_description);
                }
            });
        }
    });
</script>


<?php

if (isset($_POST['update'])) {
    $product_id = $_POST['product-id'];
    $product_name = $_POST['name'];

    if ($_POST['category'] == 'null' || $_POST['brand'] == 'null') {
        echo '<script>alert("Vui lòng chọn danh mục và hãng!")</script>';
        exit;
    }
    $product_category = $_POST['category'];
    $product_brand = $_POST['brand'];
    $product_price = $_POST['price'];
    $product_warranty_period = $_POST['warranty_period'];
    $product_picture = $_POST['product-picture'];
    $product_description = $_POST['product-description'];
    $product_picture_detail = $_POST['product-picture_detail'];
    $product_status = $_POST['status'];

    $sql_update = mysqli_query($connect, "UPDATE PRODUCTS SET PRODUCT_NAME = '$product_name', CATEGORY_ID = '$product_category', 
        BRAND_ID = '$product_brand', PRODUCT_SALEPRICE = '$product_price', WARRANTY_PERIOD = '$product_warranty_period', 
        PRODUCT_IMAGE = '$product_picture', PRODUCT_DESCRIPTION = '$product_description', IMAGE_SRC = '$product_picture_detail', 
        PRODUCT_STATUS = '$product_status'
        WHERE PRODUCT_ID = '$product_id'");

    if ($sql_update) {
        echo '<script>alert("Cập nhập thành công!")</script>';
        echo '<script>window.location.href="./index.php?page=product-update"</script>';
    } else {
        echo '<script>alert("Cập nhập thất bại!")</script>';
    }
}
?>