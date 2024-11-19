<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "ptshop");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}


// Lấy id người dùng từ session
$user_id = $_SESSION['user_id'];

// Kiểm tra xem IDUser có tồn tại trong bảng dangki không
$check_user = "SELECT * FROM dangki WHERE IDUser = '$user_id'";
$user_result = mysqli_query($conn, $check_user);
if (mysqli_num_rows($user_result) == 0) {
    echo "ID người dùng không tồn tại trong bảng dangki.";
    exit;
}

if (isset($_POST['add_to_cart'])) {
    // Kiểm tra sự tồn tại của các biến POST để tránh lỗi undefined
    if (isset($_POST['product_id']) && isset($_POST['quantity']) && isset($_POST['price'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];


        // Kiểm tra xem sản phẩm đã có trong giỏ hàng của người dùng chưa
        $sql = "SELECT * FROM giohang WHERE IDUser = '$user_id' AND IDSP = $product_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Sản phẩm đã có trong giỏ hàng -> Cập nhật số lượng
            $sql = "UPDATE giohang SET SL = SL + $quantity WHERE IDUser = '$user_id' AND IDSP = $product_id";
            mysqli_query($conn, $sql);
        } else {
            // Sản phẩm chưa có trong giỏ hàng -> Thêm sản phẩm mới vào giỏ hàng
            $sql = "INSERT INTO giohang (IDUser, IDSP, SL, Gia) VALUES ('$user_id', $product_id, $quantity, $price)";
            mysqli_query($conn, $sql);
        }

       
    } else {
        echo "Dữ liệu sản phẩm không đầy đủ.";
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
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
            <a href="TrangChu.php" class="navbar-brand text-light"><b>PTShop</b></a>
            
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
                            $conn = mysqli_connect("localhost", "root", "", "ptshop");
                             $kq = mysqli_query($conn, "SELECT * FROM danhmuc");
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
    </nav>
   
    <div class="container mt-3">
        <b><h3 style="text-align: center;">Giỏ hàng của bạn</h3></b>
    <?php      
        $sql = "SELECT giohang.IDSP, giohang.SL, sanpham.TenSP, giohang.Gia, sanpham.HinhAnh 
        FROM giohang 
        INNER JOIN sanpham ON giohang.IDSP = sanpham.IDSP 
        WHERE giohang.IDUser = '$user_id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['IDSP'];
                $product_image = $row['HinhAnh'];
                $product_name = $row['TenSP'];
                $product_price = $row['Gia'];
                $quantity = $row['SL'];
                $total_price = $product_price * $quantity;
                ?>
                <div class="border p-5 bg-white rounded mb-3">
                    <div class="row">

                        <div class="col-md-4">
                            <img src="<?php echo $product_image; ?>" style="width: 150px; height: 150px;" alt="Product Image">
                        </div>  

                        <div class="col-md-8">
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="product-title">
                                    <?php echo $product_name; ?>
                                </h4>
                            </div>

                            <div class="mb-2">
                                <p style="margin-left: 10px; color: grey;">Số lượng: <?php echo $quantity; ?></p>
                            </div>

                            <div class="border p-3 bg-light mb-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p>Thành tiền:</p>
                                    <p class="product-price h3" style="color: rgb(213, 57, 5);">
                                        <?php echo number_format($product_price, 0, ',', '.'); ?>đ
                                    </p>
                                   
                                </div>
                            </div>
                            
                            <div class="mb-2">
            <button id="btnCheckout" class="btn btn-primary" style="width: 170px; height: 40px; margin-left: 90px">
                Thanh Toán
            </button>
        </div>

        <!-- Modal Form Thanh Toán -->
        <div id="checkoutForm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="checkoutLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkoutLabel">Thanh Toán</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="luu_thong_tin.php">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="username">Tên khách hàng</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="product">Sản phẩm</label>
                                <textarea class="form-control" id="product" name="product" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="totalPrice">Tổng tiền</label>
                                <input type="number" class="form-control" id="totalPrice" name="total_price" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-success">Xác Nhận Thanh Toán</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
                                    
                                 <form action='XuLiHuyDonHang.php' method= 'POSt'> 
                                    <div class="mb-2">
                                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                        <button type="submit" class="btn btn-danger" style="width: 170px; height: 40px; margin-left: 370px">Hủy đơn hàng</button>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="border p-3 bg-light rounded mb-3">
                <h4>Tổng cộng: <span style="color: rgb(213, 57, 5);"><?php echo number_format($total_price, 0, ',', '.'); ?>đ</span></h4>
            </div>
            
        <?php
        } else {
            echo '<p>Giỏ hàng của bạn đang trống!</p>';
        }
    ?>
</div>

        <section class="slider-product-one" style="margin-top: 50px;" >
                <div class="slider-product-one-concent">
                    <div class="slider-product-one-concent-title">
                        <h2>Có thể bạn thích</h2>
                    </div>
                      
                    <div class="slider-product-one-concent-items">
                    <?php
                        $conn = mysqli_connect("localhost", "root", "", "ptshop");
                        if (!$conn) {
                            die("Kết nối thất bại: " . mysqli_connect_error());
                        }                        
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
                                        <li><?php echo $dong['Mota']; ?></li>
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('btnCheckout').addEventListener('click', function () {
            $('#checkoutForm').modal('show');
        });
    </script>  
</body>
</html>    