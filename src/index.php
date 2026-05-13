<?php
include 'config.php';
// Câu lệnh lấy toàn bộ sản phẩm
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /*css để trang trí giao diện */
        body {font_family: Arial, sans-serif; backgroud-color: #862407; panding: 20px;}
        /*Container dùng Flexbox để các ô sản phẩm tự động dàn hàng ngang */
        .product-container{display:flex; flex-wrap:wrap; gap:20px; justify-content: center;}
        /*Định dạng từng ô vuông sản phẩm */
        .product-card {backgroud:white;
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
    

  
<?php
// Kiểm tra xem trong Database có dòng dữ liệu nào không
if (mysqli_num_rows($result)>0):?>
    
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
            <button style='backgroud: #e7111f; color: black; border:none ; padding:5px 10px; cursor:pointer; border-radius: 5px;'>
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
<?php endif; ?>
</div>


    
</body>
</html>