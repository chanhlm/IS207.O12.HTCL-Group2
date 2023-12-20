<?php
include "../../libraries/connectDB.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['brand_ids'])) {
    $brandIds = explode(",", $_GET['brand_ids']);

    // Sanitize the brand IDs to prevent SQL injection
    $escapedBrandIds = array_map(function ($brandId) use ($connect) {
        return "'" . mysqli_real_escape_string($connect, $brandId) . "'";
    }, $brandIds);

    // Convert the sanitized brand IDs to a comma-separated string
    $brandIdsString = implode(',', $escapedBrandIds);

    // Check if there are associated products before performing the delete operation
    $checkProductsSql = "SELECT COUNT(*) FROM PRODUCTS WHERE BRAND_ID IN ($brandIdsString)";
    $productCountResult = mysqli_query($connect, $checkProductsSql);
    $productCount = mysqli_fetch_row($productCountResult)[0];

    if ($productCount > 0) {
        echo 'Không thể xóa nhãn hàng có sản phẩm.';
    } else {
        // Perform the delete operation if no associated products
        $deleteSql = "DELETE FROM BRANDS WHERE BRAND_ID IN ($brandIdsString)";
        $deleteResult = mysqli_query($connect, $deleteSql);

        // Check if the deletion was successful
        if ($deleteResult) {
            echo 'Xóa thành công';
        } else {
            echo 'Lỗi xóa: ' . mysqli_error($connect);
        }
    }
} else {
    echo 'Yêu cầu không hợp lệ';
}

mysqli_close($connect);
?>
