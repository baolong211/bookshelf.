<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bookshelf</title>

    <link rel="icon" type="image/x-icon" href="img/favicon.ico">

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fonts.css">
</head>

<body>
    <?php
    include 'connect.php';

    // Kiểm tra xem id sản phẩm có được truyền từ URL không
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        // Lấy id sản phẩm từ URL
        $id_sanpham = $_GET['id'];

        // Truy vấn để lấy thông tin chi tiết sản phẩm
        $sql = "SELECT * FROM sanpham WHERE idsanpham = $id_sanpham";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $theloai = $row['theloai'];
            $gia = number_format($row['gia']);
            $tensach = $row['tensach'];
            $hinhanh = $row['hinhanh'];
            $thongtin = $row['thongtin'];
            $gioithieu = $row['gioithieu'];

            // Hiển thị thông tin chi tiết sản phẩm
            echo '<div class="product-details">';
            echo '<h2>' . $tensach . '</h2>';
            echo '<div class="imgtt">';
            echo '<img src="' . $hinhanh . '" alt="' . $tensach . '">';
            echo '<div class="form">';
            echo '<form action="addtocart.php" method="POST">
                    <input type="number" name="sl" id="input" class="form-control" value="1" min=1 max=50>
                    <input type="hidden" name="id" value="' . $row["idsanpham"] . '">
                    <input type="hidden" name="tensach" value="' . $row["tensach"] . '">
                    <input type="hidden" name="gia" value="' . $row["gia"] . '">
                    <input type="submit" value="Đặt hàng" name="add">
                </form>';
            echo '</div>';
            echo '</div>';
            echo '<p><strong>Thể loại:</strong> ' . $theloai . '</p>';
            echo '<p><strong>Giá:</strong> ' . $gia . ' đ</p>';
            echo '<p><strong>Thông tin:</strong> ' . $thongtin . '</p>';
            echo '<p><strong>Giới thiệu:</strong> ' . $gioithieu . '</p>';
            echo '</div>';
        } else {
            echo "Không tìm thấy sản phẩm.";
        }
    } else {
        echo "Không có ID sản phẩm được cung cấp.";
    }

    // Đóng kết nối
    $conn->close();
    ?>
</body>

</html>