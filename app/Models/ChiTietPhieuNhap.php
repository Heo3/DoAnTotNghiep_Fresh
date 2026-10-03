<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChiTietPhieuNhap extends Model
{
    protected $table = 'chi_tiet_phieu_nhap';
    protected $fillable = [
        'phieu_nhap_id', 'san_pham_id', 'ma_lo',
        'so_luong', 'don_gia_nhap', 'thanh_tien',
        'ngay_san_xuat', 'ngay_het_han',
    ];
    protected $casts = [
        'so_luong'      => 'decimal:2',
        'don_gia_nhap'  => 'decimal:2',
        'thanh_tien'    => 'decimal:2',
        'ngay_san_xuat' => 'date',
        'ngay_het_han'  => 'date',
    ];

    public function phieuNhap(): BelongsTo
    {
        return $this->belongsTo(PhieuNhap::class, 'phieu_nhap_id');
    }
    public function sanPham(): BelongsTo
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }
}