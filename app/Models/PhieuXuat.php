<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhieuXuat extends Model
{
    protected $table = 'phieu_xuat';

    protected $fillable = [
        'ma_phieu', 'cua_hang_id', 'loai_xuat', 'don_hang_id',
        'cua_hang_nhan_id', 'nha_cung_cap_id',
        'nguoi_tao_id', 'nguoi_duyet_id',
        'trang_thai', 'tong_so_luong', 'tong_gia_tri', 'ly_do', 'ghi_chu', 'xuat_luc',
    ];

    protected $casts = [
        'loai_xuat' => 'integer',
        'trang_thai' => 'integer',
        'tong_so_luong' => 'decimal:2',
        'tong_gia_tri' => 'decimal:2',
        'xuat_luc' => 'datetime',
    ];

    // Loại xuất
    const LOAI_BAN = 1;

    const LOAI_HUY = 2;

    const LOAI_CHUYEN_CN = 3;

    const LOAI_TRA_NCC = 4;

    const LOAI_NOI_BO = 5;

    public function cuaHang(): BelongsTo
    {
        return $this->belongsTo(CuaHang::class, 'cua_hang_id');
    }

    public function cuaHangNhan(): BelongsTo
    {
        return $this->belongsTo(CuaHang::class, 'cua_hang_nhan_id');
    }

    public function donHang(): BelongsTo
    {
        return $this->belongsTo(DonHang::class, 'don_hang_id');
    }

    public function nhaCungCap(): BelongsTo
    {
        return $this->belongsTo(NhaCungCap::class, 'nha_cung_cap_id');
    }

    public function nguoiTao(): BelongsTo
    {
        return $this->belongsTo(NguoiDung::class, 'nguoi_tao_id');
    }

    public function nguoiDuyet(): BelongsTo
    {
        return $this->belongsTo(NguoiDung::class, 'nguoi_duyet_id');
    }

    public function chiTiet(): HasMany
    {
        return $this->hasMany(ChiTietPhieuXuat::class, 'phieu_xuat_id');
    }
}
