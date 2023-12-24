<?php
include "../../libraries/connectDB.php";

// Hàm để khóa người dùng
function lockUser($userPhone) {
    global $connect;
    $sql = "UPDATE USERS SET USER_STATE = 'unactive' WHERE USER_PHONE = '$userPhone'";
    if ($connect->query($sql) === TRUE) {
        return "Người dùng đã được khóa thành công!";
    } else {
        return "Lỗi: " . $connect->error;
    }
}

// Hàm để mở khóa người dùng
function unlockUser($userPhone) {
    global $connect;
    $sql = "UPDATE USERS SET USER_STATE = 'active' WHERE USER_PHONE = '$userPhone'";
    if ($connect->query($sql) === TRUE) {
        return "Người dùng đã được mở khóa thành công!";
    } else {
        return "Lỗi: " . $connect->error;
    }
}

// Xử lý yêu cầu từ trình duyệt
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    $userPhone = isset($_POST['userPhone']) ? $_POST['userPhone'] : '';

    $sql = "SELECT USER_STATE FROM USERS WHERE USER_PHONE = '$userPhone'";
    $result = $connect->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        $userStatus = $row['USER_STATE'];
    } else {
        echo "Không tìm thấy người dùng!";
        return;
    }

    if ($action === 'lock') {
        if ($userStatus == 'unactive') {
            echo "Tài khoản đang được khóa!";
            return;
        }
        else echo lockUser($userPhone);
    } 
    elseif ($action === 'unlock') {
        if ($userStatus == 'active') {
            echo "Tài khoản đang hoạt động!";
            return;
        }
        else
        echo unlockUser($userPhone);
    } else {
        echo "Hành động không hợp lệ!";
    }
} else {
    echo "Method not allowed";
}

// Đóng kết nối
$connect->close();
?>
