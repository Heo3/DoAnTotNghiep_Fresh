# SƠ ĐỒ THIẾT KẾ CƠ SỞ DỮ LIỆU - DỰ ÁN FRESH FOOD (THỰC PHẨM SẠCH)

Tài liệu này tổng hợp toàn bộ cấu trúc bảng, mối quan hệ và các luồng nghiệp vụ cốt lõi (Kho - FEFO - Bán hàng) được xây dựng từ hệ thống migration của dự án.

---

## 1. SƠ ĐỒ THỰC THỂ QUAN HỆ TỔNG THỂ (ERD)

```mermaid
erDiagram
    %% CỬA HÀNG & PHÂN QUYỀN
    cua_hang ||--o{ nguoi_dung : "co_nhan_vien"
    cua_hang ||--o{ don_hang : "xu_ly_don"
    cua_hang ||--o{ ton_kho : "chua_hang"
    cua_hang ||--o{ phieu_nhap : "nhap_ve"
    cua_hang ||--o{ lo_hang : "luu_tru"
    cua_hang ||--o{ phieu_xuat : "xuat_tu"
    cua_hang ||--o{ phieu_xuat : "chuyen_den"

    %% NGƯỜI DÙNG & TƯƠNG TÁC
    nguoi_dung ||--o{ dia_chi_giao_hang : "co_so_dia_chi"
    nguoi_dung ||--o{ don_hang : "dat_mua"
    nguoi_dung ||--o{ gio_hang : "co_gio_hang"
    nguoi_dung ||--o{ thong_bao : "nhan_tin"
    nguoi_dung ||--o{ phieu_nhap : "lap_duyet_pn"
    nguoi_dung ||--o{ phieu_xuat : "lap_duyet_px"

    %% SẢN PHẨM & DANH MỤC
    danh_muc ||--o{ danh_muc : "danh_muc_con"
    danh_muc ||--o{ san_pham : "phan_loai"
    san_pham ||--o{ hinh_anh_san_pham : "co_nhieu_anh"
    san_pham ||--o{ gio_hang : "duoc_them_vao"
    san_pham ||--o{ ton_kho : "thong_ke_ton"
    san_pham ||--o{ chi_tiet_don_hang : "duoc_ban"
    san_pham ||--o{ chi_tiet_phieu_nhap : "duoc_nhap"
    san_pham ||--o{ lo_hang : "chia_theo_lo"
    san_pham ||--o{ chi_tiet_phieu_xuat : "duoc_xuat"

    %% NHÀ CUNG CẤP & NHẬP KHO
    nha_cung_cap ||--o{ phieu_nhap : "cung_cap_hang"
    nha_cung_cap ||--o{ lo_hang : "nguon_goc"
    nha_cung_cap ||--o{ phieu_xuat : "tra_hang_ve"
    phieu_nhap ||--|{ chi_tiet_phieu_nhap : "gom_cac_dong"
    phieu_nhap ||--o{ lo_hang : "sinh_ra_lo"

    %% ĐƠN HÀNG & BÁN HÀNG
    ma_giam_gia ||--o{ don_hang : "ap_dung_voucher"
    dia_chi_giao_hang ||--o{ don_hang : "giao_toi_dia_chi"
    don_hang ||--|{ chi_tiet_don_hang : "gom_cac_mon"
    don_hang ||--o{ phieu_xuat : "xuat_kho_ban_hang"

    %% XUẤT KHO & LÔ HÀNG (FEFO)
    phieu_xuat ||--|{ chi_tiet_phieu_xuat : "gom_danh_sach_sp"
    chi_tiet_phieu_xuat ||--|{ chi_tiet_xuat_kho : "chia_theo_lo_xuat"
    lo_hang ||--o{ chi_tiet_xuat_kho : "lay_tu_lo"

    %% CẤU TRÚC CHI TIẾT TỪNG BẢNG
    cua_hang {
        bigint id PK
        string ten_cua_hang
        string so_dien_thoai
        string dia_chi
        decimal kinh_do
        decimal vi_do
        time gio_mo_cua
        time gio_dong_cua
        tinyint trang_thai
    }

    nguoi_dung {
        bigint id PK
        string so_dien_thoai UK
        string ho_ten
        string email UK
        string mat_khau
        enum vai_tro "khach_hang,nhan_vien,quan_ly,admin"
        bigint cua_hang_id FK
        int diem_tich_luy
        tinyint trang_thai
    }

    dia_chi_giao_hang {
        bigint id PK
        bigint nguoi_dung_id FK
        string ten_nguoi_nhan
        string so_dien_thoai_nhan
        string dia_chi_chi_tiet
        string phuong_xa
        string quan_huyen
        string tinh_thanh
        boolean la_mac_dinh
    }

    danh_muc {
        bigint id PK
        string ten_danh_muc
        string duong_dan_seo UK
        string hinh_anh
        bigint danh_muc_cha_id FK
    }

    san_pham {
        bigint id PK
        string ma_va_vach UK
        string ten_san_pham
        string duong_dan_seo UK
        bigint danh_muc_id FK
        decimal gia_ban
        decimal gia_giam
        string don_vi_tinh
        string quy_cach
        boolean la_tuoi_song
        tinyint trang_thai
    }

    hinh_anh_san_pham {
        bigint id PK
        bigint san_pham_id FK
        string duong_dan_anh
        int thu_tu
        boolean la_anh_chinh
    }

    nha_cung_cap {
        bigint id PK
        string ma_ncc UK
        string ten_nha_cung_cap
        string nguoi_lien_he
        string so_dien_thoai
        string email
        string dia_chi
        tinyint trang_thai
    }

    phieu_nhap {
        bigint id PK
        string ma_phieu UK
        bigint cua_hang_id FK
        bigint nha_cung_cap_id FK
        bigint nguoi_tao_id FK
        bigint nguoi_duyet_id FK
        decimal tong_tien
        tinyint trang_thai
        timestamp ngay_nhap
    }

    chi_tiet_phieu_nhap {
        bigint id PK
        bigint phieu_nhap_id FK
        bigint san_pham_id FK
        string ma_lo
        decimal so_luong
        decimal don_gia_nhap
        decimal thanh_tien
        date ngay_san_xuat
        date ngay_het_han
    }

    lo_hang {
        bigint id PK
        string ma_lo UK
        bigint san_pham_id FK
        bigint cua_hang_id FK
        bigint nha_cung_cap_id FK
        bigint phieu_nhap_id FK
        date ngay_san_xuat
        date ngay_het_han "Chi muc FEFO"
        decimal so_luong_nhap
        decimal so_luong_con_lai
        decimal gia_nhap
        tinyint trang_thai
    }

    ton_kho {
        bigint id PK
        bigint cua_hang_id FK
        bigint san_pham_id FK
        decimal so_luong_ton
        decimal so_luong_tam_giu
        decimal nguong_canh_bao_thap
    }

    ma_giam_gia {
        bigint id PK
        string ma_khuyen_mai UK
        enum loai_giam_gia "phan_tram,tien_mat"
        decimal gia_tri_giam
        decimal don_hang_toi_thieu
        decimal giam_toi_da
        datetime ngay_bat_dau
        datetime ngay_ket_thuc
        int so_luong
        int da_su_dung
    }

    don_hang {
        bigint id PK
        string ma_don_hang UK
        bigint nguoi_dung_id FK
        bigint cua_hang_id FK
        bigint dia_chi_giao_hang_id FK
        bigint ma_giam_gia_id FK
        decimal tong_tien_hang
        decimal phi_giao_hang
        decimal tien_giam_gia
        decimal tong_thanhtoan
        enum phuong_thuc_thanh_toan
        string ma_giao_dich
        enum trang_thai_thanh_toan
        enum trang_thai_don_hang
        string ten_nguoi_nhan
        string so_dien_thoai_nhan
        string dia_chi_giao
    }

    chi_tiet_don_hang {
        bigint id PK
        bigint don_hang_id FK
        bigint san_pham_id FK
        string ten_san_pham
        string don_vi_tinh
        decimal don_gia
        decimal so_luong "Ho tro so le kg,lit"
        decimal thanh_tien
    }

    gio_hang {
        bigint id PK
        bigint nguoi_dung_id FK
        bigint san_pham_id FK
        decimal so_luong
    }

    phieu_xuat {
        bigint id PK
        string ma_phieu UK
        bigint cua_hang_id FK
        tinyint loai_xuat "1:Ban, 2:Huy, 3:Chuyen CN, 4:Tra NCC, 5:Noi bo"
        bigint don_hang_id FK
        bigint cua_hang_nhan_id FK
        bigint nha_cung_cap_id FK
        bigint nguoi_tao_id FK
        bigint nguoi_duyet_id FK
        tinyint trang_thai
        decimal tong_so_luong
        decimal tong_gia_tri
        timestamp xuat_luc
    }

    chi_tiet_phieu_xuat {
        bigint id PK
        bigint phieu_xuat_id FK
        bigint san_pham_id FK
        decimal so_luong
        decimal gia_xuat
        decimal thanh_tien
    }

    chi_tiet_xuat_kho {
        bigint id PK
        bigint chi_tiet_phieu_xuat_id FK
        bigint lo_hang_id FK
        decimal so_luong
        decimal gia_xuat
    }

    thong_bao {
        bigint id PK
        bigint nguoi_dung_id FK
        string tieu_de
        text noi_dung
        string duong_dan
        enum loai_thong_bao
        boolean da_doc
    }
```

