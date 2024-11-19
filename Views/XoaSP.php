<?php
    $conn = mysqli_connect("localhost", "root", "", "ptshop");
    $sql =  "DELETE FROM sanpham WHERE ID = ".$_GET['idsp'];
    echo $sql;
    $kq = mysqli_query($conn, $sql);
    header ('http://localhost/B%c3%a0i%20T%e1%ba%adp/PTShop/TrangChu.php');
 ?>