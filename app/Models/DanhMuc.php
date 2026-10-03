<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DanhMuc extends Model
{
    protected $table = 'danh_muc';
    protected $fillable = ['ten_danh_muc', 'duong_dan_seo', 'hinh_anh', 'danh_muc_cha_id'];

    public function danhMucCha(): BelongsTo
    {
        return $this->belongsTo(DanhMuc::class, 'danh_muc_cha_id');
    }
    public function danhMucCon(): HasMany
    {
        return $this->hasMany(DanhMuc::class, 'danh_muc_cha_id');
    }
    public function sanPham(): HasMany
    {
        return $this->hasMany(SanPham::class, 'danh_muc_id');
    }

    // Đệ quy lấy hết con cháu
    public function tatCaDanhMucCon(): HasMany
    {
        return $this->danhMucCon()->with('tatCaDanhMucCon');
    }
}