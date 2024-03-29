<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>

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
        <h1>DANH SÁCH SẢN PHẨM</h1>

        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
        Thêm mới sản phẩm
        </button>
    
    <table class="table table-hover">
    <thead>
      <tr>
        <th>Id sản phẩm</th>
        <th>Thể loại</th>
        <th>Giá</th>
        <th>Tên sách</th>
        <th>Hình ảnh</th>
        <th>Thông tin</th>
        <th>Giới thiệu</th>
        <th>Id thể loại</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody>
    
    <?php
                include '../ketnoi.php';
                
                //Lệnh upload hình sản phẩm
                if(isset($_POST['fileToUpload'])){
                    var_dump($_POST['fileToUpload']);
                }

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
                    ?>
                    <tr>
                    <td><?php echo $row['idsanpham']; ?></td>
                    <td><?php echo $row['theloai']; ?></td>
                    <td><?php echo $row['gia']; ?></td>
                    <td><?php echo $row['tensach']; ?></td>
                    <td><?php echo $row['hinhanh']; ?></td>
                    <td><?php echo $row['thongtin']; ?></td>
                    <td><?php echo $row['gioithieu']; ?></td>
                    <td><?php echo $row['idtheloai']; ?></td>
                    <td><a onclick="return confirm('Bạn có muốn sửa sản phẩm này không?')" href="edit.php?sid=<?php echo $row['idsanpham']; ?>" class="btn btn-info">Sửa</a>
                    <a onclick="return confirm('Bạn có muốn xóa sản phẩm này không?')" href="xoa.php?sid=<?php echo $row['idsanpham']; ?>" class="btn btn-danger" id="btn-danger">Xóa</a></td>
                    
                </tr>
            <?php
            }
            ?>
                    <?php           
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
                            ?>
                            <tr>
                     <td><?php echo $row['idsanpham']; ?></td>
                     <td><?php echo $row['theloai']; ?></td>
                     <td><?php echo $row['gia']; ?></td>
                     <td><?php echo $row['tensach']; ?></td>
                     <td><?php echo $row['hinhanh']; ?></td>
                     <td><?php echo $row['thongtin']; ?></td>
                     <td><?php echo $row['gioithieu']; ?></td>
                     <td><?php echo $row['idtheloai']; ?></td>
                     <td><a onclick="return confirm('Bạn có muốn sửa sản phẩm này không?')" href="edit.php?sid=<?php echo $row['idsanpham']; ?>" class="btn btn-info">Sửa</a>
                     <a onclick="return confirm('Bạn có muốn xóa sản phẩm này không?')" href="xoa.php?sid=<?php echo $row['idsanpham']; ?>" class="btn btn-danger" id="btn-danger">Xóa</a></td>
                     
                 </tr>
             <?php
             }
             ?>
                    <?php             
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
      <form action="them.php" method="post" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="idsanpham">Id sản phẩm</label>
                <input type="text" id="idsanpham" name="idsanpham" class="form-control" >
            </div>
            <div class="form-group">
                <label for="theloai">Thể loại</label>
                <input type="text" id="theloai" name="theloai" class="form-control" >
            </div>
            <div class="form-group">
                <label for="gia">Giá</label>
                <input type="text" id="gia" name="gia" class="form-control">
            </div>
            <div class="form-group">
                <label for="tensach">Tên sách</label>
                <input type="text" id="tensach" name="tensach" class="form-control" >
            </div>
            <div class="form-group">
                <label for="hinhanh">Hình ảnh</label>
                <input type="file" id="fileToUpload" name="fileToUpload"  class="form-control" >
            </div>
            <div class="form-group">
                <label for="thongtin">Thông tin</label>
                <input type="text" id="thongtin" name="thongtin"  class="form-control" >
            </div>
            <div class="form-group">
                <label for="gioithieu">Giới thiệu</label>
                <input type="text" id="gioithieu" name="gioithieu" class="form-control" >
            </div>
            <div class="form-group">
                <label for="idtheloai">Id thể loại</label>
                <input type="text" id="idtheloai" name="idtheloai" class="form-control" >
            </div>
        
        <button class="btn btn-success"  id="btn">Thêm sản phẩm</button>
        <script>
            var button = document.getElementById("btn");
            button.onclick = function() {
            alert("Thêm sản phẩm thành công!");
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

