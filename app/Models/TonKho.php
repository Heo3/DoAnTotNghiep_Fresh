<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TonKho extends Model
{
    protected $table = 'ton_kho';
    protected $fillable = [
        'cua_hang_id', 'san_pham_id',
        'so_luong_ton', 'so_luong_tam_giu', 'nguong_canh_bao_thap',
    ];
    protected $casts = [
        'so_luong_ton'      => 'decimal:2',
        'so_luong_tam_giu'  => 'decimal:2',
        'nguong_canh_bao_thap' => 'decimal:2',
    ];

    public function cuaHang(): BelongsTo
    {
        return $this->belongsTo(CuaHang::class, 'cua_hang_id');
    }
    public function sanPham(): BelongsTo
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }

    // Số lượng có thể bán = tồn - đang giữ
    public function getSoLuongKhaDungAttribute(): float
    {
        return (float) ($this->so_luong_ton - $this->so_luong_tam_giu);
    }
    public function getSapHetAttribute(): bool
    {
        return $this->so_luong_ton <= $this->nguong_canh_bao_thap;
    }
}