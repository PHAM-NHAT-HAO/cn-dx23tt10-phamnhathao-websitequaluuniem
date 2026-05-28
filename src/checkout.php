<?php 
session_start();
// Nếu giỏ hàng trống mà cố tình vào trang này thì đá về trang chủ
if(!isset($_SESSION['cart']) || empty($_SESSION['cart']))
    {
        header("Location: index.php");
        //Dừng toàn bộ tiến trình chạy code phía dưới
        exit();
    }
    //Khởi tạo một biến để cộng dồn số tiền của toàn bộ đơn hàng
    $total_price = 0;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiến hành thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light"><nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            <i class="bi bi-gift-fill text-warning me-2"></i>
            Shop Quà Lưu Niệm

        </a>
        <a href="cart.php" class="btn btn-outline-light btn-sm">
            <i class="bi bi-arrow-left"></i>
            Quay lại giỏ hàng
        </a>

    </div>

</nav>
<div class="container mb-5">
    <h2 class="fw-bold text-center mb-4" style="color: #81260a;">Thông Tin Đặt Hàng</h2>

    <form action="process_checkout.php" method="POST">
        <div class="row g-4"> <div class="col-lg-7">
            <div class="card shadow-sm border-0 p-4">
                <h4 class="mb-3 text-secondary"><i class="bi bi-person-lines-fill me-2"></i>Thông tin giao hàng</h4>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Họ và tên người nhận</label>
                    <input type="text" name="customer_name" class="form-control" placeholder="Ví dụ: Nguyễn Văn A" required>

                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Số điện thoại</label>
                    <input type="text" name="customer_phone" class="form-control" placeholder="ví dụ: 0987890890" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Địa chỉ nhận hàng</label>
                    <textarea name="customer_address" class="form-control" row="3" placeholder="Số nhà,tên đường, phường/xã, quận/huyện, tỉnh/thành phố" required></textarea>
                </div>
                 <div class="mb-3">
                    <label class="form-label fw-semibold">Ghi chú(nếu có)</label>
                    <textarea name="customer_note" class="form-control" row="2" placeholder="Giao giờ hành chính,..."></textarea>
                </div>
                <hr class="my-4">
                <h4 class="mb-3 text-secondary"><i class="bi bi-credit-card-2-back-fill me-2"></i>Phương thức thanh toán</h4>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="payment_method" id="bank" value="BANK">
                    <label class="form-check-label" for="bank">
                        Chuyển khoản ngân hàng (Qua mã QR)
                    </label>
                    
                   
                </div>
                 <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="payment_method" id="bank" value="BANK">
                    <label class="form-check-label" for="bank">
                        Thanh toán khi nhận hàng.
                    </label>
                    
                   
                </div>


            </div>

        </div>
        <div class="col-lg-5">
            <div class="card shdow-sm border-0 p-4 bg-white">
                <h4 class="mb-3 text-secondary d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-bag-check-fill me-2"></i>Đơn hàng của bạn</span>
                    <span class="badge bg-primary rounded-pill"><?php echo count($_SESSION['cart']);?></span>
                </h4>
                <ul class="list-group list-group-flush mb-3">
                    <?php
                    // Chạy vòng lặp foreach duyệt qua từng món hàng đang lưu trong Session
                    foreach ($_SESSION['cart'] as $item):
                        // Tính thành tiền của món hàng này = Giá bán x Số lượng
                        $subtotal = $item['price'] * $item['quantity'];
                        // Cộng dồn thành tiền này vào tổng hóa đơn chung
                        $total_price += $subtotal;
                    ?>
                    <li class="list-group-item d-flex justify-content-between lh-sm px-0 py-3">
                        <div>
                            <h6 class="my-0 fw-semibold"><?php echo $item['name']; ?></h6>
                            <small class="text-muted">Số lượng: <?php echo $item['quantity']; ?> x <?php echo number_format($item['price'], 0, ',', '.'); ?>đ</small>
                        </div>
                        <span class="text-muted fw-semibold"><?php echo number_format($subtotal, 0, ',', '.'); ?>đ</span>
                    </li>
                     <!-- Kết thúc vòng lập foreach -->
                    <?php endforeach; ?>
                    <li class="list-group-item d-flex justify-content-between px-0 py-3">
                        <span class="fw-bold fs-5 text-dark">Tổng tiền thanh toán:</span>
                        <strong class="fs-5 text-danger"><?php echo number_format($total_price, 0, ',', '.'); ?>đ</strong>

                    </li>

                </ul>
                <button type="submit" class="btn btn-danger btn-lg w-100 fw-bold py-3 mt-2 shadow">
                    <i class="bi bi-check-circle-fill me-2"></i> XÁC NHẬN ĐẶT HÀNG
                </button>

            </div>


        </div>

        </div>

    </form>

</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
