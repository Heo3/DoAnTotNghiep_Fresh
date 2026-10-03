<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('san_pham', function (Blueprint $table) {
            $table->id();
            $table->string('ma_va_vach', 50)->unique()->nullable();
            $table->string('ten_san_pham', 200);
            $table->string('duong_dan_seo', 220)->unique();
            $table->foreignId('danh_muc_id')->constrained('danh_muc')->restrictOnDelete();
            $table->decimal('gia_ban', 12, 2);
            $table->decimal('gia_giam', 12, 2)->nullable();
            $table->string('don_vi_tinh', 20)->comment('kg, gam, hop, chai, qua...');
            $table->string('quy_cach', 100)->nullable()->comment('VD: Gói 500g, Khay 1kg');
            $table->text('mo_ta')->nullable();
            $table->string('hinh_anh_chinh', 255)->nullable();
            $table->boolean('la_tuoi_song')->default(false)->comment('Thực phẩm tươi sống');
            $table->tinyInteger('trang_thai')->default(1)->comment('1: Đang bán, 0: Tạm ngừng');
            $table->timestamps();
            $table->softDeletes();

            $table->index('trang_thai');
            $table->index('la_tuoi_song');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('san_pham');
    }
};