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
        Schema::create('chi_tiet_phieu_nhap', function (Blueprint $table) {
            $table->id();
            $table->foreignId('phieu_nhap_id')->constrained('phieu_nhap')->cascadeOnDelete()->comment('Thuộc phiếu nhập nào');
            $table->foreignId('san_pham_id')->constrained('san_pham')->restrictOnDelete()->comment('Sản phẩm nhập');
            $table->string('ma_lo', 50)->nullable()->comment('Số lô hàng gắn với dòng này');
            $table->decimal('so_luong', 12, 2)->comment('Số lượng nhập (cho phép số lẻ kg/lít)');
            $table->decimal('don_gia_nhap', 12, 2)->comment('Giá vốn 1 đơn vị');
            $table->decimal('thanh_tien', 14, 2)->comment('so_luong * don_gia_nhap');
            $table->date('ngay_san_xuat')->nullable();
            $table->date('ngay_het_han')->comment('Hạn sử dụng - quan trọng với thực phẩm tươi sống');
            $table->timestamps();

            $table->index('phieu_nhap_id');
            $table->index('san_pham_id');
            $table->index('ngay_het_han');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_phieu_nhap');
    }
};
