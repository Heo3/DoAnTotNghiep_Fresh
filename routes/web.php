<?php

use App\Models\CuaHang;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-models', function () {
    // 1. Tạo thử 1 cửa hàng test
    $cuaHang = CuaHang::create([
        'ten_cua_hang' => 'Bách Hóa Xanh - Nguyễn Huệ',
        'so_dien_thoai' => '0901234567',
        'dia_chi' => '123 Nguyễn Huệ, Quận 1, TP.HCM',
        'kinh_do' => 106.70098120,
        'vi_do' => 10.77584120,
        'gio_mo_cua' => '06:00:00',
        'gio_dong_cua' => '21:30:00',
        'trang_thai' => 1,
    ]);

    // 2. Lấy dữ liệu ra kèm theo các mối quan hệ (Eager Loading)
    $danhSachCuaHang = CuaHang::with(['donHang', 'tonKho'])->get();

    // 3. Trả về định dạng JSON để kiểm tra kết quả
    return response()->json([
        'thong_bao' => 'Kết nối Model CuaHang thành công!',
        'cua_hang_moi_tao' => $cuaHang,
        'tat_ca_cua_hang' => $danhSachCuaHang,
    ]);
});
