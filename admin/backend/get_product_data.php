<?php
include "../../libraries/connectDB.php";

$product_id = $_POST['product_id'];

$sql = "SELECT 
        P.PRODUCT_ID,
        P.PRODUCT_NAME,
        P.CATEGORY_ID,
        C.CATEGORY_NAME,
        P.BRAND_ID,
        B.BRAND_NAME,
        W.PRODUCT_QUANTITY,
        P.PRODUCT_SALEPRICE,
        P.PRODUCT_IMAGE,
        P.PRODUCT_STATUS,
        P.PRODUCT_DESCRIPTION,
        P.warranty_period,
        P.IMAGE_SRC
        FROM PRODUCTS P
        JOIN CATEGORIES C ON P.CATEGORY_ID = C.CATEGORY_ID
        JOIN BRANDS B ON P.BRAND_ID = B.BRAND_ID
        JOIN WAREHOUSE W ON P.PRODUCT_ID = W.PRODUCT_ID
        WHERE P.PRODUCT_ID = '$product_id'
        ORDER BY P.CATEGORY_ID ASC ;";

$result = $connect->query($sql);

// Kiểm tra xem có dữ liệu hay không
if ($result->num_rows > 0) {
    // Lấy dữ liệu từ kết quả truy vấn
    $row = $result->fetch_assoc();

    // Tạo một mảng chứa dữ liệu
    $data = array(
        'name' => $row['PRODUCT_NAME'],
        'category_id' => $row['CATEGORY_ID'],
        'category_name' => $row['CATEGORY_NAME'],
        'brand_id' => $row['BRAND_ID'],
        'brand_name' => $row['BRAND_NAME'],
        'price' => $row['PRODUCT_SALEPRICE'],
        'status' => $row['PRODUCT_STATUS'],
        'warranty_period' => $row['warranty_period'],
        'product_picture' => $row['PRODUCT_IMAGE'],
        'product_picture_detail' => $row['IMAGE_SRC'],
        'product_description' => $row['PRODUCT_DESCRIPTION']
    );

    // Trả về dữ liệu dưới dạng JSON
    echo json_encode($data);
} else {
    // Nếu không tìm thấy sản phẩm, có thể trả về một thông báo hoặc dữ liệu mặc định
    $data = array('error' => 'Sản phẩm không tồn tại');
    echo json_encode($data);
}

// Đóng kết nối
$connect->close();
?>
