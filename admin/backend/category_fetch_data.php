<?php
include "../../libraries/connectDB.php";

// Get category ID from the AJAX request
$category_id = $_POST['category_id'];

// Query the database to fetch data based on the category ID
$sql = "SELECT * FROM CATEGORIES WHERE CATEGORY_ID = '$category_id'";
$result = mysqli_query($connect, $sql);

// Check if the query was successful
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);

    // Send the data back as JSON
    $response = [
        'category_name' => $row['CATEGORY_NAME'],
        'category_quantity' => $row['NUMBER_PRODUCT'],
        'category_picture' => $row['CATEGORY_IMAGE'],
        'category_description' => $row['CATEGORY_DESCRIPTION']
    ];

    echo json_encode($response);

    // Optionally, log to the console in PHP for debugging
    error_log(print_r($response, true));
    // echo json_encode(['category_id' => $category_id, 'message' => 'Success']);
} else {
    // Handle errors
    echo json_encode(['error' => 'Failed to fetch data']);

    // Optionally, log to the console in PHP for debugging
    error_log('Failed to fetch data');
}

// Close the database connection
mysqli_close($connect);
?>
