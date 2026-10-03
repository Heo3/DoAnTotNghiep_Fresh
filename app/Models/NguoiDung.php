<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class NguoiDung extends Authenticatable
{
    protected $table = 'nguoi_dung';

    protected $fillable = [
        'so_dien_thoai', 'ho_ten', 'email', 'mat_khau',
        'vai_tro', 'cua_hang_id', 'diem_tich_luy', 'trang_thai',
    ];

    protected $hidden = ['mat_khau', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'mat_khau' => 'hashed',
            'diem_tich_luy' => 'integer',
            'trang_thai' => 'integer',
        ];
    }

    public function getAuthPasswordName(): string
    {
        return 'mat_khau';
    }

    public function getAuthPassword(): string
    {
        return $this->mat_khau;
    }

    // Quan hệ
    public function cuaHang(): BelongsTo
    {
        return $this->belongsTo(CuaHang::class, 'cua_hang_id');
    }

    public function diaChiGiaoHang(): HasMany
    {
        return $this->hasMany(DiaChiGiaoHang::class, 'nguoi_dung_id');
    }

    public function donHang(): HasMany
    {
        return $this->hasMany(DonHang::class, 'nguoi_dung_id');
    }

    public function gioHang(): HasMany
    {
        return $this->hasMany(GioHang::class, 'nguoi_dung_id');
    }

    public function thongBao(): HasMany
    {
        return $this->hasMany(ThongBao::class, 'nguoi_dung_id');
    }

    // Helper: kiểm tra vai trò
    public function laAdmin(): bool
    {
        return $this->vai_tro === 'admin';
    }

    public function laQuanLy(): bool
    {
        return in_array($this->vai_tro, ['quan_ly', 'admin']);
    }

    public function laNhanVien(): bool
    {
        return in_array($this->vai_tro, ['nhan_vien', 'quan_ly', 'admin']);
    }

    public function laKhachHang(): bool
    {
        return $this->vai_tro === 'khach_hang';
    }
}
