<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chi_tiet_don_hang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('don_hang_id')->constrained('don_hang')->cascadeOnDelete();
            $table->foreignId('san_pham_id')->constrained('san_pham')->restrictOnDelete()->comment('Không xóa sản phẩm khi đã có trong đơn hàng');
            $table->string('ten_san_pham', 200)->comment('Snapshot tên SP tại thời điểm mua');
            $table->string('don_vi_tinh', 20)->nullable()->comment('Snapshot ĐVT tại thời điểm mua');
            $table->decimal('don_gia', 12, 2);
            $table->decimal('so_luong', 10, 2)->comment('Cho phép số thập phân (kg, lít)');
            $table->decimal('thanh_tien', 12, 2);
            $table->timestamps();

            $table->index('don_hang_id');
            $table->index('san_pham_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_don_hang');
    }
};