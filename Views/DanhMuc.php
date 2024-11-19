<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img {
            height: 50px;
            width: 50px;
        }
    </style>    
</head>
<body>
    <h2> Danh mục sản phẩm</h2>
    <table class = "table table-hover">
        <thead>
            <th>STT</th>;
            <th>Danh mục</th>;
            <th>Hình ảnh mô tả</th>;
        </thead>
        <tbody>    
    <?php
        $conn = mysqli_connect("localhost", "root", "", "ptshop");
        $sql =  "SELECT*FROM danhmuc where ID ";
        $kq = mysqli_query($conn, $sql);
        while ($dong = mysqli_fetch_array($kq)) {
            echo '<tr>';
            echo '<td>'.$dong['ID']. '</td>'; ?>
            <td><a href="" ><?php echo $dong['TenDanhMuc'] ?></a> </td>
            <td> <img src =<?php echo $dong['HinhAnh']; ?> alt=""> </td>
            <?php
            echo '</tr>';
        }
    ?>   
    </tbody>
    </table> 
</body>
</html>