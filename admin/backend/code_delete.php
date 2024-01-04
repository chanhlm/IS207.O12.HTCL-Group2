<?php
include "../../libraries/connectDB.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['code_ids'])) {
    $codeIds = explode(",", $_GET['code_ids']);

    // Sanitize the code IDs to prevent SQL injection
    $escapedCodeIds = array_map(function ($codeId) use ($connect) {
        return "'" . mysqli_real_escape_string($connect, $codeId) . "'";
    }, $codeIds);

    // Convert the sanitized code IDs to a comma-separated string
    $codeIdsString = implode(',', $escapedCodeIds);

    // Check if there are associated promotions before performing the delete operation

    // Perform the delete operation if no associated promotions
    $deleteSql = "DELETE FROM CODE_DISCOUNT WHERE CODE_ID IN ($codeIdsString)";
    $deleteResult = mysqli_query($connect, $deleteSql);

    // Check if the deletion was successful
    if ($deleteResult) {
        echo 'Xóa thành công';
    } else {
        echo 'Lỗi xóa: ' . mysqli_error($connect);
    }
} else {
    echo 'Yêu cầu không hợp lệ';
}

mysqli_close($connect);
