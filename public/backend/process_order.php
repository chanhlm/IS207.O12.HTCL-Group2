<?php
include "../../libraries/connectDB.php";

function check_addPrefix($so_dien_thoai) {
    return substr($so_dien_thoai, 0, 3) !== "+84" ? "+84" . ltrim($so_dien_thoai, '0') : $so_dien_thoai;
}

// Get JSON data from the form
$formDataJson = $_POST['form'] ?? '';
$formData = json_decode($formDataJson, true);

$a = $formData[5]['value'] ?? '';
$b = $formData[4]['value'] ?? '';
$c = $formData[3]['value'] ?? '';


// Access individual form fields
$username = $formData[0]['value'] ?? '';
$phone = check_addPrefix($formData[1]['value'] ?? '');
$email = $formData[2]['value'] ?? '';
$address = $a . ", " . $b . ", " . $c;
$shipping = $formData[6]['value'] ?? '';
$total = $formData[7]['value'] ?? '';

// echo $username . "<br>" . $email . "<br>" . $phone . "<br>" . $address . "<br>" . $total . "<br>" . $shipping . "<br>";


// Use prepared statements to prevent SQL injection
$sql = "SELECT * FROM USERS WHERE USER_PHONE = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $phone);
$stmt->execute();
if ($stmt->execute() !== TRUE) {
    echo "Error: " . $stmt->error;
}
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update data in users table
    $sql = "UPDATE USERS SET USER_NAME = ?, USER_EMAIL = ?, USER_ADDRESS = ? WHERE USER_PHONE = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $address, $phone);
    if ($stmt->execute() !== TRUE) {
        echo "Error: " . $stmt->error;
    }
} else {
    // Insert data into users table
    $sql = "INSERT INTO users (USER_NAME, USER_EMAIL, USER_PHONE, USER_ADDRESS) VALUES (?, ?, ?, ?)";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $phone, $address);
    if ($stmt->execute() !== TRUE) {
        echo "Error: " . $stmt->error;
    }
}

$orderId = 0;

// Insert data into orders table
$sql = "INSERT INTO orders (ORDER_TOTAL, ORDER_SHIPPING, USER_PHONE) VALUES (?, ?, ?)";
$stmt = $connect->prepare($sql);
$stmt->bind_param("dss", $total,$shipping, $phone);
if ($stmt->execute() === TRUE) {
    global $orderId;
    $orderId = $stmt->insert_id; // Get the ID of the last inserted order
    // echo $orderId;
} else {
    echo "Error: " . $stmt->error;
}


// Get data from localStorage
$cart = json_decode($_POST['cart']);

foreach ($cart as $item) {
    $productId = $item->productId ?? '';
    $quantity = $item->productQuantity ?? '';
    $discountedPrice = $item->productDiscountedPrice ?? '';

    $sql = "INSERT INTO order_details (ORDER_ID, PRODUCT_ID, ORDER_DETAIL_QUANTITY, ORDER_DETAIL_PRICE) VALUES (?, ?, ? , ?)";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("isid", $orderId, $productId, $quantity, $discountedPrice);
    if ($stmt->execute() !== TRUE) {
        echo "Error: " . $stmt->error;
    }

    // echo $productId . "<br>" . $quantity . "<br>" . $discountedPrice . "<br>";
  }
  echo $orderId;


$stmt->close();
$connect->close();


?>
