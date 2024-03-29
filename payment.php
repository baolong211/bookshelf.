<?php
include 'addtocart.php';
// function taodh($madh, $tdh, $pttt, $hoten, $diachi, $email, $dienthoai)
// {
//     include 'connect.php';
//     $sql  = "INSERT INTO `dathang`(madh, tongdh, pttt, ten, diachi, email, sodienthoai)
//     VALUES('" . $madh . "','" . $tdh . "','" . $pttt . "','" . $hoten . "','" . $diachi . "','" . $email . "','" . $dienthoai . "')";
//     if ($conn->query($sql) === TRUE) {
//         $last_id = $conn->insert_id;
//         $conn->close();
//         return $last_id;
//     } else {
//         echo "Lỗi: " . $sql . "<br>" . $conn->error;
//     }
// }

// function add($iddh, $id, $tensach, $gia, $sl)
// {
//     include 'connect.php';
//     include 'addtocart.php';
//     $sql  = "INSERT INTO `hoadon`(iddathang, idsanpham, tensach, gia, sl)
//     VALUES('" . $iddh . "','" . $id . "','" . $tensach . "','" . $gia . "','" . $sl . "')";
//     if ($conn->query($sql) === TRUE) {
//         $conn->close();
//     } else {
//         echo "Lỗi: " . $sql . "<br>" . $conn->error;
//     }
// }

// if ((isset($_POST['thanhtoan'])) &&  ($_POST['thanhtoan'])) {
//     //lấy dữ liệu
//     $tdh = $_POST['tongdonhang'];
//     $hoten = $_POST['hoten'];
//     $diachi = $_POST['diachi'];
//     $email = $_POST['email'];
//     $dienthoai = $_POST['dienthoai'];
//     $pttt = $_POST['pttt'];
//     $madh = "BS" . rand(0, 99999);
//     //tạo đơn hàng
//     $iddh = taodh($madh, $tdh, $pttt, $hoten, $diachi, $email, $dienthoai);
//     $_SESSION['iddh'] = $iddh;
//     if (isset($_SESSION['cart']) && (count($_SESSION['cart']) > 0)) {
//         foreach ($_SESSION['cart'] as $item) {
//             add($iddh, $item[0], $item[1], $item[2], $item[3]);
//         }
//         unset($_SESSION['cart']);
//     }
// }

function taodh($madh, $tdh, $pttt, $hoten, $diachi, $email, $dienthoai, $idkhachhang = null)
{
    include 'connect.php';
    if ($idkhachhang !== null) {
        $sql  = "INSERT INTO `dathang`(madh, tongdh, pttt, ten, diachi, email, sodienthoai, idkhachhang)
                 VALUES('$madh', '$tdh', '$pttt', '$hoten', '$diachi', '$email', '$dienthoai', '$idkhachhang')";
    } else {
        $sql  = "INSERT INTO `dathang`(madh, tongdh, pttt, ten, diachi, email, sodienthoai)
                 VALUES('$madh', '$tdh', '$pttt', '$hoten', '$diachi', '$email', '$dienthoai')";
    }

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        $conn->close();
        return $last_id;
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

function add($iddh, $id, $tensach, $gia, $sl, $idkhachhang = null)
{
    include 'connect.php';
    include 'addtocart.php';
    if ($idkhachhang !== null) {
        $sql  = "INSERT INTO `hoadon`(iddathang, idsanpham, tensach, gia, sl, idkhachhang)
                 VALUES('$iddh', '$id', '$tensach', '$gia', '$sl', '$idkhachhang')";
    } else {
        $sql  = "INSERT INTO `hoadon`(iddathang, idsanpham, tensach, gia, sl)
                 VALUES('$iddh', '$id', '$tensach', '$gia', '$sl')";
    }

    if ($conn->query($sql) === TRUE) {
        $conn->close();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

if ((isset($_POST['thanhtoan'])) && ($_POST['thanhtoan'])) {
    // lấy dữ liệu
    $tdh = $_POST['tongdonhang'];
    $hoten = $_POST['hoten'];
    $diachi = $_POST['diachi'];
    $email = $_POST['email'];
    $dienthoai = $_POST['dienthoai'];
    $pttt = $_POST['pttt'];
    $madh = "BS" . rand(0, 99999);

    // Kiểm tra nếu người dùng đã đăng nhập
    if (isset($_SESSION['email'])) {
        // Lấy idkhachhang từ bảng khachhang
        $email = $_SESSION['email'];
        $query = "SELECT idkhachhang FROM khachhang WHERE email = '$email'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $idkhachhang = $row['idkhachhang'];
        } else {
            echo "Lỗi: Không tìm thấy thông tin khách hàng";
            exit;
        }
    } else {
        $idkhachhang = null;
    }

    // tạo đơn hàng
    $iddh = taodh($madh, $tdh, $pttt, $hoten, $diachi, $email, $dienthoai, $idkhachhang);
    $_SESSION['iddh'] = $iddh;
    if (isset($_SESSION['cart']) && (count($_SESSION['cart']) > 0)) {
        foreach ($_SESSION['cart'] as $item) {
            add($iddh, $item[0], $item[1], $item[2], $item[3], $idkhachhang);
        }
        unset($_SESSION['cart']);
    }
}


function getshowcart($iddh)
{
    include 'connect.php';
    $cartItems = array(); // Mảng để lưu giá trị

    $sql = "SELECT * FROM `hoadon` WHERE iddathang=" . $iddh;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Duyệt qua các hàng kết quả và lưu vào mảng
        while ($row = $result->fetch_assoc()) {
            $cartItems[] = $row; // Thêm hàng vào mảng
        }
    } else {
        echo "0 kết quả";
    }

    $conn->close();

    return $cartItems; // Trả về mảng kết quả
}

function getorderinfo($iddh)
{
    include 'connect.php';
    $cartItems = array(); // Mảng để lưu giá trị

    $sql = "SELECT * FROM `dathang` WHERE iddathang=" . $iddh;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Duyệt qua các hàng kết quả và lưu vào mảng
        while ($row = $result->fetch_assoc()) {
            $cartItems[] = $row; // Thêm hàng vào mảng
        }
    } else {
        echo "0 kết quả";
    }

    $conn->close();

    return $cartItems; // Trả về mảng kết quả
}
