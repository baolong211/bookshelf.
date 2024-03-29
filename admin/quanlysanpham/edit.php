<?php
    //lay id cua edit
    $id = $_GET['sid'];

    //ket noi
    require_once '../ketnoi.php';

    //cau lenh lay thong tin co id = $id
    $edit_sql = "SELECT * FROM sanpham WHERE idsanpham=$id";

    $result = mysqli_query($conn, $edit_sql);
    $row = mysqli_fetch_assoc($result);
?>
   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit sản phẩm</title>
   <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <div class="container">
       <h1>Form sửa sản phẩm</h1>
       <form action="update.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="sid" value="<?php echo $id; ?>" id="" >
                <div class="form-group">
                    <label for="idsanpham">Id sản phẩm</label>
                    <input type="text" id="idsanpham" name="idsanpham" class="form-control" value="<?php echo $row['idsanpham'] ?>" >
                </div>
                <div class="form-group">
                    <label for="theloai">Thể loại</label>
                    <input type="text" id="theloai" name="theloai" class="form-control" value="<?php echo $row['theloai'] ?>" >
                </div>
                <div class="form-group">
                    <label for="gia">Giá</label>
                    <input type="text" id="gia" name="gia" class="form-control" value="<?php echo $row['gia'] ?>">
                </div>
                <div class="form-group">
                    <label for="tensach">Tên sách</label>
                    <input type="text" id="tensach" name="tensach" class="form-control" value="<?php echo $row['tensach'] ?>" >
                </div>
                <div class="form-group">
                    <label for="hinhanh">Hình ảnh</label>
                    <input type="file" id="file" name="file"  class="form-control" value="<?php echo $row['hinhanh'] ?>" >
                </div>
                <div class="form-group">
                    <label for="thongtin">Thông tin</label>
                    <input type="text" id="thongtin" name="thongtin"  class="form-control" value="<?php echo $row['thongtin'] ?>" >
                </div>
                <div class="form-group">
                    <label for="gioithieu">Giới thiệu</label>
                    <input type="text" id="gioithieu" name="gioithieu" class="form-control" value="<?php echo $row['gioithieu'] ?>" >
                </div>
                <div class="form-group">
                    <label for="idtheloai">Id thể loại</label>
                    <input type="text" id="idtheloai" name="idtheloai" class="form-control" value="<?php echo $row['idtheloai'] ?>" >
                </div>
            
            <button class="btn btn-success" id="btn">Cập nhật sản phẩm</button>
            <script>
            var button = document.getElementById("btn");
            button.onclick = function() {
            alert("Cập nhật sản phẩm thành công!");
            }
            </script>
       </form>
    </div>
</body>
</html>


    
