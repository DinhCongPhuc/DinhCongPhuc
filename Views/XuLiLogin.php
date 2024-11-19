<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "ptshop");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST['user']);
    $password = trim($_POST['password']);

    if (empty($user) || empty($password)) {
        echo "Không được để trống thông tin đăng nhập!";
    } else {
        $user = mysqli_real_escape_string($conn, $user);
        $sql = "SELECT * FROM dangki WHERE TenDangNhap = '$user'";
        $kq = mysqli_query($conn, $sql);

        if (mysqli_num_rows($kq) > 0) {
            $dong = mysqli_fetch_assoc($kq);
            if ($password == $dong['MatKhau']) {
                $_SESSION['user_id'] = $dong['IDUser'];
                $_SESSION['username'] = $dong['TenNguoiDung'];
                $_SESSION['role'] = $dong['VaiTro'];

                if ($dong['VaiTro'] == 'Admin') {
                    header("Location: Addmin_QuanLiTK.php"); 
                } else {
                    header("Location: TrangChu.php"); 
                }
                exit();
            } else {
                echo "Mật khẩu không chính xác!";
            }
        } else {
            echo "Tên đăng nhập không tồn tại!";
        }
    }
}
?>
