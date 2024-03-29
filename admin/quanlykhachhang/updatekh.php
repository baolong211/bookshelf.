<?php
    //Nhận dữ liệu từ form
    $idkh = $_POST['idkhachhang'];
    $tendangnhap = $_POST['tendangnhap'];
    $matkhau = $_POST['matkhau'];
    $email = $_POST['email'];
    $ten = $_POST['ten'];
    $diachi = $_POST['diachi'];
    $sodienthoai = $_POST['sodienthoai'];
    $idvt = $_POST['idvaitro'];

    $idkh = $_POST['sid'];
    //Kết nối csdl
    require_once '../ketnoi.php';

    //Lệnh update dữ liệu
    $update_kh = "UPDATE khachhang SET idkhachhang='$idkh', tendangnhap='$tendangnhap', matkhau='$matkhau', email='$email',
    ten='$ten', diachi='$diachi', sodienthoai='$sodienthoai', idvaitro='$idvt' WHERE idkhachhang=$idkh ";
    
    //Thực thi lệnh thêm
    if (mysqli_query($conn, $update_kh)
    ) {
        
        //thanh cong, quay ve trang liet ke khachhang
        header("Location: lietkekh.php");
    }

    
?>