<?php
session_start();
//Nhúng file kết nối database
include 'config.php';

//Kiểm tra bảo mật giỏ hàng
if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_SESSION['cart']) || empty($_SESSION['cart'])){
   header("Location: index.php");
   exit(); 
}
//hứng thông tin khách hàng nhập từ form
$customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
$customer_phone = mysqli_real_escape_string($conn, $_POST['customer_phone']);
$customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);
$customer_note = mysqli_real_escape_string($conn, $_POST['customer_note']);
//Thiết lập user_id mặc định là 1 (Quản trị viên/Khách vãng lai) nếu chưa làm chức năng đăng nhập
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;

// Tính tổng tiền đơn hàng để lưu vào cột 'total_amount'
$total_amount = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_amount += $item['price'] * $item['quantity'];
}
// chèn dữ liệu vào bảng order
$query_order = "INSERT INTO orders (customer_name, customer_phone, customer_address, customer_note, user_id, total_amount, status )
                VALUES ('$customer_name', '$customer_phone', '$customer_address','$customer_note', '$user_id', '$total_amount', 'pending' )";

// chèn dữ liệu vào bảng order

if (mysqli_query($conn, $query_order))
    {
        // Lấy ra mã ID vừa mới ính ra tự động ở lệnh insert
        $order_id = mysqli_insert_id($conn);
        // Chạy vòng lặp để lưu chi tiết từng món quà vào bảng
        // vì một đơn hàng có thể mua nhiều món quà,nên cần tách riêng ra lưu vào bảng
        foreach ($_SESSION['cart'] as $product_id => $item)
            {
                $quantity = $item['quantity']; // số lượng của món này
                $price = $item['price']; // Giá bán tại thời điểm mua của món quà này
        // Câu lệnh chèn vào bảng chi tiết đơn hàng, liên kết chéo thông qua cột order_id
        $query_detail = "INSERT INTO order_details (order_id, product_id, quantity, price)
                          VALUES ('$order_id', '$product_id', '$quantity', '$price')";
        // chạy lệnh lưu vào database
        mysqli_query($conn, $query_detail);
        // Cập nhật số lượng tồn kho
        $query_update_stock = "UPDATE products 
                               SET stock_quantity = stock_quantity - $quantity
                               WHERE id = $product_id";
        mysqli_query($conn, $query_update_stock);
            }
        // Dọn dẹp để hoàn tất đơn hàng
        //Sau khi dữ liệu đã lưu vào database an toàn, tiến hành xóa sạch giỏ hàng
        unset($_SESSION['cart']);
        // Xuất hiện hộp thoại Alert thông báo đặt hàng thành công bằng Javascript
        echo "<script>
        alert('Hệ thống ghi nhận đặt hàng thành công');
        window.location.href = 'index.php';
        </script>";
        exit();
    
    }else{
        // Nếu quá trình chèn bị lỗi, in ra câu thông báo lỗi
        echo "Lỗi hệ thống không thể xử lý đơn hàng" . mysqli_error($conn);
    }
?>