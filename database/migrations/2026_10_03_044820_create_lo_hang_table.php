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
        Schema::create('lo_hang', function (Blueprint $table) {
            $table->id();
            $table->string('ma_lo', 50)->unique()->comment('Mã định danh lô hàng, VD: LH-20261003-01');
            $table->foreignId('san_pham_id')->constrained('san_pham')->restrictOnDelete()->comment('Sản phẩm của lô');
            $table->foreignId('cua_hang_id')->constrained('cua_hang')->restrictOnDelete()->comment('Đang lưu ở chi nhánh nào');
            $table->foreignId('nha_cung_cap_id')->nullable()->constrained('nha_cung_cap')->nullOnDelete();
            $table->foreignId('phieu_nhap_id')->nullable()->constrained('phieu_nhap')->nullOnDelete()->comment('Nguồn gốc phiếu nhập');
            $table->date('ngay_san_xuat')->nullable();
            $table->date('ngay_het_han')->comment('Hạn sử dụng - Tiêu chí cốt lõi cho thuật toán xuất kho FEFO');
            $table->decimal('so_luong_nhap', 12, 2)->comment('Số lượng ban đầu nhập vào lô');
            $table->decimal('so_luong_con_lai', 12, 2)->default(0)->comment('Số lượng còn lại trong lô');
            $table->decimal('gia_nhap', 12, 2)->comment('Giá nhập của lô này');
            $table->tinyInteger('trang_thai')->default(1)->comment('1: Khả dụng, 2: Hết hàng, 3: Cận date, 4: Hết hạn/Đã hủy');
            $table->timestamps();

            // Index tối ưu hóa truy vấn xuất kho theo FEFO (hạn dùng gần nhất, còn hàng)
            $table->index(['san_pham_id', 'cua_hang_id', 'trang_thai', 'ngay_het_han'], 'idx_fefo_query');
            $table->index('ngay_het_han');
            $table->index('trang_thai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lo_hang');
    }
};
