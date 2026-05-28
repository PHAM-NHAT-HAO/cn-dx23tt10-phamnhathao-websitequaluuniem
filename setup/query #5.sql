USE web_qua_luu_niem;
-- Xóa toàn bộ dữ liệu trong bảng order 
DELETE FROM orders;
 ALTER TABLE orders AUTO_INCREMENT = 1;
  ALTER TABLE orders_details  AUTO_INCREMENT = 1;
 