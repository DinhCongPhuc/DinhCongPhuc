<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
    <?php
        $tensp= $_GET['tensp'];
        $mota = $_GET['mota'];
        $gia = $_GET['gia'];
        $giakm = $_GET['giakm'];
        $conn = mysqli_connect("localhost", "root", "", "ptshop");
        $sql = "INSERT INTO sanpham(TenSP, MoTa, GiaGoc, GiaKM) VALUES('$tensp', '$mota', $gia, $giakm)";
        $kq = mysqli_query($conn, $sql);
     ?>
</body>
</html>