<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
if (isset($_POST['add']) && ($_POST['add'])) {
    // lấy giá trị
    $id = $_POST['id'];
    $tensach = $_POST['tensach'];
    $gia = (int)$_POST['gia'];

    if (isset($_POST['sl']) && ($_POST['sl'] > 0)) {
        $sl = $_POST['sl'];
    } else {
        $sl = 1;
    }
    $fg = 0;
    // kiểm tra sản phẩm có tồn tại trong giỏ hàng, nếu có thì cập nhật số lượng
    $i = 0;
    foreach ($_SESSION['cart'] as $item) {
        if ($item[1] === $tensach) {
            $sln = $sl + $item[3];
            $_SESSION['cart'][$i][3] = $sln;
            $fg = 1;
            break;
        }
        $i++;
    }
    // tạo mảng con
    if ($fg == 0) {
        $item = array($id, $tensach, $gia, $sl);
        // thêm vào giỏ hàng
        $_SESSION['cart'][] = $item;
    }
    header('location: cart.php');
}
