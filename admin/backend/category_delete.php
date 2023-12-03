<?php
include "../../libraries/connectDB.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['category_ids'])) {
    $categoryIds = explode(",", $_GET['category_ids']);

    // Sanitize the category IDs to prevent SQL injection
    $escapedCategoryIds = array_map(function ($categoryId) use ($connect) {
        return "'" . mysqli_real_escape_string($connect, $categoryId) . "'";
    }, $categoryIds);

    // Convert the sanitized category IDs to a comma-separated string
    $categoryIdsString = implode(',', $escapedCategoryIds);

    // Check if there are associated products before performing the delete operation
    $checkProductsSql = "SELECT COUNT(*) FROM PRODUCTS WHERE CATEGORY_ID IN ($categoryIdsString)";
    $productCountResult = mysqli_query($connect, $checkProductsSql);
    $productCount = mysqli_fetch_row($productCountResult)[0];

    if ($productCount > 0) {
        echo 'Không thể xóa danh mục có sản phẩm.';
    } else {
        // Perform the delete operation if no associated products
        $deleteSql = "DELETE FROM CATEGORIES WHERE CATEGORY_ID IN ($categoryIdsString)";
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
