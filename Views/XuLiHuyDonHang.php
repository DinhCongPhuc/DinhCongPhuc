<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "ptshop");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Lấy id người dùng từ session
$user_id = $_SESSION['user_id'];

// Kiểm tra nếu form đã được gửi với product_id
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    
    // Thực hiện xóa sản phẩm từ giỏ hàng
    $delete_sql = "DELETE FROM giohang WHERE IDUser = '$user_id' AND IDSP = $product_id";
    mysqli_query($conn, $delete_sql);
}

// Sau khi xóa, điều hướng lại trang giỏ hàng
header("Location: GioHang.php");
exit;

mysqli_close($conn);
?>

