<?php
    //lay id cua edit
    $id = $_GET['sid'];

    //ket noi
    require_once '../ketnoi.php';

    //cau lenh lay thong tin co id = $id
    $edit_sql = "SELECT * FROM hoadon WHERE idhoadon=$id";

    $result = mysqli_query($conn, $edit_sql);
    $row = mysqli_fetch_assoc($result);
?>
   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit đơn hàng</title>
   <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <div class="container">
       <h1>Form sửa đơn hàng</h1>
       <form action="update_donhang.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="sid" value="<?php echo $id; ?>" id="" >
                <div class="form-group">
                    <label for="idhoadon">Id hóa đơn</label>
                    <input type="text" id="idhoadon" name="idhoadon" class="form-control" value="<?php echo $row['idhoadon'] ?>" >
                </div>
                <div class="form-group">
                    <label for="idsanpham">Id sản phẩm</label>
                    <input type="text" id="idsanpham" name="idsanpham" class="form-control" value="<?php echo $row['idsanpham'] ?>" >
                </div>
                <div class="form-group">
                    <label for="idkhachhang">Id khách hàng</label>
                    <input type="text" id="idkhachhang" name="idkhachhang" class="form-control" value="<?php echo $row['idkhachhang'] ?>">
                </div>
                <div class="form-group">
                    <label for="iddathang">Id đặt hàng</label>
                    <input type="text" id="iddathang" name="iddathang" class="form-control" value="<?php echo $row['iddathang'] ?>" >
                </div>
                <div class="form-group">
                    <label for="hinhanh">Phương thức thanh toán</label>
                    <input type="phuongthucthanhtoan" id="phuongthucthanhtoan" name="phuongthucthanhtoan"  class="form-control" value="<?php echo $row['phuongthucthanhtoan'] ?>" >
                </div>
                
            <button class="btn btn-success" id="btn">Cập nhật đơn hàng</button>
            <script>
            var button = document.getElementById("btn");
            button.onclick = function() {
            alert("Cập nhật đơn hàng thành công!");
            }
            </script>
       </form>
    </div>
</body>
</html>


    
