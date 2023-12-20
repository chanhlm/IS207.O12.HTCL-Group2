<?php
include "../../libraries/connectDB.php";

// Get brand ID from the AJAX request
$brand_id = $_POST['brand_id'];

// Query the database to fetch data based on the brand ID
$sql = "SELECT * FROM BRANDS WHERE BRAND_ID = '$brand_id'";
$result = mysqli_query($connect, $sql);

// Check if the query was successful
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);

    // Send the data back as JSON
    $response = [
        'brand_name' => $row['BRAND_NAME'],
        'brand_country' => $row['COUNTRY'],
        'brand_quantity' => $row['NUMBER_PRODUCT'],
        'brand_picture' => $row['BRAND_IMAGE'],
        'brand_description' => $row['BRAND_DESCRIPTION']
    ];

    echo json_encode($response);

    // Optionally, log to the console in PHP for debugging
    error_log(print_r($response, true));
    // echo json_encode(['brand_id' => $brand_id, 'message' => 'Success']);
} else {
    // Handle errors
    echo json_encode(['error' => 'Failed to fetch data']);

    // Optionally, log to the console in PHP for debugging
    error_log('Failed to fetch data');
}

// Close the database connection
mysqli_close($connect);
?>
