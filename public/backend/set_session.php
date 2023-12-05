<?php
session_start();

if (isset($_POST['role'])) {
    $_SESSION['role'] = $_POST['role'];
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Role not provided']);
}
?>
