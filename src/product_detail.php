<?php
include 'config.php'; //Kết nối Database

// Lấy ID sản phẩm từ URL
$id = $_GET['id'];
//Viết câu lệnh truy vấn
$sql = "SELECT * FROM products WHERE id = $id";
//CHọn câu lệnh truy vấn đó thông qua kết nối $conn
$result = mysqli_query($conn, $sql);
// Chuyển kết quả lấy được thành một mảng dữ liệu(biến $product)
$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $product['NAME']; ?></title>
        <!--Nhúng thư viện Bootstrap để giao diện đẹp hơn -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    </head>
    <body class="bg-light">
        <div class="container mt-5">
            <!--Tạo một cái khung trắng chứa thông tin sản phẩm -->
            <div class="row bg-white p-4 shadow-sm rounded">

            <!--Cột bên trái hiển thị hình ảnh sản phẩm-->
                <div class="col-md-6 text-center">
                    <!-- echo $preduct['image'] sẽ in ra tên file ảnh -->
                    <img src="images/<?php echo $product['image']; ?>" class="img-fluid rounded" style="max-height: 400px;">

                </div>
                <!-- Cột bên phải hiển thị thông tin chữ-->
                <div class="col-md-6">
                    <!--In tên sản phẩm-->
                    <h1 class="display-5"><?php echo $product['name']; ?></h1>
                    <!--In giá tiền và định dạng dấu chấm phân cách hàng nghìn cho dễ nhìn -->
                    <h3 class="text-danger"><?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ </h3>
                    <!--In mô tả sản phảm-->
                    <p class="mt-4 text-muted"><strong>Mô tả:</strong><?php echo $product['description'];  ?></p>
                    <!-- In số lượng còn trong kho-->
                    <p><strong>Số lượng còn:</strong> <?php echo $product['stock_quantity']; ?></p>
                    <button class="btn btn-primary btn-lg px-5">Thêm vào giỏ hàng</button>

                </div>

            </div>
            <!--Nút bấm để người dùng quay lại danh sách tất cả sản phẩm-->
            <a href="index.php" class="btn btn-outline-secondary mt-3">Quay lại trang chủ</a>

        </div>

    </body>
</html>