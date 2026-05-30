<?php
// Kết nối database
include 'config.php';
//Lấy id danh mục từ URL, nếu khôngcos hoặc bấm bậy thì mặc định về trang chủ
$cat_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if($cat_id <=0)
    {
        header("Location: index.php");
        exit();
    }
// Truy vấn lấy thông tin tên danh mục
$query_cat= "SELECT * FROM categories WHERE id='$cat_id'";
$result_cat = mysqli_query($conn, $query_cat);
$cat = mysqli_fetch_assoc($result_cat);
if (!$cat)
    {
        header("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $cat['NAME']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body{
            font-family: 'Quicksand', sans-serif;
            background-color: #fcfbfc ;
            color: #2d2d2d;
        }
        .product-card{
            border: none;
            border-radius: 12px;
            backgroud: #ffffff;
            transition: all  0.3s ease;
        }
        .product-card:hover{
            transform: translateY(-6px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.05) !important;
        }
        .product-img{
            height:240px;
            object-fit: cover;
            border-radius: 12px 12px 0 0;
        }
        .btn-modern{
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="mb-4">
            <a href="index.php" class="text-decoration-none text-muted small" >
                <i class="bi bi-chevron-left"></i>Quay lại trang chủ
            </a>
        </div>

        <div class="row mb-5">
            <div class="col-12">
                <span class="text-muted text-uppercase tracking-wider small d-block mb-1 fw-bold display-5 text-dark m-0">Danh mục sản phẩm</span>
                <h1 class="fw-bold display-5 text-dark m-0">
                    ✨ <?php echo $cat['NAME']; ?>
                <h1>

            </div>

        </div>

        <div class="row g-4">
            <?php
            // Lấy tất cả sản phẩm của riêng danh mục này
            $query_products = "SELECT * FROM products WHERE category_id= '$cat_id' ORDER BY id DESC";
            $result = mysqli_query($conn, $query_products);

            if (mysqli_num_rows($result)):
                while ($row = mysqli_fetch_assoc($result)):
            ?>
            <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 product-card d-flex flex-column shadow-sm rounded">
            <img src='images/<?php echo $row["image"];?>' class="card-img-top img-fluid rounded " alt='<?php echo $row["name"];?>' style=" max-height: 250px; object-fit: cover;">
    <div class="card-body d-flex flex-column bg-white text-center flex-grow-1">
            <h3 class="card-title fw-bold text-primary "><?php echo $row["name"]; ?></h3>
            <p class="card-text text-danger fw-bold" style='color: #e74c3c; font-weight: bold;'>
                <?php echo number_format($row["price"],0,',','.'); ?> VNĐ
            </p>
            <p style='font-size: 0.9em; color: #120304;'><?php echo $row["description"];?></p>
            <div class="text-center d-flex gap-2 mt-auto pt-3">
          <a href="add_to_cart.php?id=<?php echo $row['id'] ?>" class="btn btn-primary flex-fill d-flex align-items-center justify-content-center text-nowrap py-2 " style="height: 42px;">
            <i class="bi bi-cart-plus me-1"></i> Thêm vào giỏ hàng
          </a>
            <a href="product_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-primary flex-fill d-flex align-items-center justify-content-center text-nowrap py-2 " style="height: 42px; ">
                Chi tiết</a>
               </div>
</div>
         </div>

          </div>
<?php endwhile;
else:
?>
<div class="col-12 text-center py-5">
    <i class="bi bi-box-seam text-muted display-1 d-block mb-3"></i>
    <h4 class="text-muted fw-normal">Danh mục này hiện chưa có sản phẩm nào!</h4>
    <a href="index.php" class="btn btn-primary btn-modern mt-3 btn-sm">Quay về xem mục khác</a>

</div>
<?php endif; ?>
        </div>

    </div>
</body>
</html>
