<?php
session_start();
// 1. Kiểm tra quyền Admin đăng nhập
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] != true) {
    header("Location: login.php");
    exit();
}

include 'config.php'; // Kết nối cơ sở dữ liệu của Hào

// 2. Lấy ID sản phẩm cần sửa từ URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    // Lấy thông tin hiện tại của sản phẩm đó ra để điền vào Form
    $result = mysqli_query($conn, "SELECT * FROM products WHERE id = $product_id");
    $product = mysqli_fetch_assoc($result);
    
    // Nếu không tìm thấy sản phẩm, đẩy về trang admin
    if (!$product) {
        header("Location: admin.php");
        exit();
    }
} else {
    header("Location: admin.php");
    exit();
}

// 3. Xử lý khi Admin nhấn nút "Cập nhật sản phẩm"
if (isset($_POST['update_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    
    // Mặc định giữ lại tên hình ảnh cũ nếu Admin không chọn ảnh mới
    $image = $product['image']; 
    
    // Nếu Admin có chọn tải lên hình ảnh mới
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    // Câu lệnh SQL cập nhật dữ liệu vào bảng products
    $sql = "UPDATE products SET name='$name', price='$price', description='$description', image='$image' WHERE id=$product_id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Cập nhật sản phẩm thành công!'); window.location.href='delete_product.php';</script>";
    } else {
        echo "Lỗi khi cập nhật: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Sản Phẩm ✏️</title>
    <style>
        /* Định dạng giao diện Form Sửa cho đẹp mắt, bo góc giống Form thêm của Hào */
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; padding: 20px; }
        .form-container { max-width: 500px; margin: 40px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input[type="text"], input[type="number"], textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        textarea { resize: vertical; min-height: 120px; }
        .btn-submit { background-color: #ffc107; color: black; border: none; padding: 12px; width: 100%; border-radius: 4px; font-weight: bold; font-size: 16px; cursor: pointer; margin-top: 10px; }
        .btn-submit:hover { background-color: #e0a800; }
        .btn-back { display: block; text-align: center; margin-top: 15px; text-decoration: none; color: #007bff; }
        .current-img { margin-top: 5px; display: block; max-width: 100px; border-radius: 4px; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Sửa Sản Phẩm ✏️</h2>
    
    <form action="" method="POST" enctype="multipart/form-data">
        
        <div class="form-group">
            <label>Tên sản phẩm:</label>
            <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
        </div>

        <div class="form-group">
            <label>Giá sản phẩm (VNĐ):</label>
            <input type="number" name="price" value="<?php echo $product['price']; ?>" required>
        </div>

        <div class="form-group">
            <label>Mô tả sản phẩm:</label>
            <textarea name="description" required><?php echo $product['description']; ?></textarea>
        </div>

        <div class="form-group">
            <label>Hình ảnh sản phẩm:</label>
            <input type="file" name="image">
            <small style="color: #666; display:block; margin-top:5px;">Ảnh hiện tại:</small>
            <img src="uploads/<?php echo $product['image']; ?>" class="current-img">
        </div>

        <button type="submit" name="update_product" class="btn-submit">Cập nhật sản phẩm</button>
        <a href="edit_product.php" class="btn-back">Quay lại trang danh sách</a>
    </form>
</div>

</body>
</html>