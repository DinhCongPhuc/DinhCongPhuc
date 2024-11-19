<?php
    session_start();    
    $conn = new mysqli('localhost', 'root', '', 'ptshop');

    // if ($conn->connect_error) {
    //     die('Kết nối thất bại: ' . $conn->connect_error);
    // }
    // $product_id = $_GET['IDSP'];

    // $sql = "SELECT * FROM sanpham WHERE IDSP = $product_id";
    // $result = $conn->query($sql);

    // if ($result->num_rows > 0) {
    //     $product = $result->fetch_assoc();
    // } else {
    //     echo "Sản phẩm không tồn tại!";
    //     exit;
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iphone</title>
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
                        <input type="text" class="form-control" style="width:400px;"  placeholder="Tìm kiếm sản phẩm">
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
<div class="container mt-3">
    <div class="boder p-3 bg-while">
        <div class="row">
            <?php 
             if ($conn->connect_error) {
                die('Kết nối thất bại: ' . $conn->connect_error);
            }
            $product_id = $_GET['IDSP'];
        
            $sql = "SELECT * FROM sanpham WHERE IDSP = $product_id";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                $product = $result->fetch_assoc();
                ?>
            <div class="col-md-4">
                <img src="<?php echo $product["HinhAnh"]; ?>" class="img-fluid" alt="Product Image">
            </div>

            <div class="col-md-8">
                <div class="d-flex mr-3">
                    <div class="border border-1 custom-border p-1">
                        <span style="color: white;">Yêu thích</span>
                    </div>
                    <h4 class="product-title" style="margin-left: 10px;">
                        <?php echo $product['TenSP']; ?>
                    </h4>
                </div>
                <div class="d-flex mr-10">
                    <p style="margin-left: 10px; margin-top: 5px; color: grey;">Hãng:</p>
                    <b><p style="margin-left: 10px; margin-top: 5px; color:  rgb(237, 82, 30); font-size: 20px;"><?php echo $product['ThuongHieu']; ?></p></b>
                </div>

                <!-- Giá sản phẩm -->
                <div class="boder p-3 bg-light">
                    <div class="d-flex mr-3">
                        <del style="color: grey;"><?php echo number_format($product['GiaGoc'], 0, ',', '.'); ?>đ</del>
                        <p name="price" class="product-price h3" style="color: rgb(213, 57, 5); margin-left: 10px;">
                            <?php echo number_format($product['GiaKM'], 0, ',', '.'); ?>đ
                        </p>
                    </div>
                </div>

                <!-- Form -->
                <form method="post" action="GioHang.php">
                    <input type="hidden" name="product_id" value="<?php echo $product['IDSP']; ?>">
                    <input type="hidden" name="price" value="<?php echo $product['GiaKM']; ?>"> <!-- Giá khuyến mãi -->

                    <div class="d-flex mr-3">
                        <p style="margin-left: 10px; margin-top: 3px; color: grey;">Số lượng</p>
                        <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 80px; height: 30px; margin-left: 60px; margin-top: 5px;">
                        <div class="p">
                            <p><?php echo $product['SL']; ?> sản phẩm có sẵn</p>
                        </div>
                    </div>

                    <!-- Nút thêm vào giỏ hàng -->
                    <div class="text-center">
                        <button type="submit" style="margin-top: 15px; width: 400px; height: 40px; border-radius: 10px; color: white; background-color: orange;" name="add_to_cart">Thêm vào giỏ hàng</button>
                    </div>
                    
                    <!-- Nút mua ngay -->
                    <div class="text-center">
                        <button type="submit" style="margin-top: 15px; width: 400px; height: 40px; border-radius: 10px; color: white; background-color: red;" name="buy_now">Mua</button>
                    </div>
                </form>

                <hr>
                <div class="d-flex mr-3">
                    <p>Đổi ý miễn phí 15 ngày</p>
                    <p style="margin-left: 50px">Hàng chính hãng 100%</p>
                    <p style="margin-left: 50px">Miễn phí vận chuyển</p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

        <div class="container mt-3">
            <!-- <div class="row"> -->
                <div class="boder p-3 bg-while">
                <h3>Chi tiết sản phẩm</h3>
                <!-- <div class="d-flex">
                    <p style="color: grey; margin-left: 20px;">Danh mục</p>
                    <p style="margin-left: 40px;"><a href="">PTShop</a></p>
                    <p style="margin-left: 3px;">></p>
                    <p  style="margin-left: 3px;"><a href="">Điện thoại & Phụ kiện</a></p>
                    <p style="margin-left: 3px;">></p>
                    <p  style="margin-left: 3px;"><a href="">Điện thoại</a></p>
                    <p style="margin-left: 3px;">></p>
                    <p  style="margin-left: 3px;"><a href="">Apple</a></p>
                </div> -->
                <?php
                    $product_id = $_GET['IDSP'];
                    $sql = "SELECT * FROM hinhanhsp WHERE IDSP = $product_id";
                    $kq = mysqli_query($conn, $sql);
                    if($dong = mysqli_fetch_array($kq)) {
                                ?>
                        <div class="d-flex justify-content-center align-items-center">
                            <img src=<?php echo $dong['Hinh1']; ?> style="width: 800px;" > 
                        </div>
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            <b><p style="font-size: 20px;"><?php echo $dong['MotaImg1']; ?></p></b>
                        </div>

                        <div class="d-flex justify-content-center align-items-center">
                            <img src=<?php echo $dong['Hinh2']; ?> style="width: 800px;"> 
                            </div>
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            <b><p style="font-size: 20px;"><?php echo $dong['MoTaImg2']; ?></p></b>
                        </div>

                        <div class="d-flex justify-content-center align-items-center">
                            <img src=<?php echo $dong['Hinh3']; ?> style="width: 800px;"> 
                            </div>
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            <b><p style="font-size: 20px;"><?php echo $dong['MoTaImg3']; ?></p></b>
                        </div>

                        <div class="d-flex justify-content-center align-items-center">
                            <img src=<?php echo $dong['Hinh4']; ?> style="width: 800px;"> 
                        </div>
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            <b><p style="font-size: 20px;"><?php echo $dong['MoTaImg4']; ?></p></b>
                        </div>
                       
                        <?php } ?>
                <!-- <div class="d-flex">
                    <p style="color: grey; margin-left: 20px;">Gửi từ</p>
                    <p  style="margin-left: 60px; color: grey;">TP Đà Nẵng</p>  
                </div> -->
                </div>
            <!-- </div>     -->
        </div>

        <div class="container mt-3">
            <div class="row">
                <div class="boder p-3 bg-while">
                <h3>Mô tả sản phẩm</h3>
                <?php 
                                        $sql = "SELECT * FROM motasp";   
                                        $result = $conn->query($sql);                  
                                        $kq = mysqli_query($conn, $sql); 
                                        if ($result->num_rows > 0) {
                                            $dong= $result->fetch_assoc();
                                    ?>
                <table class="table table-hover table-bordered">
                    <tbody>
                                    <tr>
                                        <th>Mô tả</th>
                                        <th style=" font-weight: normal;"><?php echo nl2br($dong['MoTa']); ?></th>
                                    </tr>
                                    <tr>    
                                        <th>Thiết kế</th>
                                        <th style=" font-weight: normal;"><?php echo nl2br($dong['ThietKe']); ?></th>
                                    </tr>
                                    <tr>    
                                        <th>Đặc điểm</th>
                                        <th style=" font-weight: normal;"><?php echo nl2br($dong['DacDiem']); ?></th>
                                    </tr>
                              
                                    </tbody>
                                    <!-- <tr>
                                        <td><?php echo($dong['ID']); ?></td>
                                        <td><a href="Addmin_QuanLiSP.php?DanhMucID=<?= $dong['ID'] ?>"><?php echo ($dong['TenDanhMuc']); ?></a></td>
                                        <td><img src=<?php echo ($dong['HinhAnh']); ?> alt="" style="height: 5%; width: 5%";></td>
                                        <td><a href="XuLiXoaTK.php?idtk=<?php echo $dong['ID']; ?>">Xóa</a></td>
                                    </tr> -->
                                   
                            </table>
                            <?php } ?>
                </div>    
            </div>
        </div>  

        <div class="container mt-3">
            <div class="row mt-5">
                <div class="col-12">
                    <h2>Đánh giá sản phẩm</h2>
                    <!-- <div class="d-flex mr-10" >
                        <h5 style="color: red;">5 trên 5</h5>
                        <div class="media mb-4" style="margin-top: 3px ; margin-left: 5px;">
                            <i class="fa fa-star" ></i> 
                            <i class="fa fa-star" ></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>  
                        <p style="margin-left: 15px;">Chất lượng sản phẩm tốt</p>
                    </div> -->
                            <?php
                            $product_id = $_GET['IDSP'];
                            $conn = mysqli_connect("localhost", "root", "", "ptshop");
                            $sql = "SELECT*FROM binhluan WHERE Product_ID = $product_id ORDER BY Ngay DESC";
                            $kq = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($kq) > 0) {
                                while ($dong = fetch_assoc($kq)) {
                                    ?>
                                      <div class="container mt-3">
            <div class="row mt-5">
                <div class="col-12">
                    <h2>Đánh giá sản phẩm</h2>
                    <div class="d-flex mr-10" >
                        <h5 style="color: red;">5 trên 5</h5>
                        <!-- <div class="media mb-4" style="margin-top: 3px ; margin-left: 5px;">
                            <i class="fa fa-star" ></i> 
                            <i class="fa fa-star" ></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>6
                        </div>   -->
                        <p style="margin-left: 15px;"><?php echo $dong['Ngay']; ?></p>
                    </div>
                                    <div class="media mb-4">
                        <img src=<?php echo $dong['HinhAnh']; ?> class="mr-3" alt="Customer Image">
                        <div class="media-body">
                            <h5 class="mt-0"><?php echo $dong['IDUser']; ?></h5>
                            <p><?php echo $dong['NDSP']; ?> </p>
                        </div>
                    </div>
                                    <?php
                                }
                            } else {
                                echo "Không có bình luận!";
                            }
                            ?>
                    </div>
                    <div class="media mb-4">
                        <div class="media-body">
                            <form method = "POST" action = "XuLiBL.php">
                            <textarea name="comment" placeholder="Thêm bình luận" style= "width: 1130px;"></textarea>
                            <br>
                            
                            <br>
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                            <input type="submit" value="Submit">
                            </form>    
                        </div>
                    </div>
                    <!-- <div class="media mb-4">
                        <img src="user.png" class="mr-3" alt="">
                        <div class="media-body">
                            <h5 class="mt-0">Nhật Hạ</h5>
                            <p>Máy khá gọn, thích hợp cho người thích gọn nhẹ dễ bỏ túi quần jean.
                                Máy nhỏ hơn Iphone XR, được cái cầm nắm chắc tay</p>
                        </div>
                    </div>
                    <div class="media mb-4">
                        <img src="user.png" class="mr-3" alt="">
                        <div class="media-body">
                            <h5 class="mt-0">Lê Nhật</h5>
                            <p>Mua giúp họ hàng, mã 8% khó săn quá, mình cầm trên tay thấy chẳng khác gì 14 pro :v</p>
                        </div>
                    </div>
                    <div class="media mb-4">
                        <img src="user.png" class="mr-3" alt="">
                        <div class="media-body">
                            <h5 class="mt-0">Văn Tài</h5>
                            <p>Giao hàng nhanh chóng đóng gói kĩ càng</p>
                        </div>
                    </div>
                    <div class="media mb-4">
                        <img src="user.png" class="mr-3" alt="">
                        <div class="media-body">
                            <h5 class="mt-0">Bảo Tài</h5>
                            <p>Sản phẩm đóng gói chắc chắn, thời gian giao nhanh, hàng chính hãng giá tốt </p>
                        </div>
                    </div> -->
                <!-- </div> -->
            </div>
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>   
</body>
</html>    