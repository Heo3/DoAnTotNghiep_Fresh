<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThongBao extends Model
{
    protected $table = 'thong_bao';
    protected $fillable = [
        'nguoi_dung_id', 'tieu_de', 'noi_dung',
        'duong_dan', 'loai_thong_bao', 'da_doc',
    ];
    protected $casts = ['da_doc' => 'boolean'];

    public function nguoiDung(): BelongsTo
    {
        return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id');
    }

    public function scopeChuaDoc($q)
    {
        return $q->where('da_doc', false);
    }
}