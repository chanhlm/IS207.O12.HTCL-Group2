<?php
session_start();

if (isset($_POST['role']) && isset($_POST['phone'])) {
    $_SESSION['role'] = $_POST['role'];
    $_SESSION['phone'] = $_POST['phone'];
    if ($_SESSION['role'] == 1) {
        echo './admin/index.php';
    } else if ($_SESSION['role'] == 2){
        echo './index.php';
    }
}