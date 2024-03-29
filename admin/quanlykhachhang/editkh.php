<?php
    //lay id cua edit
    $idkhachhang = $_GET['sid'];

    //ket noi
    require_once '../ketnoi.php';

    //cau lenh lay thong tin co id = $id
    $edit_kh = "SELECT * FROM khachhang WHERE idkhachhang=$idkhachhang";

    $result = mysqli_query($conn, $edit_kh);
    $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">
       <h1>Form sửa khách hàng</h1>
       <form action="updatekh.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="sid" value="<?php echo $idkhachhang; ?>" idkhachhang="" >
                <div class="form-group">
                    <label for="idkhachhang">Id khách hàng</label>
                    <input type="text" id="idkhachhang" name="idkhachhang" class="form-control" value="<?php echo $row['idkhachhang'] ?>" >
                </div>
                <div class="form-group">
                    <label for="tendangnhap">Tên đăng nhập</label>
                    <input type="text" id="tendangnhap" name="tendangnhap" class="form-control" value="<?php echo $row['tendangnhap'] ?>" >
                </div>
                <div class="form-group">
                    <label for="matkhau">Mật khẩu</label>
                    <input type="text" id="matkhau" name="matkhau" class="form-control" value="<?php echo $row['matkhau'] ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control" value="<?php echo $row['email'] ?>" >
                </div>
                <div class="form-group">
                    <label for="ten">Tên</label>
                    <input type="ten" id="ten" name="ten"  class="form-control" value="<?php echo $row['ten'] ?>" >
                </div>
                <div class="form-group">
                    <label for="diachi">Địa chỉ</label>
                    <input type="text" id="diachi" name="diachi"  class="form-control" value="<?php echo $row['diachi'] ?>" >
                </div>
                <div class="form-group">
                    <label for="sodienthoai">Số điện thoại</label>
                    <input type="text" id="sodienthoai" name="sodienthoai" class="form-control" value="<?php echo $row['sodienthoai'] ?>" >
                </div>
                <div class="form-group">
                    <label for="idvaitro">Id vai trò</label>
                    <input type="text" id="idvaitro" name="idvaitro" class="form-control" value="<?php echo $row['idvaitro'] ?>" >
                </div>
            
            <button class="btn btn-success" id="btn">Cập nhật khách hàng</button>
            <script>
            var button = document.getElementById("btn");
            button.onclick = function() {
            alert("Cập nhật khách hàng thành công!");
            }
            </script>
       </form>
    </div>
</body>
</body>
</html>