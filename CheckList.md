# 🗺️ LỘ TRÌNH LÀM DỰ ÁN FRESH FOOD — CHECKLIST

---

## 📦 GIAI ĐOẠN 1: NỀN MÓNG BACKEND

- [x] Migrations (CSDL) 3/10/2026
- [ ] Models + Relationships (khai báo `$table`, `belongsTo`, `hasMany`)
- [ ] Seeders (cửa hàng, người dùng, danh mục, sản phẩm, mã giảm giá)
- [ ] Cấu hình `.env` (DB, Redis, Mail, FCM)
- [ ] Cài đặt Sanctum → `php artisan install:api`
- [ ] Cấu hình `config/auth.php` trỏ về `NguoiDung`
- [ ] Override `getAuthPassword()` (vì cột là `mat_khau`)
- [ ] Tạo Middleware phân quyền (`role:admin`, `role:quan_ly`, ...)

---

## 🔐 GIAI ĐOẠN 2: AUTHENTICATION

- [ ] `AuthController`: register / login / logout / me
- [ ] API route `/api/v1/auth/*`
- [ ] Test login bằng Postman → lấy token
- [ ] Refresh token (nếu cần)
- [ ] Quên mật khẩu (gửi OTP SMS / email)

---

## 🎨 GIAI ĐOẠN 3: GIAO DIỆN WEB KHÁCH HÀNG

- [ ] Cài Laravel Breeze (Blade) hoặc setup Vue/React
- [ ] Cài Tailwind CSS
- [ ] Tạo layout chung (header, footer, navbar, cart icon)
- [ ] Trang chủ (banner + danh mục + sản phẩm nổi bật)
- [ ] Trang danh sách sản phẩm (filter danh mục, giá, tươi sống)
- [ ] Trang chi tiết sản phẩm (ảnh, giá, mô tả, nút thêm giỏ)
- [ ] Trang giỏ hàng
- [ ] Trang đặt hàng (chọn địa chỉ, voucher, phương thức TT)
- [ ] Trang lịch sử đơn hàng
- [ ] Trang profile + địa chỉ giao hàng
- [ ] Trang đăng nhập / đăng ký

---

## 🛒 GIAI ĐOẠN 4: API BÁN HÀNG

- [ ] `DanhMucController` (index, show)
- [ ] `SanPhamController` (index, show, search, filter)
- [ ] `GioHangController` (index, add, update, remove)
- [ ] `DiaChiGiaoHangController` (CRUD)
- [ ] `DonHangController` (index, store, show, cancel)
- [ ] `MaGiamGiaController` (check, apply)
- [ ] API Resource cho từng model (SanPhamResource, DonHangResource...)
- [ ] Upload ảnh sản phẩm (`storage:link` + store file)
- [ ] Test toàn bộ API bán hàng bằng Postman

---

## ⚙️ GIAI ĐOẠN 5: NGHIỆP VỤ KHO (FEFO)

- [ ] `StockService`: nhập kho, xuất kho, kiểm tra tồn
- [ ] `FefoService`: thuật toán xuất lô HSD gần nhất
- [ ] `PhieuNhapController` (CRUD + duyệt)
- [ ] `PhieuXuatController` (CRUD + duyệt)
- [ ] Logic sinh `lo_hang` khi duyệt phiếu nhập
- [ ] Logic cập nhật `ton_kho` khi nhập/xuất
- [ ] Logic giữ hàng (`so_luong_tam_giu`) khi đặt đơn
- [ ] Cron job cảnh báo lô sắp hết hạn
- [ ] API tra cứu tồn kho theo cửa hàng

---

## 🖥️ GIAI ĐOẠN 6: GIAO DIỆN WEB ADMIN

- [ ] Cài AdminLTE hoặc template admin
- [ ] Layout admin (sidebar, topbar, breadcrumb)
- [ ] Dashboard (thẻ thống kê + biểu đồ)
- [ ] Quản lý sản phẩm (list, create, edit, delete, upload ảnh)
- [ ] Quản lý danh mục (đa cấp)
- [ ] Quản lý cửa hàng
- [ ] Quản lý nhân viên + phân quyền
- [ ] Quản lý đơn hàng (xem, duyệt, hủy, in bill)
- [ ] Quản lý phiếu nhập / phiếu xuất
- [ ] Quản lý tồn kho + lô hàng
- [ ] Quản lý nhà cung cấp
- [ ] Quản lý mã giảm giá
- [ ] Báo cáo doanh thu (theo ngày/tháng/cửa hàng)
- [ ] Báo cáo tồn kho
- [ ] Báo cáo lô sắp hết hạn
- [ ] Báo cáo top sản phẩm bán chạy

