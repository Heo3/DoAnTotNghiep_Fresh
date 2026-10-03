<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LoHang extends Model
{
    protected $table = 'lo_hang';
    protected $fillable = [
        'ma_lo', 'san_pham_id', 'cua_hang_id', 'nha_cung_cap_id', 'phieu_nhap_id',
        'ngay_san_xuat', 'ngay_het_han',
        'so_luong_nhap', 'so_luong_con_lai', 'gia_nhap', 'trang_thai',
    ];
    protected $casts = [
        'ngay_san_xuat'    => 'date',
        'ngay_het_han'     => 'date',
        'so_luong_nhap'    => 'decimal:2',
        'so_luong_con_lai' => 'decimal:2',
        'gia_nhap'         => 'decimal:2',
    ];

    public function sanPham(): BelongsTo
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }
    public function cuaHang(): BelongsTo
    {
        return $this->belongsTo(CuaHang::class, 'cua_hang_id');
    }
    public function nhaCungCap(): BelongsTo
    {
        return $this->belongsTo(NhaCungCap::class, 'nha_cung_cap_id');
    }
    public function phieuNhap(): BelongsTo
    {
        return $this->belongsTo(PhieuNhap::class, 'phieu_nhap_id');
    }
    public function chiTietXuatKho(): HasMany
    {
        return $this->hasMany(ChiTietXuatKho::class, 'lo_hang_id');
    }

    // ⭐ SCOPE FEFO — Query lô còn hàng, sắp hết hạn trước
    public function scopeConHang($query)
    {
        return $query->where('so_luong_con_lai', '>', 0)->where('trang_thai', 1);
    }
    public function scopeSapHetHan($query, int $soNgay = 3)
    {
        return $query->whereDate('ngay_het_han', '<=', now()->addDays($soNgay))
                     ->whereDate('ngay_het_han', '>=', now());
    }
    public function scopeDaHetHan($query)
    {
        return $query->whereDate('ngay_het_han', '<', now());
    }

    // Helper: số ngày còn lại
    public function getSoNgayConLaiAttribute(): int
    {
        return now()->diffInDays($this->ngay_het_han, false);
    }
}