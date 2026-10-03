<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GioHang extends Model
{
    protected $table = 'gio_hang';
    protected $fillable = ['nguoi_dung_id', 'san_pham_id', 'so_luong'];
    protected $casts = ['so_luong' => 'decimal:2'];

    public function nguoiDung(): BelongsTo
    {
        return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id');
    }
    public function sanPham(): BelongsTo
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }
}