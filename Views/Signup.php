<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/54f0cb7e4a.js" crossorigin = "anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div id="space">
        <span>PTShop Trao quà - Tặng gửi yêu thương</span>
    </div>

    <div class="n">
    <nav class="navbar navbar-expand-md">
        <div class="container">
            <a href="http://127.0.0.1:5500/PDMVP.html" class="navbar-brand text-light"><b>PTShop</b></a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ml-auto align-items-center">

                    <li class="nav-item " >
                        <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm">
                    </li>
                    
          <li class="nav-item dropdown ">
                        <a href="#" class="nav-link dropdown-toggle" id="categoryDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Danh mục
                        </a>
                        <div class="dropdown-menu" style = "min-width: 300px; background-color: #f0ecebf5; border-radius: 5px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);" aria-labelledby="categoryDropdown">
                            <?php
                            $conn = mysqli_connect("localhost", "root", "", "ptshop");
                            if (!$conn) {
                                die("Kết nối thất bại: " . mysqli_connect_error());
                            }
                            $kq = mysqli_query($conn, "SELECT * FROM danhmuc");
                            if (!$kq) {
                                die("Lỗi truy vấn: " . mysqli_error($conn));
                            }
                            while ($dong = mysqli_fetch_array($kq)) { ?>
                                <a class="dropdown-item" style=" color: #1a1919;" href="#"><?php echo $dong["TenDanhMuc"]; ?></a>
                            <?php } ?>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="GioHang.php?ID=<?php echo $dong['ID']; ?>" class="nav-link">
                            <i class="fas fa-shopping-cart"></i> Giỏ hàng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="http://127.0.0.1:5500/Login.html" class="nav-link">Đăng nhập</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

    <form action="XuLiSignup.php" method = "POST">
    <section class = "form_signup">
        <h1>Đăng kí</h1>
        <div>
            <ul>
                <li>
                    <label><i class="fa fa-user">Tên người dùng</i></label>
                </li>
                <li>    
                    <input type="text" name="tennd" required placeholder="Nhập tên người dùng">
                </li>
                <li>
                    <label><i class="fa fa-user">Tên đăng nhập</i></label>
                </li>
                <li>    
                    <input type="text" name="user" required placeholder="Nhập tên đăng nhập">
                </li>
                <li>
                    <label><i class="fa fa-phone">Email hoặc Số điện thoại</i></label>
                </li>
                <li>    
                    <input type="text" name="email" required placeholder="Nhập Email">
                </li>
                <li>
                    <label><i class="fa fa-key">Mật khẩu</i></label>
                </li>
                <li>    
                    <input type="password" name="password" required placeholder="Nhập mật khẩu">
                </li>
                <li>
                    <label><i class="fa fa-key">Nhập lại mật khẩu</i></label>
                </li>
                <li>    
                    <input type="password" name="confirm_password" required placeholder="Nhập lại mật khẩu">
                </li>
                <li>
                    <input type="submit" value="Đăng kí">
                </li>
            </ul>
        </div>
    </section>
</form>
    <div class="space">
       
    </div>
    <section class="form-cuoi">
        <div class="container bg-dark">
            <div class="form-1">
                <li><b>Chăm sóc khách hàng</b></li>
                <li><a href="">Trung tâm trợ giúp</a></li>
                <li><a href="">Hướng dẫn mua hàng</a></li>
                <li><a href="">THướng dẫn bán hàng</a></li>
                <li><a href="">Thanh toán</a></li>
                <li><a href="">Vận chuyển</a></li>
                <li><a href="">Chính sách bảo hành</a></li>
                
              
            </div>
            <div class="form-1">
                <li><b>Về PTShop</b></li>
                <li><a href="">Giới thiệu về PTShop</a></li>
                <li><a href="">Điều khoản PTShop</a></li>
                <li><a href="">Chính sách bảo mật</a></li>
                <li><a href="">Chính hãng</a></li>
            </div>
            <div class="form-1">
                <li><b>Theo dõi chúng tôi trên</b></li>
                <li><a href="">Facebook</a></li>
                <li><a href="">Instagram</a></li>
                <li><a href="">Tiktok</a></li>
            </div>
        </div>
    </section>
    <script src="scrip.js"></script>
</body>
</html>   