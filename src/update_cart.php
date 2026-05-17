<?php
session_start();

//Lấy ID sản phẩm và hành động từ URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
// kiểm tra xem trên đường dẫn URL có truyền hành động 'action' (như decrease, delete) hay không
$action = isset($_GET['action']) ? ($_GET['action']) : '';
//ID sản phẩm phải lớn hơn 0 và sản phẩm phải có trong giỏ hàng
if ($id > 0 && isset($_SESSION['cart'][$id]))
    {
        //TH1 nếu hành động dược nhận từ URL là 'decrease' (yêu cầu giảm số lượng)
        if($action === 'decrease'){
            //Tiến hành giảm số lượng của sản phẩm có ID này trong giỏ hàng đi 1 đơn
            $_SESSION['cart'][$id]['quantity'] -= 1;
            // Kiểm tra phụ: nếu sau khi giảm mà số lượng sản phẩm = 0 hoặc nhỏ hơn 0
            if ($_SESSION['cart'][$id]['quantity'] <= 0) 
            {
                //Dùng hàm unset để xóa bỏ hoàn toàn sản phẩm này ra khỏi mảng giỏ hàng session
                unset($_SESSION['cart'][$id]);
            }
        }
        //TH2 Nếu hành động nhận được từ URL là delet
        elseif ($action === 'delete')
        {
            // Không quan tâm số lượng bao nhiêu, dùng unset dọn sạch sản phẩm 
            unset($_SESSION['cart'][$id]);
        }
    }
    // Sau khi giảm hoặc xóa thì chuyển hướng người dùng vè trang giỏ hàng
    header("Location: cart.php");
    //Dừng hoàn toàn việc thực thi các đoạn code phía dưới
    exit();
?>