<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaGiamGia extends Model
{
    protected $table = 'ma_giam_gia';

    protected $fillable = [
        'ma_khuyen_mai', 'loai_giam_gia', 'gia_tri_giam',
        'don_hang_toi_thieu', 'giam_toi_da',
        'ngay_bat_dau', 'ngay_ket_thuc', 'so_luong', 'da_su_dung',
    ];

    protected $casts = [
        'gia_tri_giam' => 'decimal:2',
        'don_hang_toi_thieu' => 'decimal:2',
        'giam_toi_da' => 'decimal:2',
        'ngay_bat_dau' => 'datetime',
        'ngay_ket_thuc' => 'datetime',
        'so_luong' => 'integer',
        'da_su_dung' => 'integer',
    ];

    public function donHang(): HasMany
    {
        return $this->hasMany(DonHang::class, 'ma_giam_gia_id');
    }

    public function conHieuLuc(): bool
    {
        $now = now();

        return $this->ngay_bat_dau <= $now
            && $this->ngay_ket_thuc >= $now
            && $this->da_su_dung < $this->so_luong;
    }

    // Tính tiền giảm cho 1 đơn
    public function tinhGiamGia(float $tongTien): float
    {
        if ($tongTien < $this->don_hang_toi_thieu) {
            return 0;
        }

        $giam = $this->loai_giam_gia === 'phan_tram'
            ? $tongTien * ($this->gia_tri_giam / 100)
            : $this->gia_tri_giam;

        if ($this->giam_toi_da) {
            $giam = min($giam, $this->giam_toi_da);
        }

        return $giam;
    }
}
