<?php
include "../../libraries/connectDB.php";
date_default_timezone_set('Asia/Ho_Chi_Minh');


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["order_id"]) && isset($_POST["new_status"])) {
    $id = $_POST["order_id"];
    $status = $_POST["new_status"];
    // echo $id;

    if ($status == 3) {
        $sql = "SELECT * FROM ORDER_DETAILS, PRODUCTS WHERE ORDER_ID = $id AND ORDER_DETAILS.PRODUCT_ID = PRODUCTS.PRODUCT_ID";
        $result = mysqli_query($connect, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $order_detail_id = $row['ORDER_DETAIL_ID'];
            $month = $row['warranty_period'];
        
            // Assuming you have the necessary data for the WARRANTY table
            $warranty_id = "w" . $order_detail_id; // You should generate a unique ID
            $create_date = date("Y-m-d H:i:s");
        
            // Corrected variable name here: use $month instead of $months
            $end_date = date("Y-m-d H:i:s", strtotime("+$month months"));
        
            $warranty_status = "Active"; // You can set an initial status
        
            // Construct the SQL INSERT statement for WARRANTY table
            $sql_warranty = "INSERT INTO WARRANTY (WARRANTY_ID, CREATE_DATE, END_DATE, WARRANTY_STATUS, ORDER_DETAIL_ID) 
                         VALUES ('$warranty_id', '$create_date', '$end_date', '$warranty_status', $order_detail_id)";
        
            // Execute the SQL statement
            mysqli_query($connect, $sql_warranty);
        
            // You can add additional logic or error handling here
        }
        
    }


    $sql = "UPDATE orders SET ORDER_STATUS = $status WHERE ORDER_ID = $id";
    mysqli_query($connect, $sql);
    // echo $sql;
    if (mysqli_affected_rows($connect) > 0) {
        echo "Success";
    } else {
        echo "Fail";
    }
}
