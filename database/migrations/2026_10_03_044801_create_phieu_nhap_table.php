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
        Schema::create('phieu_nhap', function (Blueprint $table) {
            $table->id();
            $table->string('ma_phieu', 30)->unique()->comment('VD: PN20261003-001');
            $table->foreignId('cua_hang_id')->constrained('cua_hang')->restrictOnDelete()->comment('Nhập về chi nhánh nào');
            $table->foreignId('nha_cung_cap_id')->constrained('nha_cung_cap')->restrictOnDelete()->comment('Nhà cung cấp');
            $table->foreignId('nguoi_tao_id')->constrained('nguoi_dung')->restrictOnDelete()->comment('Nhân viên lập phiếu');
            $table->foreignId('nguoi_duyet_id')->nullable()->constrained('nguoi_dung')->nullOnDelete()->comment('Quản lý duyệt');
            $table->decimal('tong_tien', 14, 2)->default(0)->comment('Tổng giá trị hàng nhập');
            $table->tinyInteger('trang_thai')->default(0)->comment('0: Chờ duyệt/Nháp, 1: Đã nhập kho, 2: Đã hủy');
            $table->timestamp('ngay_nhap')->nullable()->comment('Thời điểm hoàn tất nhập kho');
            $table->text('ghi_chu')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('trang_thai');
            $table->index('cua_hang_id');
            $table->index('nha_cung_cap_id');
            $table->index('ngay_nhap');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieu_nhap');
    }
};
