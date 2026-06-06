<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !=true)
    {
        header("Location: login.php");
        exit();
    }
include 'config.php';

// Xử lý logic back-End để lấy dữ liệu thống kê
// Thống kê tổng doanh thu từ tất cả các đơn hàng trong bảng 'orders'
$query_revenue = "SELECT SUM(total_amount) AS total_revenue FROM orders";
$result_revenue = mysqli_query($conn, $query_revenue);
$row_revenue = mysqli_fetch_assoc($result_revenue);
$total_revenue = $row_revenue['total_revenue'] ? $row_revenue['total_revenue'] : 0;
 
//Thống kê số lượng đơn hàng hiện có
$query_orders_count = "SELECT COUNT(id) AS total_orders FROM orders";
$result_orders_count = mysqli_query($conn, $query_orders_count);
$row_orders_count = mysqli_fetch_assoc($result_orders_count);
$total_orders = $row_orders_count['total_orders'] ? $row_orders_count['total_orders'] : 0;

//Thống kê số lượng quà tặng hiẹn có trong kho (tổng cột stock_quantity)
$query_stock = "SELECT SUM(stock_quantity) AS total_stock FROM products";
$result_stock = mysqli_query($conn, $query_stock);
$row_stock = mysqli_fetch_assoc($result_stock);
$total_stock = $row_stock['total_stock'] ? $row_stock['total_stock'] : 0;

//Lấy danh sách sản phẩm và số lượng tồn kho để hiển thị lên bảng quản lý
$query_products = "SELECT p.*, c.name AS category_name
                   FROM products p
                   LEFT JOIN categories c ON p.category_id = c.id";
$result_products = mysqli_query($conn, $query_products);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản trị hệ thống - Shop Quà Lưu Niệm</title>
    <style>
* {box-sizing: border-box; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; }

body { background-color: #f4f6f9; color: #333; display: flex; }
/* giao diện thanh menu trái*/
.sidebar { width: 260px; height: 100vh; background-color: #2c3e50; color: #fff; padding:20px; position: fixed; }
.sidebar h2 {text-align: center; margin-bottom: 30px; font-size: 22px; color: #3498db;}
.sidebar ul {list-style: none; }
.sidebar ul li {padding: 15px 10px; border-bottom: 1px solid #34495e; cursor: pointer;}
.sidebar ul li.active {background-color: #3498db; border-radius: 4px; }
.sidebar ul li a {color: #fff; text-decoration: none; display: block; }

    /*Vùng nội dung chính bên phải */
.main-content {margin-left: 260px; padding: 40px; width: calc(100% - 260px); }
.header {margin-bottom: 30px; }
.header h1 {font-size: 28px; color: #2c3e50; }

/* bảng hiển thị thẻ số liệu thống kê */
.dashboard-cars {display: grid; grid-template-columns; repeat(3, 1fr); gap:20px; margin-bottom:40px; }
.cart {background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-left: 5px solid #3498db; }
.cart.stock {border-left-color: #e67e22; }
.cart h3 {font-size: 14px; text-transform: uppercase; color: #7f8c8d; margin-bottom: 10px; }
.cart p {font-size: 24px; font-wigth: bold; color: #2c3e50; }

/* Giao diện quản lý sản phẩm/ Kho hàng */
.table-section {background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
.table-section h2 {margin-bottom: 20px; font-size: 20px; color: #2c3e50; }
table {width: 100%; border-collapse: collapse; text-align: left; }
th, td {padding: 12px 15px; border-bottom: 1px solid #ddd; }
th {background-color: #f8f9fa; color: #2c3e50; font-weight: 600; }
tr:hover {background-color: #f1f2f6; }

/*Nhãn trạng thái kho hàng */
.badge {padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold; }
.badge.success {background-color: #d4edda; color: #155724; }
.badge.danger {background-color: #f8d7da; color: #721c24; }


    </style>
    <body>
         <div class="sidebar">
        <h2>QUẢN TRỊ VIÊN</h2>
        <ul>
            <li class="active"><a href="#">📊 Bảng Điều Khiển</a></li>
            <li><a href="index.php" target="_blank">🏠 Xem Trang Chủ Web </a></li>
            <li><a href="admin_add_product.php" target="_blank">➕ Thêm Sản Phẩm</a></li>
            <li><a href="edit_product.php" target="_self"> ✏️ Sửa sản phẩm</a></li>
            <li><a href="delete_product.php" target="_self">🗑️ Xóa sản phẩm</a></li>
            <li><a href="admin.php" target="_self">🏠 Admin</a></li>
            <li ><a href="login.php?action=logout" style="color: #e74c3c; font-weight: bold;">🚪 Đăng Xuất</a></li>
        </ul>

    </div>
        <div class="main-content">
<div class="table_section">
            <h2>📋 Thống Kê Chi Tiết Tồn Kho & Sản Phẩm</h2>
            <table>
                <thead>
                    <tr>
                    <th>Mã SP</th>
                    <th>Hình ảnh</th>
                    <th>Tên Quà Lưu Niệm</th>
                
                    <th>Danh Mục</th>
                    <th>Giá Bán</th>
                    <th>Số Lượng Kho</th>
                    <th>Trạng Thái</th>
                    <th>Xóa</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php while($product = mysqli_fetch_assoc($result_products)): ?>
                        <tr>
                            <td>#<?php echo $product['id']; ?></td>
                            <td><img src="images/<?php echo $product['image']; ?>" width="40" height="40" style="border-radius:4px; object-fit:cover;" onerror="this.src='https://placehold.co/40'"></td>
                            <strong><td><?php echo $product['name']; ?></td></strong>
                            <td><?php echo $product['category_name']; ?></td>
                            <td><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</td>
                            <strong><td><?php echo $product['stock_quantity']; ?>cái</td></strong>
                            <td>
                                <?php if($product['stock_quantity']>10): ?>
                                    <span class="badge success">Còn hàng dồi dào</span>
                                <?php else: ?>
                                    <span class="badge danger">Sắp hết hàng!</span>
                                <?php endif; ?>
                            </td>
                            <td>
    <a href="admin_delete_product.php?id=<?php echo $product['id']; ?>&from=thongke" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');" style="background-color: #dc3545; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-weight: bold;">Xóa 🗑️</a>
</td>
                        </tr>
                        <?php endwhile; ?>
                </tbody>
            </table>

        </div>
        </div>
    </body>
</html>