<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChiTietDonHang extends Model
{
    protected $table = 'chi_tiet_don_hang';
    protected $fillable = [
        'don_hang_id', 'san_pham_id', 'ten_san_pham',
        'don_vi_tinh', 'don_gia', 'so_luong', 'thanh_tien',
    ];
    protected $casts = [
        'don_gia'    => 'decimal:2',
        'so_luong'   => 'decimal:2',
        'thanh_tien' => 'decimal:2',
    ];

    public function donHang(): BelongsTo
    {
        return $this->belongsTo(DonHang::class, 'don_hang_id');
    }
    public function sanPham(): BelongsTo
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }
}