USE web_qua_luu_niem;

-- 1. Xóa hết dữ liệu đang có trong 2 bảng để làm sạch
DELETE FROM products;
DELETE FROM categories;

-- 2. Đặt lại bộ đếm ID tự động tăng về số 1 ban đầu
ALTER TABLE products AUTO_INCREMENT = 1;
ALTER TABLE categories AUTO_INCREMENT = 1;


INSERT INTO categories (id, name) VALUES 
(1, 'Gấu bông'),
(2, 'Móc khóa'),
(3, 'Đồ lưu niệm gốm sứ'),
(4, 'Thiệp & Văn phòng phẩm');

INSERT INTO products (name, price, image, description, stock_quantity, category_id) VALUES 
('Gấu Teddy ôm tim', 150000.00, 'teddy.jpg', 'Gấu bông mềm mịn, quà tặng sinh nhật ý nghĩa', 10, 1),
('Móc khóa mèo thần tài', 35000.00, 'mockhoa.jpg', 'Móc khóa may mắn mang lại tài lộc', 50, 2),
('Ly sứ vẽ tay', 85000.00, 'lysu.jpg', 'Ly sứ cao cấp vẽ hoa tiết thủ công', 15, 3),
('Thiệp chúc mừng', 5000.00, 'thiep.jpg', 'Thiệp chúc mừng', 100, 4);