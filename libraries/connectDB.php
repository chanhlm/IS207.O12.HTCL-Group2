<?php
    $connect = new mysqli('localhost','root','','CuaHangDienMay');

    if ($connect->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    
    $connect->set_charset('utf8'); //csdl tiếng việt
?>