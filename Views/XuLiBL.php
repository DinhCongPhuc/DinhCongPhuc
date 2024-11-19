<?php
$conn = mysqli_connect("localhost", "root", "", "ptshop");
if ($_SERVER['REQUEST_METHOD'] == 'POST ') {
    $product_id = $_POST['Product_id'];
    $iduser = 1;
    $binhluan = $_POST['NDSP'];

    $stmt = $conn->prepare("INSERT INTO binhluan (Product_id,IDUser, NDSP) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $product_id, $iduser, $binhluan);
    

}