<!-- <?php
session_start();

// Kết nối tới cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "ptshop");  
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Xử lý thêm vào giỏ hàng
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Truy vấn thông tin sản phẩm từ cơ sở dữ liệu
    $sql = "SELECT * FROM sanpham WHERE ID = $product_id";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);

    if ($product) {
        // Nếu sản phẩm đã có trong giỏ hàng, cộng thêm số lượng
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
        } else {
            // Nếu chưa có, thêm sản phẩm vào giỏ hàng
            $_SESSION['cart'][$product_id] = [
                'name' => $product['TenSP'],
                'price' => $product['GiaKM'],
                'image' => $product['HinhAnh'],
                'quantity' => $quantity
            ];
        }
    }
}

// Xử lý xóa sản phẩm khỏi giỏ hàng
if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];
    unset($_SESSION['cart'][$product_id]);
}

// Đóng kết nối cơ sở dữ liệu

// Chuyển hướng về lại trang giỏ hàng hoặc trang trước đó
header('Location: GioHang.php');
exit();
?> -->
