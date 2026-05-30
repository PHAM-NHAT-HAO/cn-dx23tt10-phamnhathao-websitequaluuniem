<?php
include 'config.php';
session_start();
// Tạo một cái thùng rỗng tên là $search  để chứa từ khóa người dùng gõ
$search = "";
// Kiểm tra xem người dùng có nhấn nút "Tìm" chưa?
// Nếu trong địa chỉ web có chữ ?search=...thì tức là họ đang tìm kiếm
if(isset($_GET['search']))
    {
        // Lấy cái chữ họ gõ, bỏ vào thùng $search
        $search=$_GET['search'];
    }
// Bắt đầu viết câu lệnh hỏi Database lấy dữ liệu
if($search !=""){
    // Nếu mà thùng $search có chữ (người dùng dang tìm gì đó)
    // Lấy sản phẩm có tên giống với từ khóa (Dấu % giúp tìm kiếm tương đối)
    $sql = "SELECT * FROM products WHERE name LIKE '%$search%'";
    

}else{
    //Nếu thùng $search rỗng
    //Lấy tất cả các sản phẩm ra hiển thị như bình thường
    $sql ="SELECT * FROM products";
}
//Ra lệnh cho máy tính chạy câu lệnh SQL trên và cất kết quả vào biến $result
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Quà Lưu Niệm Nhật Hào | Ho Chi Minh City</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /*css để trang trí giao diện */
        body {font_family: Arial, sans-serif; background-color: #75d1f2; panding: 20px;}
        /*Container dùng Flexbox để các ô sản phẩm tự động dàn hàng ngang */
        .product-container{display:flex; flex-wrap:wrap; gap:20px; justify-content: center;}
        /*Định dạng từng ô vuông sản phẩm */
        .product-card {background:white;
         border-radius: 8px ;
         box-shadow: 0 2px 5px rgba(0,0,0,0.1);
         padding:15px;
         margin: 10px;
         width: 220px;
         text-align: center;
         transition: transform 0.3s; /* Tạo hiệu ứng mượt khi di chuột vào*/
         display: inline-block;}
         /*Hiệu ứng nhấc ô sản phẩm lên khi di chuột vào*/
         .product-card:hover{transform: translateY(-5px);}
         .card { transition: transform 0.3s;}
         .card:hover {transform: translateY(-10px);}

         /* Style cho thanh menu chính */
         .main-menu{
            list-style: none;
            display: flex;
            background-color: #323233;
            padding: 10px 20px;
            align-items: center;
         }
         .main-menu > li {
            position: relative;

         }
         .main-menu > li > a {
            display: block;
            color: white;
            padding: 15px 20px;
            text-decoration: none;
            font-weight: bold;
         }

        /* Đoạn xử lý ẩn/hiện khi rê chuột */
        
        /* mặc định ẩn menu con đi */
    .dropdown-menu{
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #f8dede;
        min-width: 180px;
        box-shadow: 0px 8px 16px rgba(0,0,0,0.15);
        list-style: none;
        padding: 10px 0;
        border-radius: 4px;
        z-index: 999; /* Đảm bảo menu con đè lên trên các hình ảnh sản phẩm phía dưới */
        display: none; /*Ẩn đi */
    }
    .dropdown-menu li a {
        color: #333333;
        padding: 10px 20px;
        text-decoration: none;
        display: block;
        font-size: 14px;
        text-align: left;
        transition: background 0.2s;
    }
    /* hiệu ứng khi rê chuột vào từng mục con */
    .dropdown-menu li a:hover{
        background-color: #535455
        color: #007bff;
    }
    /*khi rê chuọt vào thẻ li có lớp .dropdown -> hiện menu con lên */
    .dropdown:hover .dropdown-menu{
        display: block;
    }
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&display=swap');
    .banner-block:hover{
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(255, 107, 129, 0.15);
    }
    .banner-block img{
        transition: transform 0.6 ease;
    }
    .banner-block:hover img{
        transform: scale(1.04); /*Phóng to ảnh nhẹ nhàng khi hover */
    }
    </style>
</head>
<body class="bg-light text-dark">
 
   
<?php
  // Tính tổng số lượng sản phẩm đang có trong giỏ hàng để hiển thị lên icon
  $total_items =0;
  if(isset($_SESSION['cart'])){
    foreach ($_SESSION['cart'] as $item){
        $total_items += $item['quantity'];
    }
  }
  ?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
    <div class="container">
        <!-- logo hoặc tên cửa hàng bên trái -->
         <a class="navbar-brand fw-bold" href="index.php">
            <i class="bi bi-gift-fill text-warning me-2"></i>
            Shop Quà Lưu Niệm
         </a>
        <!-- Nút bấm thu gọn khi xem trên điện thoại -->
         <button class="navbar-expand-lg navbar-toggler" type="button" data-bs-toggler="collapse" data-bs-target="#navbarNav" >
            <span class="navbar-toggler-icon"></span>
         </button>
         <!-- Các danh mục di chuyển và nút giỏ hàng bên phải -->
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="main-menu me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Trang chủ</a>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-bold text-dark" href="category_detail.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Sản phẩm</a>
                    <ul class="dropdown-menu shadow" aria-labelledby="navbarDropdown">
                        
                        <li><hr class="dropdown-divider"></li>

                        <?php 
                        //Tự động lấy các dnah mục hiẹn có từ Database đổ vào menu
                        $query_menu_cats ="SELECT * FROM categories";
                        $result_menu_cats = mysqli_query($conn, $query_menu_cats);
                        while ($menu_cat = mysqli_fetch_assoc($result_menu_cats)):
                        ?>
                        <li>
                            <a class="dropdown-item" href="category_detail.php?id=<?php echo $menu_cat['id']; ?>">
                                🎯 <?php echo $menu_cat['NAME']; ?>
                            </a>
                        </li>
                        <?php endwhile; ?>

                       <li><a class="dropdown-item fw-bold text-primary" href="category_detail.php">Xem tất cả sản phẩm</a></li> 

                    </ul>


                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Liên hệ</a>

                </li>

            </ul>
            <form action="index.php" method="GET" class="d-flex mx-auto mb-2 mb-lg-0" style="width: 45%;">
                <input type="text" name="search" class="form-control me-2" placeholder="Tìm quà tặng (gấu bông, móc khóa...)" 
                value="<?php echo isset($_GET['search']) ? $_GET['search']:''; ?>">
                <button type="submit" class="btn btn-primary px-4">Tìm</button>
            </form>
            <!-- Khối giỏ hàng nằm gọn gàng trên thanh tiêu đề --> 
             <li class="nav-item ms-lg-3">
                <a href="cart.php" class="btn btn-outline-light position-relative px-3 py-2">
                    <i class="bi bi-cart3 me-3"></i>Giỏ hàng
                    <!-- Nếu có sản phẩm trong giỏ thì hiện số lượng màu đỏ --> 
                     <?php if (isset($total_items)&& $total_items > 0): ?>
                        <span class ="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php echo $total_items; ?>
                        </span>
                        <?php endif; ?>
                </a>

             </li>

          </div>

    </div>
  </nav>
  <div class="container my-4">
    <div class="row g-3">
        <div class=" col-lg-8">
            
            <div class="banner-block position-relative overflow-hidden shadow-sm h-100">
                <img src="images/banner-main.jpg" class="w-300 h-100" style="object-fit: cover; min-height: 350px;" alt="Dive into Summer Banner" >

            </div>

        </div>

        <div class=" col-lg-4 d-flex flex-column gap-3">
            <div class="banner-block overflow-hidden shadow-sm flex-fill">
                <img src="images/banner-sub1.jpg" class="w-100 h-100" style="object-fit: cover; min-height: 165px;" alt="Banner Phụ 1" >

            </div>
            <div class="banner-block overflow-hidden shadow-sm flex-fill">
                <img src="images/banner-sub2.jpg" class="w-100 h-100" style="object-fit: cover; min-height: 165px;" alt="Banner Phụ 2" >

            </div>

        </div>

    </div>
                   
  
  <?php
  $query_categories = "SELECT * FROM categories";
  $result_cat = mysqli_query($conn, $query_categories);

 // Lấy ra danh mục trước
$query_categories = "SELECT * FROM categories";
$result_categories = mysqli_query($conn, $query_categories);

// 1. Kiểm tra xem có sản phẩm nào trong hệ thống nói chung không 
$tong_san_pham = 0;
    
    // 2. Chạy vòng lặp danh mục lớn
    while ($cat = mysqli_fetch_assoc($result_cat)):
        $cat_id = $cat['id'];
        $cat_name = $cat['NAME'];
        
        // Lấy sản phẩm của danh mục hiện tại
        $query = "SELECT * FROM products WHERE category_id = '$cat_id' AND name LIKE '%$search%' ORDER BY id DESC LIMIT 4";
        $result = mysqli_query($conn, $query);
  // Kiểm tra xem trong Database có dòng dữ liệu nào không
  $tong_san_pham += mysqli_num_rows($result);
if (mysqli_num_rows($result)>0):?>

<div class="row mt-5 mb-3 border-bottom pb-2 align-items-center">
                    <div class="col-8">
                        <h3 class="text-dark fw-bold border-bottom pb-2 m-0" style="font-family: 'Quicksand', sans-serif;">
                            🎯 <?php echo $cat_name; ?>
                        </h3>
                    </div>
                    <div class="col-4 text-end">
                        <a href="category_detail.php?id=<?php echo $cat_id; ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-bold">
                            Xem tất cả<i class="bi bi-chevron-right"></i>
                        </a>

                    </div>
                </div>

  
  




<?php if ($search != ""):?>
    <div class="col-12 mb-3">
        <a href="index.php" class="text-decoration-none text-primary"><i class="bi bi-house-door"></i> Quay về trang chủ</a>

    </div>
    <?php endif; ?>
    
    <div class="container mt-5">
        <div class="row g-3">

        <!-- Dùng vòng lặp while để lấy từng dòng dữ liệu ra dưới dạng mảng $row-->
        <?php 
       
        while($row = mysqli_fetch_assoc($result)):?> 


<div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 d-flex flex-column shadow-sm rounded">
            <img src='images/<?php echo $row["image"];?>' class="card-img-top img-fluid rounded " alt='<?php echo $row["name"];?>' style=" max-height: 250px; object-fit: cover;">
    <div class="card-body d-flex flex-column bg-white text-center flex-grow-1">
            <h3 class="card-title fw-bold text-primary "><?php echo $row["name"]; ?></h3>
            <p class="card-text text-danger fw-bold" style='color: #e74c3c; font-weight: bold;'>
                <?php echo number_format($row["price"],0,',','.'); ?> VNĐ
            </p>
            <p style='font-size: 0.9em; color: #120304;'><?php echo $row["description"];?></p>
            <div class="text-center d-flex gap-2 mt-auto pt-3">
          <a href="add_to_cart.php?id=<?php echo $row['id'] ?>" class="btn btn-primary flex-fill d-flex align-items-center justify-content-center text-nowrap py-2 " style="height: 42px;">
            <i class="bi bi-cart-plus me-1"></i> Thêm vào giỏ hàng
          </a>
            <a href="product_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-primary flex-fill d-flex align-items-center justify-content-center text-nowrap py-2 " style="height: 42px; ">
                Chi tiết</a>
               </div>
</div>
         </div>

          </div>

<?php endwhile; ?>
         
<?php endif; // 2. Đóng lệnh kiểm tra sản phẩm của danh mục hiện tại
endwhile;

// 3. Đóng vòng lặp danh mục lớn ($cat)
?>
</div>




<?php if ($tong_san_pham == 0): ?>
<div class="col-12 text-center py-5">
  <h1 style="font-size: 100px;">🔍</h1>  <h2 class="text-muted">
    Không tìm thấy quà tặng nào tên là "<strong><?php echo $search; ?></strong>"
  </h2>
  <p class="text-secodary">Hãy tìm từ khóa khác nhé!</p>
  <a href="index.php" class="btn btn-primary btn-lg mt-3 shadow">Xem tất cả sản phẩm</a>
</div>
<?php endif; ?>


</div>

<footer class="bg-dark text-white py-5 mt-5" style="font-family: 'Quicksand', sans-serif;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <h5 class = "fw-bold text-primary mb-3">✨ SHOP QUÀ LƯU NIỆM</h5>
                <p class="text-seconday small">Chuyên cung cấp các set quà tặng, gấu bông, ly sứ và phụ kiện lưu niệm độc đáo, mang trọn yêu thương đến người nhận.</p>

            </div>

            <div class="col-lg-4 col-md-6">
                <h5 class="fw-bold mb-3">🎯 Khám Phá</h5>
                <ul class="list-unstyled text-secondary small">
                    <li class="mb-2"><a href="index.php" class="text-decoration-none text-secondary">Trang chủ</a> </li>
                    <li class="mb-2"><a href="category_detail.php" class="text-decoration-none text-secondary">Sản Phẩm</a> </li>
                    <li class="mb-2"><a href="contact.php" class="text-decoration-none text-secondary">Liên Hệ</a></li>

                </ul>

            </div>
            <div class="col-lg-4 col-md-12">
                 <h5 class="fw-bold mb-3">📍 Thông Tin Liên Hệ</h5>
                 <p class="text-secondary small mb-2" ><i class="bi bi-geo-alt-fill me-2"></i>Khu vực Vũng Liêm, Vĩnh Long</p>
                 <p class="text-secondary small mb-2" ><i class="bi bi-telephone-fill me-2"></i>0904567890</p>
                 <p class="text-secondary small"><i class="bi bi-envelope-fill me-2"></i>support@shopquatang.com</p>

            </div>

        </div>
        <hr class="border-secondary my-4" >

        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="text-secondary small m-0" >&copy; 2026 Shop Quà Tặng. Tất cả quyền được bảo lưu.</p>
            </div>
            <div class="col-md-6 text-center text-md-end pt-2 pt-md-0">
                <a href="#" class="text-white me-3"><i class="bi bi-facebook" ></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-instagram" ></i></a>
                <a href="#" class="text-white"><i class="bi bi-tiktok" ></i></a>

            </div>

        </div>


    </div>

</footer>


    
</body>
</html>