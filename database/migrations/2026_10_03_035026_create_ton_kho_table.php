<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ton_kho', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cua_hang_id')->constrained('cua_hang')->cascadeOnDelete()->comment('Tồn tại chi nhánh nào');
            $table->foreignId('san_pham_id')->constrained('san_pham')->cascadeOnDelete()->comment('Sản phẩm nào');
            $table->decimal('so_luong_ton', 12, 2)->default(0)->comment('Tổng số lượng thực tế trong kho');
            $table->decimal('so_luong_tam_giu', 12, 2)->default(0)->comment('Số lượng khách đã đặt nhưng chưa xuất kho');
            $table->decimal('nguong_canh_bao_thap', 10, 2)->default(10)->comment('Mức tồn tối thiểu để cảnh báo nhập hàng');
            $table->timestamps();

            // Mỗi sản phẩm tại 1 cửa hàng chỉ có 1 dòng tổng hợp
            $table->unique(['cua_hang_id', 'san_pham_id'], 'uk_cuahang_sanpham');
            $table->index('cua_hang_id');
            $table->index('san_pham_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ton_kho');
    }
};
