<?php
include "../../libraries/connectDB.php";

// Get code ID from the AJAX request
$code_id = $_POST['code_id'];

// Query the database to fetch data based on the code ID
$sql = "SELECT * FROM CODE_DISCOUNT WHERE CODE_ID = '$code_id'";
$result = mysqli_query($connect, $sql);

$sql_count = "SELECT count(PROMOTION_ID) as count_promotion FROM PROMOTION WHERE PROMOTION_CODE = '$code_id'";
$result_count = mysqli_query($connect, $sql_count);

// Check if the query was successful
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $row_count = mysqli_fetch_assoc($result_count);

    // Send the data back as JSON
    $response = [
        'code_id' => $row['CODE_ID'],
        'code_name' => $row['CODE_NAME'],
        'code_percent' => $row['CODE_PERCENT'],
        'code_description' => $row['CODE_DESCRIPTION'],
        'count_promotion' => $row_count['count_promotion']
    ];

    echo json_encode($response);

    // Optionally, log to the console in PHP for debugging
    error_log(print_r($response, true));
    // echo json_encode(['code_id' => $code_id, 'message' => 'Success']);
} else {
    // Handle errors
    echo json_encode(['error' => 'Failed to fetch data']);

    // Optionally, log to the console in PHP for debugging
    error_log('Failed to fetch data');
}

// Close the database connection
mysqli_close($connect);
?>
