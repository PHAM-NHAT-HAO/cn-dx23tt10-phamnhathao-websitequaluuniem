ALTER TABLE orders ADD COLUMN customer_name VARCHAR(255) AFTER id;
ALTER TABLE orders ADD COLUMN customer_phone VARCHAR(255) AFTER customer_name;
ALTER TABLE orders ADD COLUMN customer_address TEXT AFTER customer_phone;
ALTER TABLE orders ADD COLUMN customer_note TEXT AFTER customer_address;