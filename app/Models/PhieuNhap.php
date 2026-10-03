<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhieuNhap extends Model
{
    protected $table = 'phieu_nhap';

    protected $fillable = [
        'ma_phieu', 'cua_hang_id', 'nha_cung_cap_id',
        'nguoi_tao_id', 'nguoi_duyet_id',
        'tong_tien', 'trang_thai', 'ngay_nhap', 'ghi_chu',
    ];

    protected $casts = [
        'tong_tien' => 'decimal:2',
        'ngay_nhap' => 'datetime',
    ];

    public function cuaHang(): BelongsTo
    {
        return $this->belongsTo(CuaHang::class, 'cua_hang_id');
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
        return $this->hasMany(ChiTietPhieuNhap::class, 'phieu_nhap_id');
    }

    public function loHang(): HasMany
    {
        return $this->hasMany(LoHang::class, 'phieu_nhap_id');
    }
}
