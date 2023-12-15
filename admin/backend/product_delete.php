<?php
include "../../libraries/connectDB.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['product_ids'])) {
    $productIds = explode(",", $_GET['product_ids']);

    // Sanitize the product IDs to prevent SQL injection
    $escapedProductIds = array_map(function ($productId) use ($connect) {
        return "'" . mysqli_real_escape_string($connect, $productId) . "'";
    }, $productIds);

    $productIdsString = implode(',', $escapedProductIds);

    // Start a transaction
    mysqli_autocommit($connect, false);

    // Attempt to delete from the first table
    $deleteSql1 = "DELETE FROM WAREHOUSE WHERE PRODUCT_ID IN ($productIdsString)";
    $deleteResult1 = mysqli_query($connect, $deleteSql1);

    // Attempt to delete from the second table
    $deleteSql2 = "DELETE FROM PRODUCTS WHERE PRODUCT_ID IN ($productIdsString)";
    $deleteResult2 = mysqli_query($connect, $deleteSql2);

    // Check if both deletions were successful
    if ($deleteResult1 && $deleteResult2) {
        // Commit the transaction if both deletions are successful
        mysqli_commit($connect);
        echo 'Xóa thành công';
    } else {
        // Rollback the transaction if any deletion fails
        mysqli_rollback($connect);
        echo 'Lỗi xóa: ' . mysqli_error($connect);
    }

    // Turn autocommit back on
    mysqli_autocommit($connect, true);
} else {
    echo 'Yêu cầu không hợp lệ';
}

mysqli_close($connect);
