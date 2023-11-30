<?php
    $connect = new mysqli('localhost','root','','IS207');

    if ($connect->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    // else die ("Kết nối thành công");
    
    $connect->set_charset("utf8mb4");//csdl tiếng việt
?>