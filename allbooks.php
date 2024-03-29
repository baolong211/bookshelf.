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
    <section class="scbooks">
        <div class="container">
            <div class="scbooks__content">
                <div class="textbox">
                    <h2 class="heading">More Then 9000+ <br> Books</h2>
                </div>
            </div>

            <div class="scbooks__listcard">
                <?php
                include 'connect.php';

                // Kiểm tra nếu có dữ liệu được gửi từ form tìm kiếm
                if (isset($_GET['search'])) {
                    // Lấy từ khóa tìm kiếm từ form
                    $search_term = $_GET['search'];

                    // Tạo câu truy vấn để tìm kiếm sản phẩm
                    $sql = "SELECT * FROM sanpham WHERE tensach LIKE '%$search_term%' OR thongtin LIKE '%$search_term%' OR theloai LIKE '%$search_term%'";

                    // Thực thi câu truy vấn
                    $result = $conn->query($sql);

                    // Kiểm tra kết quả
                    if ($result->num_rows > 0) {
                        // Hiển thị kết quả tìm kiếm
                        while ($row = $result->fetch_assoc()) {
                            echo '<form action="addtocart.php" method="POST">';
                            echo '<div class="card">';
                            echo '<div class="card__img">';
                            echo '<a href="details.php?id=' . $row["idsanpham"] . '" class="book-thumb"><img src="' . $row["hinhanh"] . '" alt="bookshelf"></a>';
                            echo '</div>';
                            echo '<div class="card__des">';
                            echo '<h3 class="title">' . $row["tensach"] . '</h3>';
                            echo '<div class="info">';
                            echo '<div class="price">';
                            echo '<p class="text">' . number_format($row["gia"]) . ' đ</p>';
                            echo '</div>';
                            echo '<div class="addtocart">';
                            echo '<input type="submit" name="add" value="ADD">';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '<input type="hidden" name="id" value="' . $row["idsanpham"] . '">';
                            echo '<input type="hidden" name="tensach" value="' . $row["tensach"] . '">';
                            echo '<input type="hidden" name="gia" value="' . $row["gia"] . '">';
                            echo '</form>';
                        }
                    } else {
                        // Nếu không tìm thấy sản phẩm nào phù hợp
                        echo "Không tìm thấy sản phẩm nào phù hợp.";
                    }
                } else {
                    // Nếu không có dữ liệu tìm kiếm được gửi, hiển thị tất cả sản phẩm với phân trang

                    // Số sản phẩm trên mỗi trang
                    $products_per_page = 12;

                    // Xác định trang hiện tại
                    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

                    // Lấy tổng số sản phẩm
                    $result = $conn->query("SELECT COUNT(*) AS total FROM sanpham");
                    $row = $result->fetch_assoc();
                    $total_products = $row['total'];

                    // Tính tổng số trang
                    $total_pages = ceil($total_products / $products_per_page);

                    // Tính offset cho câu truy vấn
                    $offset = ($page - 1) * $products_per_page;

                    //Truy vấn để lấy các sản phẩm cho trang hiện tại
                    $sql = "SELECT * FROM sanpham LIMIT $offset, $products_per_page";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $ten_sach = $row["tensach"];
                            if (strlen($ten_sach) > 40) {
                                $ten_sach = substr($ten_sach, 0, 40);
                                $ten_sach = substr($ten_sach, 0, strrpos($ten_sach, ' '));
                                $ten_sach .= '...';
                            }

                            echo '<form action="addtocart.php" method="POST">';
                            echo '<div class="card">';
                            echo '<div class="card__img">';
                            echo '<a href="details.php?id=' . $row["idsanpham"] . '" class="book-thumb"><img src="' . $row["hinhanh"] . '" alt="bookshelf"></a>';
                            echo '</div>';
                            echo '<div class="card__des">';
                            echo '<h3 class="title">' . $ten_sach . '</h3>';
                            echo '<div class="info">';
                            echo '<div class="price">';
                            echo '<p class="text">' . number_format($row["gia"]) . ' đ</p>';
                            echo '</div>';
                            echo '<div class="addtocart">';
                            echo '<input type="submit" name="add" value="ADD">';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '<input type="hidden" name="id" value="' . $row["idsanpham"] . '">';
                            echo '<input type="hidden" name="tensach" value="' . $row["tensach"] . '">';
                            echo '<input type="hidden" name="gia" value="' . $row["gia"] . '">';
                            echo '</form>';
                        }
                    } else {
                        echo "Không có sản phẩm nào.";
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
            </div>
        </div>
    </section>

</body>

</html>