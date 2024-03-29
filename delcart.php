<?php
include 'cart.php';
include 'addtocart.php';
include 'connect.php';
if (isset($_GET['id']) && ($_GET['id'] > 0)) {
    // if (isset($_SESSION['cart']) && (count($_SESSION['cart']) > 0)) {
    //     array_splice($_SESSION['cart'], $_GET['i'], 1);
    // }
    if (isset($_SESSION['cart']) && (count($_SESSION['cart']) > 0)) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item[0] == $_GET['id']) {
                unset($_SESSION['cart'][$key]);
                break; // Đảm bảo chỉ xóa một sản phẩm có id tương ứng
            }
        }
    }
} else {
    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }
}

// if (isset($_SESSION['cart']) && (count($_SESSION['cart']) > 0)) {
//     header('location: cart.php');
// } else {
//     header('location: index.php');
// }

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    echo '<meta http-equiv="refresh" content="0;url=cart.php">';
} else {
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
}
