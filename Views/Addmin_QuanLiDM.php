<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tài khoản - PTShop</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/54f0cb7e4a.js" crossorigin="anonymous"></script>
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

                    <!-- Giỏ hàng và đăng nhập -->
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
            <!-- Nội dung chính -->
            <main role="main" class="col-md-12  ml-sm-auto col-lg-12 pt-4 px-4">
                <h2 style="text-align: center;">Quản lý danh mục</h2>
                <form action="XuLiXoaTK.php" method="GET">
                    <section class="mt-4">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên danh mục</th>
                                        <th>Hình ảnh</th>
                                        <th>Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $conn = mysqli_connect("localhost", "root", "", "ptshop");
                                        if (!$conn) {
                                            die("Kết nối thất bại: " . mysqli_connect_error());
                                        }  
                            
                                        $sql = "SELECT * FROM danhmuc";                     
                                        $kq = mysqli_query($conn, $sql); 
                                        if (!$kq) {
                                            die("Lỗi truy vấn: " . mysqli_error($conn));
                                        }
                                        while ($dong = mysqli_fetch_array($kq)) {
                                    ?>
                                    <tr>
                                        <td><?php echo($dong['IDDM']); ?></td>
                                        <td><a href="Addmin_QuanLiSP.php?DanhMucID=<?= $dong['IDDM'] ?>"><?php echo ($dong['TenDanhMuc']); ?></a></td>
                                        <td><img src=<?php echo ($dong['HinhAnh']); ?> alt="" style="height: 5%; width: 5%";></td>
                                        <td><a href="XuLiXoaTK.php?idtk=<?php echo $dong['IDDM']; ?>">Xóa</a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </form>
            </main>
        </div>
    </div>

    <!-- Footer -->
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
                <li><a href="http://127.0.0.1:5500/GioiThieu.html">Giới thiệu về PTShop</a></li>
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
            document.querySelector('.overlay').classList.toggle('show');
        }
    </script>
</body>
</html>
