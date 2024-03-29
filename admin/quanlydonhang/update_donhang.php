<?php
    //Nhận dữ liệu từ form
    $idhoadon = $_POST['idhoadon'];
    $idsanpham = $_POST['idsanpham'];
    $idkhachhang = $_POST['idkhachhang'];
    $iddathang = $_POST['iddathang'];
    $pttt = $_POST['phuongthucthanhtoan'];

    $id = $_POST['sid'];
    //Kết nối csdl
    require_once '../ketnoi.php';

    

    //Lệnh update dữ liệu
    $update_sql = "UPDATE hoadon SET idhoadon='$idhoadon', idsanpham='$idsanpham', idkhachhang='$idkhachhang',
    iddathang='$iddathang', phuongthucthanhtoan='$pttt' ";
    
    //Thực thi lệnh thêm
    if (mysqli_query($conn, $update_sql)
    ) {
        //thanh cong, quay ve trang liet ke
        header("Location: danhsachdonhang.php");
    }
?>
    <img src="" alt="">