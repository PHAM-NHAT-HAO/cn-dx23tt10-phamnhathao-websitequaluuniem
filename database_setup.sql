USE web_qua_luu_niem;
-- Bảng danh mục sản phẩm (gấu bông, Móc khóa, đồ gốm)
CREATE TABLE categories (
id INT AUTO_INCREMENT PRIMARY KEY, -- Cột ID tự động tăng, là khóa chính duy nhất
NAME VARCHAR(255) NOT NULL -- Tên danh mục không được để trống
);
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255),
    description TEXT,
    stock_quantity INT DEFAULT 0,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fullname VARCHAR(100),
    role ENUM('admin', 'customer') DEFAULT 'customer'
);

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total_amount DECIMAL(10, 2),
    status ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
/*
-- Bảng danh mục sản phẩm (gấu bông, Móc khóa, đồ gốm)
CREATE TABLE categories (
id INT AUTO_INCREMENT PRIMARY KEY, -- Cột ID tự động tăng, là khóa chính duy nhất
NAME VARCHAR(255) NOT NULL -- Tên danh mục không được để trống
);
-- 2. Bảng sản phẩm
CREATE TABLE products (
id INT AUTO_INCREMENT PRIMARY KEY,
NAME VARCHAR(255) NOT NULL, -- Tên món quà
price DECIMAL(10, 2) NOT NULL, -- Giá tiền (có 2 chữ thập phân)
image VARCHAR(255),
DESCRIPTION TEXT, -- mô tả đoạn văn dài chi tiết món quà
stock_quantity INT DEFAUT 0, -- số lượn tồn kho
category_id INT,
FOREIGN KEY (category_id ) REFERENCES categories  -- khóa ngoại
);

-- 3. người dùng
CREATE TABLE USERS (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50) NOT NULL UNIQUE, -- Tên đăng nhập phải là duy nhất, không trùng
PASSWORD VARCHAR(255) NOT NULL,
fullname VARCHAR(100), -- Họ tên thật
ROLE ENUM('admin', 'customer') DEFAULT 'customer' -- Vai trò (mặc định là khách)
);

-- 4. Bảng order (Đơn hàng)
CREATE TABLE ORDERS (
id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT, -- Ai là người đặt (lấy từ bảng users)
total_amount DECIMAL (10, 2), -- tổng số tiền của đơn hàng đó
STATUS ENUM ('pending','processing','shipped','delivered','cancelled') DEFAULT 'pending',
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Tự động lưu thời gian lúc đặt hàng
FOREIGN KEY (user_id) REFERENCES users(id)
);
*/
