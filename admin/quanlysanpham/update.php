<?php
    //Nhận dữ liệu từ form
    $idsp = $_POST['idsanpham'];
    $theloai = $_POST['theloai'];
    $gia = $_POST['gia'];
    $tensach = $_POST['tensach'];
    $hinhanh = $_POST['file'];
    $thongtin = $_POST['thongtin'];
    $gioithieu = $_POST['gioithieu'];
    $idtl = $_POST['idtheloai'];

    $id = $_POST['sid'];
    //Kết nối csdl
    require_once '../ketnoi.php';

    //Lệnh upload hình
    if (isset($$_POST['file'])){
        var_dump($_POST['file']);
    }

    //Lệnh update dữ liệu
    $update_sql = "UPDATE sanpham SET idsanpham='$idsp', theloai='$theloai', gia='$gia', tensach='$tensach',
    hinhanh='$hinhanh', thongtin='$thongtin', gioithieu='$gioithieu', idtheloai='$idtl' WHERE idsanpham=$id ";
    
    //Thực thi lệnh thêm
    if (mysqli_query($conn, $update_sql)
    ) {
        
        //thanh cong, quay ve trang liet ke
        header("Location: lietke.php");
    }
?>
    <img src="" alt="">