/*-- 1. Chọn đúng database để làm việc
USE web_qua_luu_niem;

-- 2. Thêm danh mục quà tặng (Chạy dòng này trước)
INSERT INTO categories (NAME) VALUES 
('Gấu bông'), 
('Móc khóa'), 
('Đồ lưu niệm gốm sứ'), 
('Thiệp & Văn phòng phẩm');

-- 3. Thêm sản phẩm cụ thể (Quan trọng: Không dư dấu phẩy ở cuối)
INSERT INTO products (NAME, price, image, description, stock_quantity, category_id) VALUES 
('Gấu Teddy ôm tim', 150000.00, 'teddy.jpg', 'Gấu bông mềm mịn, quà tặng sinh nhật ý nghĩa', 10, 1),
('Móc khóa mèo thần tài', 35000.00, 'mockhoa.jpg', 'Móc khóa may mắn mang lại tài lộc', 50, 2),
('Ly sứ vẽ tay', 85000.00, 'lysu.jpg', 'Ly sứ cao cấp vẽ hoa tiết thủ công', 15, 3);

-- 4. Thêm tài khoản quản trị
INSERT INTO users (username, PASSWORD, fullname, ROLE) VALUES 
('admin', '123456', 'Quản trị viên', 'admin');*/