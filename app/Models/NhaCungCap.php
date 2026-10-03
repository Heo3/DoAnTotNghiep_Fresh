<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NhaCungCap extends Model
{
    protected $table = 'nha_cung_cap';

    protected $fillable = [
        'ma_ncc', 'ten_nha_cung_cap', 'nguoi_lien_he',
        'so_dien_thoai', 'email', 'dia_chi', 'ma_so_thue', 'ghi_chu', 'trang_thai',
    ];

    public function phieuNhap(): HasMany
    {
        return $this->hasMany(PhieuNhap::class, 'nha_cung_cap_id');
    }

    public function loHang(): HasMany
    {
        return $this->hasMany(LoHang::class, 'nha_cung_cap_id');
    }
}
