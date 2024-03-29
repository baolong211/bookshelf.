<?php
// Lấy dữ liệu từ id cần xóa
$idkhachhang = $_GET['sid'];

// Kết nối
require_once '../ketnoi.php';

// Kiểm tra xem idkhachhang có xuất hiện trong bảng dathang hoặc hoadon hay không
$kiemtra = "(SELECT idkhachhang FROM dathang WHERE idkhachhang = $idkhachhang) ";
$kiemtra .= "UNION ";
$kiemtra .= "(SELECT idkhachhang FROM hoadon WHERE idkhachhang = $idkhachhang)";

$result = mysqli_query($conn, $kiemtra);

// Nếu có bản ghi trong dathang hoặc hoadon, không cho phép xóa
if (mysqli_num_rows($result) > 0) {
    echo "<h1>Không thể xóa khách hàng này vì đã có đơn hàng hoặc hóa đơn liên quan!</h1>";
} else {
    // Nếu không có bản ghi, thực hiện xóa
    $xoakh = "DELETE FROM khachhang WHERE idkhachhang = $idkhachhang";
    mysqli_query($conn, $xoakh);
    // Chuyển hướng về trang liệt kê sau khi xóa thành công
    header("Location: lietkekh.php");
}
