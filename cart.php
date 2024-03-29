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

            $tdh = 0;
            if (isset($_SESSION['cart']) && (count($_SESSION['cart']) > 0)) {
                echo '<table>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Hành động</th>
                        </tr>';
                $i = 0;

                foreach ($_SESSION['cart'] as $item) {
                    $total = $item[2] * $item[3];
                    $tdh += $total;
                    echo '<tr>
                            <td>' . ($i + 1) . '</td>
                            <td>' . $item[1] . '</td>
                            <td>' . $item[2] . '</td>
                            <td>' . $item[3] . '</td>
                            <td>' . $total . '</td>
                            <td><a href="delcart.php?id=' . $item[0] . '">Xóa</a></td>
                        </tr>';
                    $i++;
                }
                echo '<tr><td colspan="4">Tổng đơn hàng</td>
                        <td>' . number_format($tdh) . 'VNĐ</td>
                        <td></td>
                    </tr>';

                echo '</table>';
            }
            // $conn->close();
            ?>
            <br>
            <div>
                <a href="index.php">Tiếp tục mua hàng</a> | <a href="delcart.php">Xóa giỏ hàng</a>
            </div>
        </div>

        <!-- <div class="info">
            <h2>Thông tin đặt hàng</h2>
            <form action="order.php" method="POST">
                <input type="hidden" name="tongdonhang" value="<?= $tdh ?>">
                <table class="dathang">
                    <tr>
                        <td><input type="text" name="hoten" placeholder="Nhập họ tên"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="diachi" placeholder="Nhập địa chỉ"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="email" placeholder="Nhập email"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="dienthoai" placeholder="Nhập số điện thoại"></td>
                    </tr>
                    <tr>
                        <td>Phương thức thanh toán<br>
                            <input type="radio" name="pttt" value="1"> Thanh toán khi nhận hàng<br>
                            <input type="radio" name="pttt" value="2"> Thanh toán Chuyển khoản<br>
                            <input type="radio" name="pttt" value="3"> Thanh toán ví MoMo<br>
                            <input type="radio" name="pttt" value="4"> Thanh toán Online<br>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="thanhtoan" value="Thanh toán"></td>
                    </tr>
                </table>
            </form>
        </div> -->

        <div class="info">
            <h2>Thông tin đặt hàng</h2>
            <form action="order.php" method="POST">
                <input type="hidden" name="tongdonhang" value="<?= $tdh ?>">
                <table class="dathang">
                    <tr>
                        <td><input type="text" name="hoten" placeholder="Nhập họ tên"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="diachi" placeholder="Nhập địa chỉ"></td>
                    </tr>
                    <?php if (isset($_SESSION['email'])) : ?>
                        <?php
                        include 'connect.php';
                        $email = $_SESSION['email'];
                        $query = "SELECT email FROM khachhang WHERE email = '$email'";
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $email = $row['email'];
                        } else {
                            $email = "";
                        }
                        ?>
                        <input type="hidden" name="email" value="<?= $email ?>">
                    <?php else : ?>
                        <tr>
                            <td><input type="text" name="email" placeholder="Nhập email"></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td><input type="text" name="dienthoai" placeholder="Nhập số điện thoại"></td>
                    </tr>
                    <tr>
                        <td>Phương thức thanh toán<br>
                            <input type="radio" name="pttt" value="1"> Thanh toán khi nhận hàng<br>
                            <input type="radio" name="pttt" value="2"> Thanh toán Chuyển khoản<br>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="thanhtoan" value="Thanh toán"></td>
                    </tr>
                </table>
            </form>
        </div>

    </div>

</body>

</html>