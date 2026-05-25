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
    <title>Danh sách sản phẩm</title>
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
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Trang chủ</a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> Sản phẩm</a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Liên hệ</a>

                </li>

            </ul>
            <form action="index.php" method="GET" class="d-flex mx-auto mb-2 mb-lg-0" style="width: 45%;">
                <input type="text" name="search" class="form-control me-2" placeholder="Tìm quà tặng (gấu bông, móc khóa...)" 
                value="<?php echo isset($_GET['search']) ? $_GET['search']:''; ?>">
                <button type="submit" class="btn btn-primary px-4">Tìm</button>
            </form>
            <!-- Khối giỏ hàng nằm gọn gàng trên thanh tiêu đề --> 
             <div class="text-end mb-4">
                <a href="cart.php" class="btn btn-outline-light position-relative">
                    <i class="bi bi-cart3 me-3"></i>Giỏ hàng
                    <!-- Nếu có sản phẩm trong giỏ thì hiện số lượng màu đỏ --> 
                     <?php if (isset($total_items)&& $total_items > 0): ?>
                        <span class ="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php echo $total_items; ?>
                        </span>
                        <?php endif; ?>
                </a>

             </div>

          </div>

    </div>
  </nav>
  
<?php
// Kiểm tra xem trong Database có dòng dữ liệu nào không
if (mysqli_num_rows($result)>0):?>

<?php if ($search != ""):?>
    <div class="col-12 mb-3">
        <a href="index.php" class="text-decoration-none text-primary"><i class="bi bi-house-door"></i> Quay về trang chủ</a>

    </div>
    <?php endif; ?>
    
    
        <div class="row">
        <!-- Dùng vòng lặp while để lấy từng dòng dữ liệu ra dưới dạng mảng $row-->
        <?php while($row = mysqli_fetch_assoc($result)):?> 


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
</div>
<?php else: ?>
<div class="col-12 text-center py-5">
  <h1 style="font-size: 100px;">🔍</h1>  <h2 class="text-muted">
    Không tìm thấy quà tặng nào tên là "<strong><?php echo $search; ?></strong>"
  </h2>
  <p class="text-secodary">Hãy tìm từ khóa khác nhé!</p>
  <a href="index.php" class="btn btn-primary btn-lg mt-3 shadow">Xem tất cả sản phẩm</a>
</div>
<?php endif; ?>


</div>


    
</body>
</html>