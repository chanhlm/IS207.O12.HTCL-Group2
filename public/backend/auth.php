<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ AJAX request
    $userPhone = $_POST['phone'];

    include "../../libraries/connectDB.php";

    // Kiểm tra xem số điện thoại đã tồn tại trong cơ sở dữ liệu chưa
    $phoneExistsQuery = "SELECT * FROM users WHERE USER_PHONE = '$userPhone' AND USER_STATE = 'active'";
    $phoneExistsResult = $connect->query($phoneExistsQuery);

    if ($phoneExistsResult->num_rows > 0) {
        // Nếu số điện thoại đã tồn tại, chuyển hướng người dùng dựa trên vai trò (role)
        $user = $phoneExistsResult->fetch_assoc();
        $role = $user['USER_ROLE']; 

        // Gửi phản hồi JSON với vai trò
        echo json_encode(['role' => $role]);
    } else {
        // Nếu số điện thoại chưa tồn tại, thêm vào cơ sở dữ liệu với vai trò là 'user'
        $insertQuery = "INSERT INTO users (USER_NAME, USER_PHONE, USER_ROLE, USER_STATE, CREATE_DATE, LAST_LOGIN)
             VALUES ('$userPhone', '$userPhone', 2, 'active', NOW(), NOW())";

        if ($connect->query($insertQuery) === TRUE) {
            // Gửi phản hồi JSON với vai trò 'user'
            echo json_encode(['role' => '2']);
        } else {
            echo "Error: " . $insertQuery . "<br>" . $connect->error;
        }
    }

    // Đóng kết nối
    $connect->close();
}
?>
