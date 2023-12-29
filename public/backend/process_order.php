
<?php
include "../../libraries/connectDB.php";

// Get data from form
$form = $_POST['form'];

// Insert data into orders table
$sql = "INSERT INTO orders (USER_NAME, USER_EMAIL, USER_PHONE, USER_ADDRESS, USER_ROLE, USER_STATE) VALUES ('".$form['username']."', '".$form['phone']."', '".$form['email']."', '".$form['province']."', '".$form['town']."', '".$form['address']."')";
if ($conn->query($sql) === TRUE) {
  $orderId = $conn->insert_id; // Get the ID of the last inserted order
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Get data from localStorage
$cart = json_decode($_POST['cart']);

// Insert data into order_details table
foreach ($cart as $item) {
  $productId = $item->productId;
  $quantity = $item->quantity;
  $sql = "INSERT INTO order_details (order_id, product_id, quantity) VALUES ('$orderId', '$productId', '$quantity')";
  if ($conn->query($sql) !== TRUE) {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>
