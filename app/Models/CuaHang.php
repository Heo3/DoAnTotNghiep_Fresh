<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CuaHang extends Model
{
    protected $table = 'cua_hang';
    protected $fillable = [
        'ten_cua_hang', 'so_dien_thoai', 'dia_chi',
        'kinh_do', 'vi_do', 'gio_mo_cua', 'gio_dong_cua', 'trang_thai',
    ];
    protected $casts = [
        'kinh_do' => 'decimal:7',
        'vi_do'   => 'decimal:7',
        'trang_thai' => 'integer',
    ];

    public function nguoiDung(): HasMany
    {
        return $this->hasMany(NguoiDung::class, 'cua_hang_id');
    }
    public function donHang(): HasMany
    {
        return $this->hasMany(DonHang::class, 'cua_hang_id');
    }
    public function tonKho(): HasMany
    {
        return $this->hasMany(TonKho::class, 'cua_hang_id');
    }
    public function phieuNhap(): HasMany
    {
        return $this->hasMany(PhieuNhap::class, 'cua_hang_id');
    }
    public function phieuXuat(): HasMany
    {
        return $this->hasMany(PhieuXuat::class, 'cua_hang_id');
    }
    public function loHang(): HasMany
    {
        return $this->hasMany(LoHang::class, 'cua_hang_id');
    }
}