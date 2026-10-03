<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DiaChiGiaoHang extends Model
{
    protected $table = 'dia_chi_giao_hang';
    protected $fillable = [
        'nguoi_dung_id', 'ten_nguoi_nhan', 'so_dien_thoai_nhan',
        'dia_chi_chi_tiet', 'phuong_xa', 'quan_huyen', 'tinh_thanh', 'la_mac_dinh',
    ];
    protected $casts = ['la_mac_dinh' => 'boolean'];

    public function nguoiDung(): BelongsTo
    {
        return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id');
    }
    public function donHang(): HasMany
    {
        return $this->hasMany(DonHang::class, 'dia_chi_giao_hang_id');
    }
}