---

## 📱 GIAI ĐOẠN 7: ANDROID APP

- [ ] Setup project Android Studio (Kotlin)
- [ ] Cài Retrofit + OkHttp + Hilt + Room + Coil
- [ ] Cấu hình Base URL + AuthInterceptor (Bearer token)
- [ ] Lưu token bằng DataStore / EncryptedSharedPreferences
- [ ] Màn Splash
- [ ] Màn Đăng nhập / Đăng ký
- [ ] Màn Trang chủ (list danh mục + sản phẩm)
- [ ] Màn Chi tiết sản phẩm
- [ ] Màn Giỏ hàng
- [ ] Màn Đặt hàng (checkout)
- [ ] Màn Lịch sử đơn hàng + chi tiết đơn
- [ ] Màn Profile + địa chỉ
- [ ] Màn Tìm kiếm sản phẩm
- [ ] Tích hợp Firebase Cloud Messaging (push notification)
- [ ] Cache offline bằng Room
- [ ] Build APK release

---

## 🔔 GIAI ĐOẠN 8: TÍNH NĂNG NÂNG CAO

- [ ] Tích hợp thanh toán MoMo (sandbox)
- [ ] Tích hợp thanh toán VNPay (sandbox)
- [ ] Gửi email xác nhận đơn hàng
- [ ] Gửi SMS OTP (nếu dùng đăng nhập SĐT)
- [ ] Thông báo realtime (WebSocket / Pusher)
- [ ] Đánh giá sản phẩm (review + rating)
- [ ] Sản phẩm yêu thích (wishlist)
- [ ] Điểm tích lũy + đổi quà
- [ ] Chat giữa khách và cửa hàng (nếu cần)
- [ ] Module Shipper (Android) — bản đồ + cập nhật trạng thái giao

---

## 🧪 GIAI ĐOẠN 9: TESTING

- [ ] Viết Unit Test cho Service (FEFO, Order)
- [ ] Feature Test cho API chính
- [ ] Test luồng end-to-end: đặt hàng → duyệt → xuất kho → giao → nhận tiền
- [ ] Test phân quyền (khách không vào được admin)
- [ ] Test bảo mật (SQL injection, XSS, CSRF)
- [ ] Test hiệu năng API (Postman / JMeter)
- [ ] Test app Android trên nhiều dòng máy

---

## 🚀 GIAI ĐOẠN 10: DEPLOY

- [ ] Chuẩn bị VPS (Ubuntu + Nginx + PHP-FPM + MySQL + Redis)
- [ ] Cấu hình domain + SSL (Let's Encrypt)
- [ ] Clone source lên server + `composer install --no-dev`
- [ ] Chạy `php artisan migrate --force`
- [ ] Cấu hình queue worker (Supervisor)
- [ ] Cấu hình cron job (schedule:run)
- [ ] Setup backup DB tự động
- [ ] Setup log monitoring (Sentry / Laravel Telescope)
- [ ] Build APK release + ký số
- [ ] Upload APK lên Google Play / phân phối trực tiếp
- [ ] Viết tài liệu API (Swagger / Postman Docs)
- [ ] Viết tài liệu hướng dẫn sử dụng cho admin

---

## ✅ CHECKLIST NHANH — THỨ TỰ ƯU TIÊN

```
1.  Models + Seeders
2.  Auth (Sanctum)
3.  Giao diện Web khách hàng (login, home, SP, giỏ, đặt hàng)
4.  API bán hàng (SP, giỏ, đơn, địa chỉ)
5.  Nghiệp vụ kho FEFO (nhập, xuất, tồn, lô)
6.  Giao diện Web admin (dashboard + CRUD)
7.  Android app (login, home, giỏ, đơn)
8.  Tính năng nâng cao (thanh toán online, notification, review)
9.  Testing
10. Deploy
```

---

👉 Bạn muốn mình bắt đầu viết code cho **bước nào** trong list này?