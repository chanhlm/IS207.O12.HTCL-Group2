<?php
include "../../libraries/connectDB.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['user_phones'])) {
    $userPhones = explode(",", $_GET['user_phones']);

    // Sanitize the user IDs to prevent SQL injection
    $escapedUserPhones = array_map(function ($userPhone) use ($connect) {
        return "'" . mysqli_real_escape_string($connect, $userPhone) . "'";
    }, $userPhones);

    // Convert the sanitized brand IDs to a comma-separated string
    $userPhonesString = implode(',', $escapedUserPhones);

    // Check if there are associated orders before performing the delete operation
    $checkOrdersSql = "SELECT COUNT(*) FROM ORDERS WHERE USER_ID IN ($userPhonesString)";
    $orderCountResult = mysqli_query($connect, $checkOrdersSql);
    $orderCount = mysqli_fetch_row($orderCountResult)[0];

    if ($orderCount > 0) {
        echo 'Không thể xóa khách hàng có hóa đơn.';
    } else {
        // Perform the delete operation if no associated products
        $deleteSql = "DELETE FROM USERS WHERE USER_PHONE IN ($userPhonesString)";
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
