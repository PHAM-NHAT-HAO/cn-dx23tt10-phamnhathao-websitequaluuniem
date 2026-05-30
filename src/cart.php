<?php
//Bật SESSION để đọc dữ liệu giỏ hàng
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
   
    <title>Giỏ hàng của bạn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4 fw-bold text-center text-primary">🛒 Giỏ Hàng Của Bạn</h2>
        <?php if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])): ?>
            <div class="text-center py-5 bg-white rounded shadow-sm">
                <h1 style="font-size: 80px;">🛍️</h1>
                <h3 class="text-muted">Giỏ hàng của bạn đang trống</h3>
                <a href="index.php" class="btn btn-primary mt-3">Quay lại trang chủ</a>

            </div>
        <?php else: ?>

            <div class="table-responsive bg-white p-4 rounded shadow-sm">
                <table class="table align-middle">
                    <thread>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá tiền</th>
                            <th>Số lượng</th>
                            <th>Tổng cộng</th>
                        </tr>
                    </thread>
                    <tbody>
                        <?php
                        $total_money = 0; //Biến tính tổng tiền cả giỏ hàng 
                        foreach ($_SESSION['cart'] as $id => $item):
                            $subtotal = $item['price']* $item['quantity']; // Tiền của từng món
                            $total_money += $subtotal; // Cộng dồn vào tổng cả giỏ
                        ?>
                        <tr>
                            <td><img src="images/<?php echo $item['image']; ?>" style="width: 80px; height: 80px; object-fit: cover;" class="rounded"></td>
                            <td class = "fw-bold"><?php echo $item['name']; ?></td>
                            <td class="text-danger"><?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                            <td>
                            <a href="update_cart.php?id=<?php echo $id; ?>&action=decrease" class="btn btn-outline-secondary me-2" >-</a>
                            <span><?php echo $item['quantity']; ?></span>
                            <a href="update_cart.php?id=<?php echo $id; ?>&action=increase" class="btn btn-outline-secondary me-2">+</a>

                        </td>
                            <td>
                                <a href="update_cart.php?id=<?php echo $id; ?>&action=delete" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng');" >
                                    <i class="bi bi-trash"></i>Xóa
                                </a>
                            </td>
                        
                        
                            <td class="text-danger fw-bold" ><?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="text-end mt-4">
                    <h4>Tổng tiền thanh toán: <span class="text-danger fw-bold"><?php echo number_format($total_money, 0, ',', '.'); ?> VNĐ</span></h4>
                    <a href="index.php" class="btn btn-outline-secondary me-2" >Tiếp tục mua sắm</a>
                    <a href="checkout.php" class="btn btn-success px-4">Thanh toán ngay</a>
                </div>

            </div>
            <?php endif; ?>
        

    </div>
    
</body>
</html>