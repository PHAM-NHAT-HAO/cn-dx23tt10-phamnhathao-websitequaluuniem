<?php
session_start();
if(isset($_GET['action']) && $_GET['action']=='logout')
    {
        unset($_SESSION['admin_logged_in']);
        session_destroy();
        header("Location: login.php");
        exit();
    }
// Nếu admin đã đăng nhập trước đó thì tự động chuển vào trang admin
if(isset($_SESSION['admin-logged_in']) && $_SESSION['admin_logged_in'] === true)
    {
        header("Location: admin.php");
        exit();
    }
    $error="";

    //Xử lý khi bấm nút đăng nhập
    if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Gán tài khoản cứng
            if($username === 'admin' && $password == '123456')
                {
                    //Tạo một dấu vé session đã đăng nhập thàngh công
                    $_SESSION['admin_logged_in'] = true;
                    
                    header("Location: admin.php");
                    exit();
                }else{
                    $error = "Tài khoản hoặc mật khẩu không chính xác!";
                }
        }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập Hệ Thống Quản Trị</title>
    <style>
        *{box-sizing: border-box; font-family: 'Segoe UI', sans-serif; margin: 0; padding: 0;}
        body{background-color: #f4f6f9; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-container {backgroud: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h2{text-align: center; margin-bottom: 25px; color: #2c3e50; font-size: 24px; }
        .form-group {margin-bottom: 20px; }
        .form-group label {display: block; margin-bottom: 8px; color: #7f8c8d; font-size: 24px; }
        .form-group input {width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 16px; outline: none;}
        .form-group input:forcus {border-color: #3498db; }
        .btn-login {width: 100%; padding:12px; background-color: #3498db; border: none; color: white; font-size: 16px; font-weight: bold; border-radius: 4px; cursor:pointer; transition: 0.3s; }
        .btn-login:hover {background-color: #2980b9; }
        .error-msg {background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 20px; text-align: center; font-size: 14px;}
    </style>
</head>
<body>
    <div class="login-container">
        <h2>ĐĂNG NHẬP ADMIN</h2>
        <?php if (!empty($error)): ?>
        <div class="error-msg">
            <?php echo $error; ?>

        </div>
        <?php endif ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label>Tên đăng nhập</label>
                <input type="text" name="username" placeholder="Nhập tài khoản..." required >


            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" placeholder="Nhập mật khẩu..." required >
            </div>
            <button type="submit" class="btn-login">ĐĂNG NHẬP</button>
        </form>

    </div>
</body>
</html>