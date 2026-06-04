# cn-dx23tt10-phamnhathao-websitequaluuniem

# Đồ án: Xây Dựng Website Mua Bán Quà Lưu Niệm
**Sinh viên thực hiện:** Phạm Nhật Hào
**Lớp:** DX23TT10
**Ngành:** Công nghệ thông tin

## 1. Giới thiệu dự án
Đây là đồ án môn học xây dựng website quản lý và bán các mặt hàng quà lưu niệm (gấu bông, móc khóa, đồ sứ...). Website hỗ trợ các chức năng mua hàng, quản lý sản phẩm và đơn hàng.

## 2. Công nghệ sử dụng
- **Ngôn ngữ:** PHP 
- **Cơ sở dữ liệu:** MySQL (chạy trên Laragon)
- **Công cụ quản lý:** HeidiSQL, GitHub Desktop
- **Giao diện:** HTML, CSS, Bootstrap 

## 3. Cấu trúc Cơ sở dữ liệu
Dự án bao gồm 4 bảng chính:
- `categories`: Lưu danh mục sản phẩm.
- `products`: Lưu thông tin chi tiết quà tặng.
- `users`: Quản lý tài khoản Admin và Khách hàng.
- `orders`: Lưu lịch sử đơn hàng.

## 4. Nhật ký tiến độ (Progress Report)
- **Tuần 1 (28/04/2026):** - Khởi tạo Repository và cấu trúc thư mục.
    - Thiết kế Database và chạy thành công các bảng trên HeidiSQL.
    - Cập nhật tài liệu hướng dẫn và mời giảng viên hướng dẫn.
- **Tuần 2 (06/05/2026):** - Xây dựng đề cương chi tiết cho đồ án.
    - Cấu trúc lại file báo cáo tiến độ để chuẩn bị cho giai đoạn lập trình.
- **Tuần 2 (10/05/2026):** 
    - Xây dựng trang quản trị đơn giản ('admin_add_product.php') để thêm sản phẩm mới vào Database
    - Kết nối thành công PHP với MySQL thông qua Laragon
    - Thiết kế giao diện hiển thị danh sách sản phẩm ('index.php') theo dạng lưới, tích hợp hình ảnh và định dạng giá tiền
    - Giải quyết lỗi hiển thị hình ảnh và lỗi cú pháp vòng lặp PHP
- **Tuần 3 (11/05/2026):**
    - Hoàn thành việc cập nhật nội dung Chương 1, 2, và 3 vào file báo cáo Word theo hướng dẫn của giảng viên.
    - Đã đẩy (Push) toàn bộ mã nguồn và file báo cáo lên GitHub.
- **Tuần 3 (12/05/2026):**
    - Hoàn tất đề cương báo cáo đồ án và nộp lên trang học tập.
- **Tuần 3 (13/05/2026):**
    - Hoàn thiện trang chi tiết sản phẩm và sửa lỗi hiển thị.
- **Tuần 3 (15/05/2026):**
    - Xây dựng chức năng Tìm kiếm (Search) thông minh.
    - Xử lý logic "Không tìm thấy kết quả".
    - Làm chủ giao diện Bootstrap. 
- **Tuần 3 (16/05/2026):**
    - Xây dựng luồng xử lý Giỏ hàng
    - Cập nhật và tạo file mới add_to_cart_php , cart.php.
    - Cập nhật nút "Thêm vào giỏ hàng" từ thẻ <button> sang thẻ <a> để truyền tham số id chính xác sang file xử lý.
- **Tuần 3 (16/05/2026):**
    - Hoàn thiện chức năng cập nhật giỏ hàng (update_cart.php).
      - xây dựng thành công logic giảm số lượng sản phẩm
      - Tự động kiểm tra và xóa bỏ sản phẩm khỏi giỏ hàng nếu số lượng giảm xuống bằng không
      - Gắn hộp thoại xác nhận JavaScript(confirm)trước khi xóa để tăng trải nghiệm người dùng.
    - Tối ưu hóa UI/UX trang chủ
      - Thay đổi nút "Thêm vào giỏ hàng" từ thẻ button tĩnh thành thẻ liên kết kết nối trực tiếp với file logic add_to_cart.php
      - Áp dụng thuộc tính Flexbox & Grid của Bootstrap 5.
- **Tuần 4 (24/05/2026):**
    - Hoàn thành xong Mục 3.2: Phân tích ca sử dụng (Use Case) trong Chương 3.

    - Thiết kế xong sơ đồ Ca sử dụng (Use Case Diagram) tổng thể cho chức năng quản lý giỏ hàng trên công cụ Draw.io theo đúng chuẩn ngôn ngữ mô hình hóa UML.

    - Xây dựng đầy đủ Bảng đặc tả chi tiết ca sử dụng (Use Case Specification), mô tả rõ ràng luồng sự kiện chính và luồng sự kiện thay thế (thêm, bớt, xóa bộ nhớ đệm) của hệ thống