---

## 2. CÁC LUỒNG NGHIỆP VỤ CỐT LÕI

### 2.1. Luồng Nhập Kho & Quản Lý Lô Hàng Hạn Dùng (FEFO)

```mermaid
flowchart TD
    NCC[Nhà cung cấp] -->|Giao hàng| PN[Lập Phiếu Nhập: phieu_nhap]
    PN --> CTPN[Chi tiết từng sản phẩm: chi_tiet_phieu_nhap<br>- Tên SP, ĐVT, Đơn giá<br>- Ngày SX & Hạn sử dụng]
    CTPN -->|Quản lý duyệt nhập kho| LH[Sinh các Lô Hàng: lo_hang<br>- Quản lý mã lô, HSD<br>- Số lượng khả dụng]
    LH -->|Cập nhật tăng| TK[Tổng hợp tồn chi nhánh: ton_kho<br>- Tăng so_luong_ton]
```

### 2.2. Luồng Bán Hàng & Xuất Kho Tự Động FEFO

```mermaid
flowchart TD
    KH[Khách hàng] -->|Chọn mua| GH[gio_hang]
    GH -->|Áp mã giảm giá & Địa chỉ| DH[Tạo don_hang: Cho xac nhan]
    DH -->|Giữ hàng| TK1[ton_kho: Tăng so_luong_tam_giu]
    DH -->|Cửa hàng duyệt đơn| PX[Tạo phieu_xuat kho: loai_xuat = 1]
    PX --> CTPX[chi_tiet_phieu_xuat: Theo từng món đặt]
    CTPX -->|Thuật toán FEFO quét lo_hang có HSD gần nhất| CTXK[chi_tiet_xuat_kho:<br>Bốc hàng chính xác từ từng lo_hang_id]
    CTXK -->|Trừ số lượng| LH[lo_hang: Giảm so_luong_con_lai]
    CTXK -->|Trừ tồn thực tế| TK2[ton_kho:<br>- Giảm so_luong_ton<br>- Giảm so_luong_tam_giu]
    PX -->|Hoàn tất xuất kho| GIAO[Giao hàng cho khách & Cập nhật đơn hàng: da_giao]
```

