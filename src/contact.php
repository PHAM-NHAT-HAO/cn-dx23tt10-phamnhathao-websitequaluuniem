<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ - Shop Quà Lưu Niệm</title>
    <style>
    * {box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; }
    body { background-color: #f4f6f9; color: #333; }

    .contact-container{
        display: flex;
        flex-direction: row; /*ép các con nằm theo hàng ngang */
        gap: 40px;/*khoảng cách giữa hai khối */
        padding: 20px;
        max-width: 2000px;/*Giới hạn độ rộng tối đa của toàn bộ khu vực */
        margin: 40px auto;/*căn giữa toàn bộ trang */
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        align-items: stretch; /*cho hai khối cao bằng nhau */


    }
    .contact-info {
    flex: 1; 
    background: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    display: flex;
    justify-content: flex-start;
    align-items: flex-start;
    gap: 20px;
    flex-direction: column; 
 }
    .contact-form {
    flex: 1;
    background: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
    .contact-form h2 {color: #2c3e50; margin-bottom: 20px; font-size: 24px; display:flex; align-items: center; gap: 10px; }
    .contact-form input, .contact-form textarea{
        width: 100%;
        padding:12px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        background: #fff;
    }
    .contact-form input:focus, .contact-form textarea:focus{
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0,123,255,0.2);
    }
    .contact-form button{
        background: #86b9ec;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        font-size:15px;
        width: 100%;
        transition: background 0.2s;
    }
    .contact-form button:hover{ background: #007bff; }
    /* điện thoại sẽ xếp thành 1 cột*/
    @media (max-width: 768px){
    .contact-container{flex-direction: column; margin: 20px; padding: 20px; }
     .contact-info{
        flex-direction: column;
        
    }

    }
   /* CSS cho nút Quay lại trang chủ */
.btn-back-home {
    display: inline-block;
    padding: 10px 20px;
    background-color: #f1f2f6;
    color: #2c3e50;
    text-decoration: none;
    border-radius: 6px;
    font-weight: bold;
    font-size: 15px;
    border: 1px solid #ced4da;
    transition: background 0.2s;
}

.btn-back-home:hover {
    background-color: #f7f7f7;
    color: white;
    
}
    </style>
</head>
<body>
    <div class="contact-container">
    <div class="contact-info">
        <h2>🏠 THÔNG TIN SHOP</h2>
        <p><strong>📍 Địa chỉ:</strong> Khu vực Vũng Liêm, Vĩnh Long</p>
        <p><strong>📞 Điện thoại:</strong> 0909567890</p>
        <p><strong>📧 Email:</strong> hao1912999@gmail.com</p>
        <p><strong>⏰ Giờ mở cửa:</strong> 08:00 - 21:00 (Từ thứ hai - Thứ bảy hằng tuần)</p>
        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
        <p style="color: #2ecc71; font-weight: bold;" >🛵 Giao hàng miễn phí khu vực nội ô Vũng Liêm!</p>

    </div>
    <div class="contact-form">
        <h2>✉️ GỬI GÓP Ý</h2>
        <form action="#" method="POST" onsubmit="alert('Cảm ơn bạn đã liên hệ! Shop sẽ phản hồi sớm nhất qua email.'); text.value='';">
        <input type="text" placeholder="Họ và tên của bạn" required>
        <input type="email" placeholder="Địa chỉ Email" required>
        <textarea placeholder="Nhập nội dung lời nhắn hoặc câu hỏi của bạn" row="5" required></textarea>
         <a href="index.php" type="submit" style="display: block; text-align: center; background-color: #74b9ff; color:white; padding: 12px; border-radius: 6px; text-decoration: none; font-weight: bold;" >Gửi Tin Nhắn</a>


        </form>
        <div style="text-align: center; margin-top: 15px;">
          <a href="index.php" class="btn-back-home" style="display: block; text-align: center; background-color: #74b9ff; color:white; padding: 12px; border-radius: 6px; text-decoration: none; font-weight: bold;">
             Quay Lại Trang Chủ
        </a>
    
    </div>
    </div>
    </div>
   
</body>
</html>