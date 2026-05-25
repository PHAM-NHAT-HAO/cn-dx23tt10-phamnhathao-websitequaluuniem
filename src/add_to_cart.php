<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
//Bắt đầu 1 session
session_start();
// Nhúng file kết nối database để lấy thông tin sản phẩm
include 'config.php';
// Lấy id sản phẩm mà khách hàng muốn thêm

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id>0)
    {
        //Hỏi database xem có sản phẩm này không
        $sql="SELECT * FROM products WHERE id = $id" ;
        $result= mysqli_query($conn, $sql);
        $product = mysqli_fetch_assoc($result);

        //Nếu sản phẩm tồn tại
        if($product){
            // Nếu giỏ hàng chưa từng tồn tại, tạo mới 1 cái giỏ trống
            if(!isset($_SESSION['cart'])){
                $_SESSION['cart']=array();
            }
            $cart_id = strval($id);
            // Kiểm tra xem sản phẩm này đã có trong giỏ hàng chưa
            if(isset($_SESSION['cart'][$cart_id]))
                {
                    // Nếu có rồi thì tăng số lượng lên 1
                    $_SESSION['cart'][$cart_id]['quantity'] +=1;
                }else{
                    //Nếu chưa có, bỏ sản phẩm mới này vào giỏ hàng với số lượng là 1
                    $_SESSION['cart'][$cart_id]=array(
                        "name"=> $product['name'],
                        "price" => $product['price'],
                        "image" => $product['image'],
                        "quantity" => 1

                    );
                }
        }
    }
// Sau khi thêm xong, lập tức chuyển hướng khách quay lại trang giỏ hàng để xem
header("Location: index.php");
?>