<?php
$sql_category = mysqli_query($connect, "SELECT * FROM CATEGORIES");
$count_category = mysqli_num_rows($sql_category);
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
                        <li class="breadcrumb-item active" aria-current="page">Danh mục sản phẩm </li>
                        <li class="breadcrumb-item active" aria-current="page">Cập nhập danh mục </li>
                    </ol>
                </nav>
            </div>
        </div>


        <h6 class="mb-0 text-uppercase">Danh mục sản phẩm - <?php echo $count_category ?> danh mục</h6>
        <hr />
        <!-- insert form -->
        <div class="card">
            <div class="card-body">
                <form method="POST" id="categoryForm">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="category-list" class="form-label">Chọn danh mục</label>

                                <select class="form-control" id="category-list" name="category-list" required>
                                    <option value="null">Chọn danh mục</option>
                                    <?php
                                    // Fetch categories from the database
                                    while ($row_category = mysqli_fetch_array($sql_category)) {
                                        $selected = '';

                                        // Kiểm tra nếu có category_id truyền tới và nó trùng với CATEGORY_ID của danh mục hiện tại
                                        if (isset($_GET['category_id']) && $_GET['category_id'] == $row_category['CATEGORY_ID']) {
                                            $selected = 'selected'; // Đánh dấu là đã chọn
                                        }

                                        echo '<option value="' . $row_category['CATEGORY_ID'] . '" ' . $selected . '>' . $row_category['CATEGORY_ID'] . " - " . $row_category['CATEGORY_NAME'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="category-quantity" class="form-label">Số lượng sản phẩm </label>
                                <input type="number" class="form-control" id="category-quantity" name="category-quantity" placeholder="0" required min="0" step="1" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="category-name" class="form-label">Tên danh mục</label>
                                <input type="text" class="form-control" id="category-name" name="category-name" placeholder="Tên danh mục" required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="category-picture" class="form-label">Hình ảnh</label>
                                <input type="text" class="form-control" id="category-picture" name="category-picture" placeholder="Hình ảnh" required>
                            </div>
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