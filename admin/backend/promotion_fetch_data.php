<?php
include "../../libraries/connectDB.php";

// Get promotion ID from the AJAX request
$promotion_id = $_POST['promotion_id'];

$sql = "SELECT * from PROMOTION WHERE PROMOTION_ID = '$promotion_id'";
$result = mysqli_query($connect, $sql);

// Check if the query was successful
if ($result) {
    $row = mysqli_fetch_assoc($result);
    
    // Send the data back as JSON
    $response = [
        'promotion_id' => $row['PROMOTION_ID'],
        'promotion_code' => $row['PROMOTION_CODE'],
        'promotion_startdate' => $row['PROMOTION_STARTDATE'],
        'promotion_enddate' => $row['PROMOTION_ENDDATE'],
        'product_id' => $row['PRODUCT_ID'],
    ];

    echo json_encode($response);

    // Optionally, log to the console in PHP for debugging
    error_log(print_r($response, true));
} else {
    // Handle errors
    echo json_encode(['error' => 'Failed to fetch data']);

    // Optionally, log to the console in PHP for debugging
    error_log('Failed to fetch data');
}

// Close the database connection
mysqli_close($connect);
?>
