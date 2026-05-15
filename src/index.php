<?php
include 'config.php';

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
 
    <div class="container mt-5">
    <h1 class="text-center mb-4 " style="color: #81260a">Sản phẩm quà lưu niệm</h1>
    <div class="row justify-content-center mb-5">
        <div class="col-md-6">
            <form action="index.php" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Tìm quà tặng (gấu bông, móc khóa...)" 
                value="<?php echo isset($_GET['search']) ? $_GET['search']:''; ?>">
                <button type="submit" class="btn btn-primary px-4">Tìm</button>
            </form>

        </div>

    </div>

  
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
            <div class="card h-100 shadow-sm border-0" style="border-radius: 15px; overflow: hidden;">
            <img src='images/<?php echo $row["image"];?>' class"card-img-top" alt='<?php echo $row["name"];?>' style=' height:200px; object-fit:cover;'>
    <div class="card-body d-flex flex-column bg-white text-center">
            <h3 class="card-title fw-bold text-dark mb-2"><?php echo $row["name"]; ?></h3>
            <p class="card-text text-danger fw-bold mb-3" style='color: #e74c3c; font-weight: bold;'>
                <?php echo number_format($row["price"],0,',','.'); ?> VNĐ
            </p>
            <p style='font-size: 0.9em; color: #120304;'><?php echo $row["description"];?></p>
            <div class="mt-auto">
            <button style='background: #e7111f; color: black; border:none ; padding:5px 10px; cursor:pointer; border-radius: 5px;'>
                Thêm vào giỏ hàng
            </button>
            <a href="product_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">
                Xem chi tiết</a>
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