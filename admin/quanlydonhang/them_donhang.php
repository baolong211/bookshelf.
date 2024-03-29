<?php
    //Nhận dữ liệu từ form
    $idhoadon = $_POST['idhoadon'];
    $idsanpham = $_POST['idsanpham'];
    $idkhachhang = $_POST['idkhachhang'];
    $iddathang = $_POST['iddathang'];
    $pttt = $_POST['phuongthucthanhtoan'];

    //Kết nối csdl
    require_once '../ketnoi.php';

    //Lệnh thêm dữ liệu
    $themdulieu = "INSERT INTO hoadon (idhoadon, idsanpham, idkhachhang, iddathang, phuongthucthanhtoan) VALUES
     ('$idhoadon','$idsanpham','$idkhachhang','$iddathang','$pttt')";

    //Lệnh upload hình
    if (isset($_POST['file'])){
       var_dump($_POST['file']);
    }

    
    //Thực thi lệnh thêm

    if (mysqli_query($conn, $themdulieu)
    ) {
        //thanh cong, quay ve trang liet ke
        header("Location: danhsachdonhang.php");
    }
    
?>