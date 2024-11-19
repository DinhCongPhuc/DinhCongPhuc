<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "ptshop");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    echo "Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.";
    exit;
}
$check_user = "SELECT * FROM dangki WHERE IDUser = '$user_id'";
$user_result = mysqli_query($conn, $check_user);

if (mysqli_num_rows($user_result) == 0) {
    echo "ID người dùng không tồn tại trong bảng dangki.";
    exit;
}
?>