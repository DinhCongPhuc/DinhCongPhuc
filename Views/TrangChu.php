<?php
        session_start();    
    $conn = mysqli_connect("localhost", "root", "", "ptshop");
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }                        
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <a href="" class="navbar-brand text-light"><b>PTShop</b></a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ml-auto align-items-center">

                    <li class="nav-item " >
                        <input type="text" class="form-control" style="width:400px;" placeholder="Tìm kiếm sản phẩm">
                    </li>
                    
          <li class="nav-item dropdown ">
                        <a href="#" class="nav-link dropdown-toggle" id="categoryDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Danh mục
                        </a>
                        <div class="dropdown-menu" style = "min-width: 300px; background-color: #f0ecebf5; border-radius: 5px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);" aria-labelledby="categoryDropdown">
                            <?php
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
                        <a href="GioHang.php">
                            <i class="fas fa-shopping-cart"></i> Giỏ hàng
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <?php 

                        // Kiểm tra xem người dùng đã đăng nhập chưa
                        if (isset($_SESSION['username'])) {
                            ?>
                                <a href="#" class="nav-link dropdown-toggle" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                                <?php echo "Xin chào, " . $_SESSION['username'] . "!"; ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" style = "min-width: 200px;" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="BaoMatTaiKhoan.php" style=" color:sblack;">Bảo mật tài khoản</a>
                                    <a class="dropdown-item" href="Logout.php">Đăng xuất</a>
                                </div>
                            <?php    
                        } else {
                            echo '<a href="Login.php" class="nav-link">Bạn chưa đăng nhập!</a>';
                        }
                        ?>
                    </li>


                </ul>
            </div>
        </div>
    </nav>
</div>




    <section class="slider">
            <div class="slider-concent">
                <div class="slider-concent-left">
                    <div class="slider-concent-left-top-container">
                    <div class="slider-concent-left-top">
                        <a href=""><img src="itexm_203c11d6b0.png" alt=""></a>
                        <a href=""><img src="0004990_app-43_1600.jpeg" alt=""></a>
                        <a href=""><img src="anh-1-4-16305542758871351880328.jpg" alt=""></a>
                        <a href=""><img src="c310-cover-blog-1080x540-tr-hcm-bigc-fix.jpg" alt=""></a>
                    </div>
                        <div class="slider-concent-left-top-btn">
                            <i class="fas fa-chevron-left"></i>
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                    <div class="slider-concent-left-botton">
                        <li class="active">Black Friday - Deal sốc bối rối </li>
                        <li>Black Friday - Giảm 66% cho toàn sản phẩm</li>
                        <li>Gia dụng ELMICh - Giảm tối đa 58%</li>
                        <li>Ưu đãi lớn - Rút thăm trúng thưởng</li>
                    </div>
                </div>
            </div>
    </section>




 
        <section class="slider-product-one" >
                <div class="slider-product-one-concent">
                    <div class="slider-product-one-concent-title">
                        <h2>Có thể bạn thích</h2>
                    </div>
                      
                    <div class="slider-product-one-concent-items">
                    <?php                     
                       $kq = mysqli_query($conn, "SELECT*FROM sanpham  "); 
                       if (!$kq) {
                           die("Lỗi truy vấn: " . mysqli_error($conn));
                           }  
                        while($dong = mysqli_fetch_array($kq)) {
                    ?>  
                        <div class="slider-product-one-concent-item">
                            <div class="slider-product-one-concent-item-text">
                                <li><a href="SPChiTiet.php?IDSP=<?php echo $dong['IDSP']; ?>"><img src=<?php echo $dong['HinhAnh']; ?> alt=""></a></li>
                                <li><?php echo $dong['TenSP']; ?> </li>
                                <b><li style = "color:  rgb(237, 82, 30); font-size: 20px;"><?php echo $dong['ThuongHieu']; ?></li></b>
                                <li style = "color: red; font-size: 25px"><b><?php echo number_format($dong['GiaKM'], 0, ',', '.'); ?><sup>đ</sup></b></li>
                                <li style="text-decoration: line-through; color: grey; "><?php echo number_format($dong['GiaGoc'], 0, ',', '.'); ?></a><sup>đ</sup></li>
                                   
                    </div>
                        </div>
                       <?php } ?>
            </div>
                </div>
    </section> 

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
    <script src="scrip.js"></script>
    <!-- jQuery, Popper.js, và Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>