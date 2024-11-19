
<?php
session_start();


if (isset($_POST['checkout'])) {
    $customer_name = $_POST['customer_name'];
    $address = $_POST['address'];
    $order_total = 0;

    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            if (is_int($quantity)) {
                $order_total += 10000 * $quantity;
            } else {
                echo "Có lỗi xảy ra: số lượng sản phẩm không hợp lệ.";
                exit();
            }
        }
    } else {
        echo "Giỏ hàng của bạn đang trống.";
        exit();
    }

    $_SESSION['cart'] = [];
    echo "Đơn hàng của bạn đã được xử lý thành công! Tổng số tiền: " . number_format($order_total) . " VND";
}


?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
</head>
<body>

<h1>Thông tin thanh toán</h1>

<form action="XuLiGioHang.php" method="post">
    <label for="customer_name">Tên khách hàng:</label>
    <input type="text" id="customer_name" name="customer_name" required><br><br>

    <label for="address">Địa chỉ:</label>
    <input type="text" id="address" name="address" required><br><br>

    <input type="submit" name="checkout" value="Thanh toán">
</form>

</body>
</html>
