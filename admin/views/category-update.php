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
                                    <option value="">Chọn danh mục</option>
                                    <?php
                                    // Fetch categories from the database
                                    while ($row_category = mysqli_fetch_array($sql_category)) {
                                        echo '<option value="' . $row_category['CATEGORY_ID'] . '">' . $row_category['CATEGORY_ID'] . " - " . $row_category['CATEGORY_NAME'] . '</option>';
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
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="category-picture" class="form-label">Hình ảnh</label>
                            <input type="text" class="form-control" id="category-picture" name="category-picture" placeholder="Hình ảnh" required>
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
        $(document).on('change', '#category-list', function() {
            var categoryId = $(this).val();

            // Thêm dòng này để kiểm tra giá trị categoryId trong console
            // console.log('Selected Category ID: ' + categoryId);

            // Make an AJAX request to fetch additional data based on the selected category
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
                    var categoryQuantity = responseData.category_quantity;
                    var categoryPicture = responseData.category_picture;
                    var categoryDescription = responseData.category_description;

                    // Update other form fields with the fetched data
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

        });
    });
</script>


<?php
if (isset($_POST['update'])) {
    $category_id = $_POST['category-list'];
    // $category_quantity = $_POST['category-quantity'];
    $category_picture = $_POST['category-picture'];
    $category_description = $_POST['product-description'];

    $sql_update = mysqli_query($connect, "UPDATE CATEGORIES SET CATEGORY_IMAGE = '$category_picture', CATEGORY_DESCRIPTION = '$category_description' WHERE CATEGORY_ID = '$category_id'");

    if ($sql_update) {
        echo "<script>alert('Cập nhập thành công!')</script>";
        // echo "<script>window.location.href = './index.php?category'</script>";
    } else {
        echo "<script>alert('Cập nhập thất bại!')</script>";
        // echo "<script>window.location.href = './index.php?category'</script>";
    }
}
?>