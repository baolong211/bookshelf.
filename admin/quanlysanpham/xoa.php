
<?php
    //lay du lieu tu id can xoa
    $id = $_GET['sid'];
    //echo $id;
    
    //ket noi
    require_once '../ketnoi.php';
    //lenh xoa
    $xoa = "DELETE FROM sanpham WHERE idsanpham=$id";
    
    mysqli_query($conn, $xoa);
    //echo "<h1>Xoa thanh cong</h1>";
    
    //quay ve trang liet ke sau khi xoa thanh cong 
    
    header("Location: lietke.php");
    ?>