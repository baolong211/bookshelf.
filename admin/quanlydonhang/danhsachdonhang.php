<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng</title>

    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container">
        <h1>DANH SÁCH ĐƠN HÀNG</h1>

        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
            Thêm mới đơn hàng
        </button>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Id đơn hàng</th>
                    <th>Id khách hàng</th>
                    <th>Id đặt hàng</th>
                    <th>Id sản phẩm</th>
                    <th>Tên sách</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Phương thức thanh toán</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>

                <?php

                include('../ketnoi.php');
                //Lệnh upload hình đơn hàng
                if (isset($_POST['file'])) {
                    var_dump($_POST['file']);
                }

                // Kiểm tra nếu có dữ liệu được gửi từ form tìm kiếm
                if (isset($_GET['search'])) {
                    // Lấy từ khóa tìm kiếm từ form
                    $search_term = $_GET['search'];

                    // Tạo câu truy vấn để tìm kiếm đơn hàng
                    $sql = "SELECT * FROM hoadon ORDER BY 'idhoadon' ";

                    // Thực thi câu truy vấn
                    $result = $conn->query($sql);

                    // Kiểm tra kết quả
                    if ($result->num_rows > 0) {
                        // Hiển thị kết quả tìm kiếm
                        while ($row = $result->fetch_assoc()) {
                ?>
                            <tr>
                                <td><?php echo $row['idhoadon']; ?></td>
                                <td><?php echo $row['idkhachhang']; ?></td>
                                <td><?php echo $row['iddathang']; ?></td>
                                <td><?php echo $row['idsanpham']; ?></td>
                                <td><?php echo $row['tensach']; ?></td>
                                <td><?php echo $row['gia']; ?></td>
                                <td><?php echo $row['sl']; ?></td>
                                <td><?php echo $row['phuongthucthanhtoan']; ?></td>
                                <td><a onclick="return confirm('Bạn có muốn hủy đơn hàng này không?')" href="xoa_donhang.php?sid=<?php echo $row['idhoadon']; ?>" class="btn btn-danger" id="huy">Hủy</a></td>

                            </tr>
                        <?php
                        }
                        ?>
                        <?php
                    } else {
                        // Nếu không tìm thấy đơn hàng nào phù hợp
                        echo "Không tìm thấy đơn hàng nào phù hợp.";
                    }
                } else {
                    // Nếu không có dữ liệu tìm kiếm được gửi, hiển thị tất cả đơn hàng với phân trang

                    // Số đơn hàng trên mỗi trang
                    $products_per_page = 12;

                    // Xác định trang hiện tại
                    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

                    // Lấy tổng số đơn hàng
                    $result = $conn->query("SELECT COUNT(*) AS total FROM hoadon");
                    $row = $result->fetch_assoc();
                    $total_products = $row['total'];

                    // Tính tổng số trang
                    $total_pages = ceil($total_products / $products_per_page);

                    // Tính offset cho câu truy vấn
                    $offset = ($page - 1) * $products_per_page;

                    //Truy vấn để lấy các đơn hàng cho trang hiện tại
                    $sql = "SELECT * FROM hoadon LIMIT $offset, $products_per_page";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $row['idhoadon']; ?></td>
                                <td><?php echo $row['idkhachhang']; ?></td>
                                <td><?php echo $row['iddathang']; ?></td>
                                <td><?php echo $row['idsanpham']; ?></td>
                                <td><?php echo $row['tensach']; ?></td>
                                <td><?php echo $row['gia']; ?></td>
                                <td><?php echo $row['sl']; ?></td>
                                <td><?php echo $row['phuongthucthanhtoan']; ?></td>
                                <td><a onclick="return confirm('Bạn có muốn hủy đơn hàng này không?')" href="xoa_donhang.php?sid=<?php echo $row['idhoadon']; ?>" class="btn btn-danger" id="huy">Hủy</a></td>

                            </tr>
                        <?php
                        }
                        ?>
                <?php
                    } else {
                        echo "Không có đơn hàng nào.";
                    }

                    // Hiển thị phân trang
                    echo '<div class="pagination-container">';
                    $start = max(1, $page - 2);
                    $end = min($total_pages, $page + 2);

                    if ($page > 1) {
                        echo '<a href="?page=1" class="pagination-link">First</a>';
                        echo '<a href="?page=' . ($page - 1) . '" class="pagination-link">Prev</a>';
                    }

                    if ($start > 1) {
                        echo '...';
                    }

                    for ($i = $start; $i <= $end; $i++) {
                        if ($i == $page) {
                            echo '<a href="?page=' . $i . '" class="pagination-link current-page">' . $i . '</a>';
                        } else {
                            echo '<a href="?page=' . $i . '" class="pagination-link">' . $i . '</a>';
                        }
                    }

                    if ($end < $total_pages) {
                        echo '...';
                    }

                    if ($page < $total_pages) {
                        echo '<a href="?page=' . ($page + 1) . '" class="pagination-link">Next</a>';
                        echo '<a href="?page=' . $total_pages . '" class="pagination-link">Last</a>';
                    }
                    echo '</div>';
                }

                // Đóng kết nối
                $conn->close();
                ?>

            </tbody>
        </table>

    </div>
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Form thêm sản phẩm</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="them_donhang.php" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="idhoadon">Id hóa đơn</label>
                            <input type="text" id="idhoadon" name="idhoadon" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="idkhachhang">Id khách hàng</label>
                            <input type="text" id="idkhachhang" name="idkhachhang" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="iddathang">Id đặt hàng</label>
                            <input type="text" id="iddathang" name="iddathang" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="idsanpham">Id sản phẩm</label>
                            <input type="text" id="idsanpham" name="idsanpham" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="idsanpham">Tên sách</label>
                            <input type="text" id="idsanpham" name="tensach" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="idsanpham">Đơn giá</label>
                            <input type="text" id="idsanpham" name="gia" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="idsanpham">Số lượng</label>
                            <input type="text" id="idsanpham" name="sl" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="hinhanh">Phương thức thanh toán</label>
                            <input type="phuongthucthanhtoan" id="phuongthucthanhtoan" name="phuongthucthanhtoan" class="form-control">
                        </div>

                        <button class="btn btn-success" id="btn">Thêm đơn hàng</button>
                        <script>
                            var button = document.getElementById("btn");
                            button.onclick = function() {
                                alert("Thêm đơn hàng thành công!");
                            }
                        </script>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
</body>

</html>