<?php 
      $conn = mysqli_connect("localhost", "root", "", "ptshop");
      $tennd= trim($_POST['tennd']);
      $user = trim($_POST['user']);
      $email = trim($_POST['email']);
      $password = $_POST['password'];
      $role = 'User';
      $confirm_password = $_POST['confirm_password'];
      if(empty($tennd) || empty($user) || empty($password) || empty($confirm_password)) {
        echo "Không được để trống thông tin cá nhân";
      }  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {       
            echo "Email không lệ!";
        } elseif (!preg_match('/^[A-Z]/',  $password)) {
            echo "Mật khẩu phải bắt đầu bằng chữ cái viết hoa!";
        // } elseif (!preg_match('/^[0-9]/', $password)) {
        //     echo "Mật khẩu phải chứa ít nhất một số!";
        // } elseif (!preg_match('/^[\W]/', $password)) {
        //     echo "Mật khẩu phải chứa ít nhất một kí tự!";
        } elseif($password !== $confirm_password) {
            echo "Mật khẩu không trùng khớp!";
        } else {
            $sql = "INSERT INTO dangki(TenNguoiDung, TenDangNhap, EmailSdt, MatKhau, VaiTro ) VALUES ('$tennd', '$user', '$email', '$password', '$role')";
            $kq = mysqli_query($conn, $sql);
            echo "Đăng kí thành công!";
            header("Location: Login.php");
        }
      mysqli_close($conn);
?>    
   