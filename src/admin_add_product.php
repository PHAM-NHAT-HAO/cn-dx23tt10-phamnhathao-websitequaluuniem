<?php
//Kết nối database thông qua file cấu hình đã tạo
include 'config.php';
//Kiểmtra xem người dùng có nhấn nút "add_produt" hay chưa
session_start();
if (isset($_POST['add_product'])){
    // Lấy dữ liệu từ các ô nhập liệu trong form à gán vào biến tương ứng
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_POST['image']; // Tạm thời nhập tên file ảnh
    $cat_id = $_POST['category_id']; //ID danh mục(Gấu bông, Móc khóa...)
// Câu lẹnh SQL để thêm một dòng dữ liệu mới vào bảng product
    
$sql = "INSERT INTO products (name, price, description, image, category_id) VALUES('$name','$price','$description','$image','$cat_id')";

// Thực thi  câu lệnh SQL
if (mysqli_query($conn,$sql)){
    // Nếu thành công hiện thôg báo và chuyển hướng về trang chủ index.php
    echo "<script>alert('Thêm sản phẩm thành công!'); window.location='admin_add_product.php';</script>";
}else {
    //Nếu thất bại hiển thị lỗi kỹ thuật của MySQL
    echo "Lỗi: " . mysqli_error($conn);

}
    
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm mới</title>
    <style>
        /* Css đơn giản đê căn giữa và tạo khoảng cách cho form*/ 
        form {width: 500px; margin: 20px auto; display: flex; flex-direction: column; gap: 10px;}
        input, select {padding: 8px;}
        
    </style>
</head>
<body style="background-color: #eaadad;">
<h2 style=" text-align: center;">Thêm sản phẩm mới</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Tên sản phẩm" required>
    <input type="number" name="price" placeholder="Giá tiền" required>
    <textarea name="description" style="width: 95.5%; min-height: 200px; padding: 10px;font-size: 16px; "placeholder="Mô tả sản phẩm"></textarea>
    <input type="text" name="image" placeholder="Tên file ảnh">
    <select name="category_id">
        <option value="1">Gấu bông</option>
        <option value="2">Móc khóa</option>
        <option value="3">Gốm sứ</option>
         <option value="3">Quà tặng</option>
          <option value="3">Thiệp & văn phòng phẩm</option>
    </select>
    <button href="admin_add_product.php" type="submit" name="add_product" style="background-color: #55ee09; color: black; border:none; border-radius: 5px; padding:10px 20px;">Lưu sản phẩm</button>
    <a href="admin.php" style="background-color: #55ee09; color: black; text-align:center;border-radius: 5px; padding:10px 20px;">Quay lại trang chủ</a>
</form>
</body>
</html>