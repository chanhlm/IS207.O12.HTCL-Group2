<?php
include "../../libraries/connectDB.php";

if (isset($_POST['order_detail_id'])) {
    $orderDetailId = $_POST['order_detail_id'];

    // Assume your WARRANTY table has columns 'WARRANTY_STATUS' and 'END_DATE'
    // Update the warranty status to 'Cancelled' and set END_DATE to '1990-01-01'
    $cancelWarrantyQuery = "UPDATE WARRANTY SET WARRANTY_STATUS = 'Cancelled', END_DATE = '1990-01-01' WHERE ORDER_DETAIL_ID = $orderDetailId";

    // Execute the query
    if (mysqli_query($connect, $cancelWarrantyQuery)) {
        echo 'Hủy bảo hành thành công';
    } else {
        echo 'Error cancelling warranty: ' . mysqli_error($connect);
    }
} else {
    echo 'Order detail ID not provided.';
}

mysqli_close($connect);
?>