---

## 3. TÓM TẮT PHÂN CỤM DỮ LIỆU & RÀNG BUỘC TOÀN VẸN

| Phân cụm | Các bảng tham gia | Điểm nổi bật & Ràng buộc toàn vẹn |
| :--- | :--- | :--- |
| **Hệ thống & Chi nhánh** | `cua_hang`, `nguoi_dung`, `dia_chi_giao_hang`, `thong_bao` | Nhân viên/Quản lý gắn với `cua_hang_id`. Model `User` map trực tiếp vào bảng `nguoi_dung`. |
| **Catalog Sản phẩm** | `danh_muc`, `san_pham`, `hinh_anh_san_pham` | Hỗ trợ danh mục đa cấp, nhiều ảnh phụ, cờ `la_tuoi_song` và đơn vị tính linh hoạt. |
| **Nhập kho & Lô hàng** | `nha_cung_cap`, `phieu_nhap`, `chi_tiet_phieu_nhap`, `lo_hang`, `ton_kho` | Hỗ trợ lưu trữ hạn sử dụng chính xác đến từng ngày, phục vụ tự động hóa thuật toán xuất kho **FEFO** (First Expired, First Out). |
| **Bán hàng & Giỏ hàng** | `gio_hang`, `ma_giam_gia`, `don_hang`, `chi_tiet_don_hang` | Số lượng hỗ trợ số lẻ `decimal` (mua thịt cá rau củ theo kg). Khóa ngoại `don_hang` dùng `restrictOnDelete` để đảm bảo không bị mất doanh thu lịch sử. |
| **Xuất kho 2 tầng** | `phieu_xuat`, `chi_tiet_phieu_xuat`, `chi_tiet_xuat_kho` | Thiết kế 2 tầng: Dòng phiếu xuất gắn với Sản phẩm, chi tiết thực xuất gắn với từng Lô hàng cụ thể. |
