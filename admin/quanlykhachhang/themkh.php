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

    //Kết nối csdl
    require_once '../ketnoi.php';

    //Lệnh thêm dữ liệu
    $themkhachhang = "INSERT INTO khachhang (idkhachhang, tendangnhap, matkhau, email, ten, diachi, sodienthoai , idvaitro) VALUES
     ('$idkh','$tendangnhap','$matkhau','$email', '$ten' , '$diachi','$sodienthoai','$idvt')";
    

    //Lệnh upload hình
    /*if (isset($$_POST['diachi'])){
        var_dump($_POST['diachi']);
    }
    */
    
    //Thực thi lệnh thêm
    if (mysqli_query($conn, $themkhachhang)
    ) {
        //thanh cong, quay ve trang liet ke khachhang
        header("Location: lietkekh.php");
    }
?>