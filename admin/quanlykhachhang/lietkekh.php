<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách khách hàng</title>

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
        <h1>DANH SÁCH KHÁCH HÀNG</h1>

        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
        Thêm khách hàng
        </button>
    
    <table class="table table-hover">
    <thead>
      <tr>
        <th>Id khách hàng</th>
        <th>Tên đăng nhập</th>
        <th>Mật khẩu</th>
        <th>Email</th>
        <th>Tên</th>
        <th>Địa chỉ</th>
        <th>Số điện thoại</th>
        <th>Id vai trò</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody>
    
    <?php
                include '../ketnoi.php';

                //Lệnh upload hình khách hàng
                /*if(isset($_POST['diachi'])){
                    var_dump($_POST['diachi']);
                }
                */

                // Kiểm tra nếu có dữ liệu được gửi từ form tìm kiếm
                if (isset($_GET['search'])) {
                    // Lấy từ khóa tìm kiếm từ form
                    $search_term = $_GET['search'];

                    // Tạo câu truy vấn để tìm kiếm khách hàng
                    $sql = "SELECT * FROM khachhang ORDER BY 'idkhachhang' ";

                    // Thực thi câu truy vấn
                    $result = $conn->query($sql);

                    // Kiểm tra kết quả
                    if ($result->num_rows > 0) {
                        // Hiển thị kết quả tìm kiếm
                    while ($row = $result->fetch_assoc()) {
                        ?>
                    <tr>
                    <td><?php echo $row['idkhachhang']; ?></td>
                    <td><?php echo $row['tendangnhap']; ?></td>
                    <td><?php echo $row['matkhau']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['ten']; ?></td>
                    <td><?php echo $row['diachi']; ?></td>
                    <td><?php echo $row['sodienthoai']; ?></td>
                    <td><?php echo $row['idvaitro']; ?></td>
                    <td><a onclick="return confirm('Bạn có muốn sửa khách hàng này không?')" href="editkh.php?sid=<?php echo $row['idkhachhang']; ?>" class="btn btn-info">Sửa</a>
                    <a onclick="return confirm('Bạn có muốn xóa khách hàng này không?')" href="xoakh.php?sid=<?php echo $row['idkhachhang']; ?>" class="btn btn-danger" id="btn-danger">Xóa</a></td>
                    
                </tr>
            <?php
            }
            ?>
                    <?php           
                    } else {
                        // Nếu không tìm thấy khách hàng nào phù hợp
                        echo "Không tìm thấy khách hàng nào phù hợp.";
                    }
                } else {
                    // Nếu không có dữ liệu tìm kiếm được gửi, hiển thị tất cả khách hàng với phân trang

                    // Số khách hàng trên mỗi trang
                    $products_per_page = 12;

                    // Xác định trang hiện tại
                    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

                    // Lấy tổng số khách hàng
                    $result = $conn->query("SELECT COUNT(*) AS total FROM khachhang");
                    $row = $result->fetch_assoc();
                    $total_products = $row['total'];

                    // Tính tổng số trang
                    $total_pages = ceil($total_products / $products_per_page);

                    // Tính offset cho câu truy vấn
                    $offset = ($page - 1) * $products_per_page;

                    //Truy vấn để lấy các khách hàng cho trang hiện tại
                    $sql = "SELECT * FROM khachhang LIMIT $offset, $products_per_page";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                        <td><?php echo $row['idkhachhang']; ?></td>
                        <td><?php echo $row['tendangnhap']; ?></td>
                        <td><?php echo $row['matkhau']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['ten']; ?></td>
                        <td><?php echo $row['diachi']; ?></td>
                        <td><?php echo $row['sodienthoai']; ?></td>
                        <td><?php echo $row['idvaitro']; ?></td>
                     <td><a onclick="return confirm('Bạn có muốn sửa khách hàng này không?')" href="editkh.php?sid=<?php echo $row['idkhachhang']; ?>" class="btn btn-info">Sửa</a>
                     <a onclick="return confirm('Bạn có muốn xóa khách hàng này không?')" href="xoakh.php?sid=<?php echo $row['idkhachhang']; ?>" class="btn btn-danger" id="btn-danger">Xóa</a></td>
                     
                 </tr>
             <?php
             }
             ?>
                    <?php             
                    } else {
                        echo "Không có khách hàng nào.";
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
        <h4 class="modal-title">Form thêm khách hàng</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form action="themkh.php" method="post" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="idkhachhang">Id khách hàng</label>
                <input type="text" id="idkhachhang" name="idkhachhang" class="form-control" >
            </div>
            <div class="form-group">
                <label for="tendangnhap">Tên đăng nhập</label>
                <input type="text" id="tendangnhap" name="tendangnhap" class="form-control" >
            </div>
            <div class="form-group">
                <label for="matkhau">Mật khẩu</label>
                <input type="text" id="matkhau" name="matkhau" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control" >
            </div>
            <div class="form-group">
                <label for="ten">Tên</label>
                <input type="text" id="ten" name="ten" class="form-control" >
            </div>
            <div class="form-group">
                <label for="diachi">Địa chỉ</label>
                <input type="diachi" id="diachi" name="diachi"  class="form-control" >
            </div>
            <div class="form-group">
                <label for="sodienthoai">Số điện thoại</label>
                <input type="text" id="sodienthoai" name="sodienthoai"  class="form-control" >
            </div>
            <div class="form-group">
                <label for="idvaitro">Id vai trò</label>
                <input type="text" id="idvaitro" name="idvaitro" class="form-control" >
            </div>
        
        <button class="btn btn-success"  id="btn">Thêm khách hàng</button>
        <script>
            var button = document.getElementById("btn");
            button.onclick = function() {
            alert("Thêm khách hàng thành công!");
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

