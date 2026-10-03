<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class DonHang extends Model
{
    protected $table = 'don_hang';

    protected $fillable = [
        'ma_don_hang', 'nguoi_dung_id', 'cua_hang_id', 'dia_chi_giao_hang_id', 'ma_giam_gia_id',
        'tong_tien_hang', 'phi_giao_hang', 'tien_giam_gia', 'tong_thanhtoan',
        'phuong_thuc_thanh_toan', 'ma_giao_dich', 'trang_thai_thanh_toan',
        'trang_thai_don_hang', 'ten_nguoi_nhan', 'so_dien_thoai_nhan', 'dia_chi_giao', 'ghi_chu',
    ];

    protected $casts = [
        'tong_tien_hang' => 'decimal:2',
        'phi_giao_hang' => 'decimal:2',
        'tien_giam_gia' => 'decimal:2',
        'tong_thanhtoan' => 'decimal:2',
    ];

    // Tự sinh mã đơn khi tạo mới
    protected static function booted(): void
    {
        static::creating(function ($donHang) {
            if (empty($donHang->ma_don_hang)) {
                $donHang->ma_don_hang = 'DH'.now()->format('ymd').strtoupper(Str::random(5));
            }
        });
    }

    public function nguoiDung(): BelongsTo
    {
        return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id');
    }

    public function cuaHang(): BelongsTo
    {
        return $this->belongsTo(CuaHang::class, 'cua_hang_id');
    }

    public function diaChiGiaoHang(): BelongsTo
    {
        return $this->belongsTo(DiaChiGiaoHang::class, 'dia_chi_giao_hang_id');
    }

    public function maGiamGia(): BelongsTo
    {
        return $this->belongsTo(MaGiamGia::class, 'ma_giam_gia_id');
    }

    public function chiTiet(): HasMany
    {
        return $this->hasMany(ChiTietDonHang::class, 'don_hang_id');
    }

    public function phieuXuat(): HasMany
    {
        return $this->hasMany(PhieuXuat::class, 'don_hang_id');
    }

    // Scope theo trạng thái
    public function scopeChoXacNhan($q)
    {
        return $q->where('trang_thai_don_hang', 'cho_xac_nhan');
    }

    public function scopeDaGiao($q)
    {
        return $q->where('trang_thai_don_hang', 'da_giao');
    }

    public function coTheHuy(): bool
    {
        return in_array($this->trang_thai_don_hang, ['cho_xac_nhan', 'dang_chuan_bi']);
    }
}
