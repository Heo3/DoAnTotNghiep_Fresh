<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SanPham extends Model
{
    protected $table = 'san_pham';

    protected $fillable = [
        'ma_va_vach', 'ten_san_pham', 'duong_dan_seo', 'danh_muc_id',
        'gia_ban', 'gia_giam', 'don_vi_tinh', 'quy_cach',
        'mo_ta', 'hinh_anh_chinh', 'la_tuoi_song', 'trang_thai',
    ];

    protected $casts = [
        'gia_ban' => 'decimal:2',
        'gia_giam' => 'decimal:2',
        'la_tuoi_song' => 'boolean',
        'trang_thai' => 'integer',
    ];

    public function danhMuc(): BelongsTo
    {
        return $this->belongsTo(DanhMuc::class, 'danh_muc_id');
    }

    public function hinhAnh(): HasMany
    {
        return $this->hasMany(HinhAnhSanPham::class, 'san_pham_id')->orderBy('thu_tu');
    }

    public function anhChinh(): HasMany
    {
        return $this->hinhAnh()->where('la_anh_chinh', true);
    }

    public function loHang(): HasMany
    {
        return $this->hasMany(LoHang::class, 'san_pham_id');
    }

    public function tonKho(): HasMany
    {
        return $this->hasMany(TonKho::class, 'san_pham_id');
    }

    public function chiTietDonHang(): HasMany
    {
        return $this->hasMany(ChiTietDonHang::class, 'san_pham_id');
    }

    public function gioHang(): HasMany
    {
        return $this->hasMany(GioHang::class, 'san_pham_id');
    }

    // Accessor: giá đang bán (sale hoặc gốc)
    public function getGiaHienTaiAttribute(): float
    {
        return (float) ($this->gia_giam ?? $this->gia_ban);
    }

    // Scope: chỉ SP đang bán
    public function scopeDangBan($query)
    {
        return $query->where('trang_thai', 1);
    }
}
