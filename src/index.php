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
    <style>
        /*css để trang trí giao diện */
        body {font_family: Arial, sans-serif; backgroud-color: #f4f4f4; panding: 20px;}
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
    </style>
</head>
<body>
    <h1 style="text-align:center;">Sản phẩm quà lưu niệm</h1>
    

  
<?php
// Kiểm tra xem trong Database có dòng dữ liệu nào không
if (mysqli_num_rows($result)>0)
    {
        // Dùng vòng lặp while để lấy từng dòng dữ liệu ra dưới dạng mảng $row
        while($row = mysqli_fetch_assoc($result)){
?>
            <div class='product-card'>
            <img src='images/<?php echo $row["image"];?>' alt='<?php echo $row["name"];?>' style='width:100%; height:150px; object-fit:cover;'>
            <h3><?php echo $row["name"]; ?></h3>
            <p style='color: #e74c3c; font-weight: bold;'>
                <?php echo number_format($row["price"],0,',','.'); ?> VNĐ
            </p>
            <p style='font-size: 0.9em; color: #666;'><?php echo $row["description"];?></p>
            <button style='backgroud: #3498db; color: white; border:none; padding:5px 10px; cursor:pointer; border-radius: 4px;'>
                Thêm vào giỏ hàng
            </button>
        </div>
        <?php
        }     
    }else{
        //Trường hợp Database trống
        echo "<p>Đang cập nhật sản phẩm...</p>";
    }
?>

    
</body>
</html>