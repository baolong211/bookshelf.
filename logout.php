<?php
// Bắt đầu session
session_start();
include 'connect.php';
// Hủy bỏ tất cả các biến session
$_SESSION = array();

// Hủy bỏ phiên làm việc
session_destroy();

// Chuyển hướng người dùng đến trang chính
header("location: index.php");

exit;