- **Tuần 5 (25/05/2026):**
    - Tạo thanh điều hướng chuẩn Bootstrap 5.
    - Thay cụm tìm kiếm từ vị trí rời rạc phía trên đưa vào chính giữa thanh tiêu đề, giúp tối ưu không gian.
    - Thiết kế xong khối Badge trên icon Giỏ hàng ở thanh tiêu đề, tự động tính tổng số lượng sản phẩm và nhảy số lượng thực tế mỗi khi khách hàng bấm thêm hàng
    - Chèn nút 'Thanh toán ngay' (thẻ <a>) liên kết trực tiếp để dẫn luồng xử lý sang bước tiếp theo
- **Tuần 5 (27-28/05/2026):**
- **Phân hệ Khách hàng (Frontend)**
- `index.php`: Giao diện chính hiển thị danh sách sản phẩm động lấy từ cơ sở dữ liệu. Thiết kế thanh tìm kiếm tập trung, tích hợp cụm Dropdown phân loại danh mục và Badge hiển thị số lượng giỏ hàng thực tế.
- `contact.php`: Trang liên hệ áp dụng CSS Flexbox chia hai cột (Thông tin cửa hàng và Form gửi góp ý).
- `cart.php`: Trang quản lý danh sách các món quà đã chọn, hỗ trợ tính tổng tiền.
- `checkout.php`: Trang hiển thị form thu thập thông tin giao hàng (Họ tên, SĐT, Địa chỉ, Ghi chú) và lựa chọn phương thức thanh toán.
- `thanhtoan.html`: Giao diện tĩnh hỗ trợ định hình quy trình thanh toán.

- **Phân hệ Quản trị (Backend Admin)**
- `login.php`: Trang đăng nhập bảo mật dành cho Quản trị viên (Kiểm tra tài khoản hệ thống, khởi tạo và lưu trữ trạng thái với `$_SESSION['admin_logged_in']`).
- `admin.php`: Bảng điều khiển (Dashboard) trung tâm của Admin. Tự động thống kê các chỉ số kinh doanh cốt lõi bằng các câu lệnh SQL nâng cao (`SUM`, `COUNT`).
- `admin_add_product.php`: Giao diện form nạp sản phẩm mới vào hệ thống (Quản lý tên, giá, mô tả, ảnh, danh mục và hàng tồn kho).

- **File xử lý Logic & Dữ liệu ngầm**
- `config.php`: Khởi tạo kết nối kết nối giữa mã nguồn PHP và cơ sở dữ liệu MySQL.
- `process_checkout.php`: File xử lý hậu đài quan trọng nhất của luồng mua hàng. Nhận dữ liệu đơn, chèn thông tin vào bảng `orders`, giải nén giỏ hàng để ghi nhận vào `order_details`, và tự động trừ số lượng hàng tồn kho.
- `add_to_cart.php` & `update_cart.php`: Xử lý thêm mới và cập nhật số lượng sản phẩm trong giỏ hàng.
- **Tuần 5 (29/05/2026):**
- Thay đổi cấu trúc hiển thị trang chủ: Thay vì đổ toàn bộ sản phẩm ra một cách đại trà, hệ thống cần tự động nhóm các sản phẩm lại theo từng Danh mục cha (Ví dụ: Gấu bông, Thiệp & Văn phòng phẩm, Ly sứ...).
- Tạo cụm Banner đầu trang
- **Tuần 5 (30/05/2026):**
- Tích hợp thành công menu thả xuống (Dropdown) động trên thanh tiêu đề. Tự động truy vấn từ bảng categories để đổ ra các danh mục như Gấu bông, Set quà tặng, Móc khóa...
- Thiết kế giao diện theo phong cách tối giản (Minimalism) hiện đại, sử dụng hiệu ứng bóng đổ chuyển động mượt mà (Hover effect) giúp nâng cao trải nghiệm người dùng (UX).
- Nhúng bổ sung mệnh đề điều kiện AND name LIKE '%$search%' vào câu lệnh SQL duyệt sản phẩm theo danh mục.
- Tạo phần Footer giúp trang web cân đối, thể hiện sự chỉnh chu, đầy đủ thông tin của một website.
- **Tuần 6 (4/6/2026):**
- Phân tích & Thiết kế (Chương 3): Hoàn thiện Lược đồ lớp (Class Diagram), Sơ đồ Use Case, Sơ đồ tuần tự (Sequence Diagram) cho tính năng Tăng/Giảm giỏ hàng, và bản vẽ phác thảo giao diện thô (Wireframe).
- Hoàn thành chương 4 Kết quả thực nghiệm.
- Hoàn thành chương 5 Kết luận và hướng phát triển: viết xong phần kết luận, tự đánh giá bản thân và hướng phát triển đề tài.