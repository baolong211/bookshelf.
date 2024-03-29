<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/cart.css">
</head>

<body>

    <div class="container">
        <h1>Shopping Cart</h1>

        <div class="cart">
            <?php
            include 'connect.php';
            include 'addtocart.php';
            include 'payment.php';

            $tdh = 0;
            if (isset($_SESSION['iddh']) && ($_SESSION['iddh'] > 0)) {
                $getshowcart = getshowcart($_SESSION['iddh']);
                if (isset($getshowcart) && (count($getshowcart) > 0)) {
                    echo '<table>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                
                            </tr>';
                    $i = 0;

                    foreach ($getshowcart as $item) {
                        $total = $item['sl'] * $item['gia'];
                        $tdh += $total;
                        echo '<tr>
                                <td>' . ($i + 1) . '</td>
                                <td>' . $item['tensach'] . '</td>
                                <td>' . $item['gia'] . '</td>
                                <td>' . $item['sl'] . '</td>
                                <td>' . $total . '</td>
                            </tr>';
                        $i++;
                    }
                    echo '<tr><td colspan="4">Tổng đơn hàng</td>
                            <td>' . number_format($tdh) . 'VNĐ</td>
                        </tr>';

                    echo '</table>';
                }
            } else {
                echo "Không tồn tại giỏ hàng. <a href='index.php'>Tiếp tục mua hàng</a>";
            }
            // $conn->close();
            ?>
        </div>

        <div class="info">
            <?php
            if (isset($_SESSION['iddh']) && ($_SESSION['iddh'] > 0)) {
                $getorderinfo = getorderinfo($_SESSION['iddh']);
                if (isset($getorderinfo) && (count($getorderinfo) > 0)) {
            ?>
                    <h2>Mã đơn hàng: <?= $getorderinfo[0]['madh'] ?></h2>
                    <table class="dathang">
                        <tr>
                            <td><strong>Tên người nhận:</strong> <br><?= $getorderinfo[0]['ten'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Địa chỉ người nhận:</strong> <br><?= $getorderinfo[0]['diachi'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong> <br><?= $getorderinfo[0]['email'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Số điện thoại:</strong> <br><?= $getorderinfo[0]['sodienthoai'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Phương thức thanh toán:</strong><br>
                                <?php
                                switch ($getorderinfo[0]['pttt']) {
                                    case 1:
                                        $mess = "Thanh toán khi nhận hàng(COD)";
                                        break;
                                    case 2:
                                        $mess = "Thanh toán chuyển khoản";
                                        break;
                                    default:
                                        $mess = "Chưa chọn phương thức thanh toán";
                                }
                                echo $mess;
                                ?>
                            </td>
                        </tr>
                    </table>
            <?php
                }
            }
            ?>
        </div>
    </div>

</body>

</html>