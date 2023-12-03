<?php
// Kết nối đến cơ sở dữ liệu
include "../../libraries/connectDB.php";

// Kiểm tra nếu có yêu cầu xóa danh mục
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['category_ids']) && is_array($_GET['category_ids'])) {
    $categoryIds = $_GET['category_ids'];

    // Chuyển đổi giá trị từ mảng sang chuỗi để sử dụng trong câu truy vấn SQL
    $categoryIdsString = implode(',', $categoryIds);

    // Thực hiện truy vấn xóa
    $sql = "DELETE FROM CATEGORIES WHERE CATEGORY_ID IN ($categoryIdsString)";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        echo 'Xóa thành công'; // Trả về thông báo cho JavaScript
    } else {
        echo 'Lỗi xóa: ' . mysqli_error($connect); // Trả về thông báo lỗi cho JavaScript
    }
} else {
    echo 'Yêu cầu không hợp lệ'; // Trả về thông báo cho JavaScript
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($connect);
?>
