<?php
    $conn = mysqli_connect("localhost", "root", "", "ptshop");
    $sql =  "DELETE FROM dangki WHERE ID = ".$_GET['idtk'];
    echo $sql;
    $kq = mysqli_query($conn, $sql);
    header("Location: Addmin_QuanLiTk.php")
 ?>