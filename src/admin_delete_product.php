<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] != true) {
    header("Location: login.php");
    exit();
}
include 'config.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    // Mặc định xóa xong sẽ quay về admin.php
    $redirect_page = 'admin.php'; 
    
    // Nếu bấm xóa từ trang thống kê, hệ thống sẽ nhận biết để quay về delete_product.php
    if (isset($_GET['from']) && $_GET['from'] == 'thongke') {
        $redirect_page = 'delete_product.php'; 
    }

    // TẮT kiểm tra khóa ngoại để tránh bị MySQL chặn xóa
    mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0;");

    // Câu lệnh thực hiện xóa sản phẩm
    $sql = "DELETE FROM products WHERE id = $product_id";

    if (mysqli_query($conn, $sql)) {
        // BẬT lại kiểm tra khóa ngoại sau khi đã xóa xong để bảo vệ database
        mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 1;");
        
        echo "<script>alert('Xóa sản phẩm thành công!'); window.location.href='$redirect_page';</script>";
    } else {
        // Nếu vẫn có lỗi, dòng này sẽ in thẳng lỗi MySQL lên màn hình cho bạn thấy
        echo "Lỗi hệ thống: " . mysqli_error($conn);
    }
} else {
    header("Location: admin.php");
    exit();
}
?>