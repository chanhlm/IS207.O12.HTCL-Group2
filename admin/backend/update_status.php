<?php
include "../../libraries/connectDB.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["order_id"]) && isset($_POST["new_status"])) {
    $id = $_POST["order_id"];
    $status = $_POST["new_status"];
    // echo $id;

    $sql = "UPDATE orders SET ORDER_STATUS = $status WHERE ORDER_ID = $id";
    mysqli_query($connect, $sql);
    // echo $sql;
    if (mysqli_affected_rows($connect) > 0) {
        echo "Success";
    } else {
        echo "Fail";
    }
}

?>
