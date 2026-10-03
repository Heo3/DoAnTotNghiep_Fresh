<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('phieu_xuat', function (Blueprint $table) {
            $table->id();
            $table->string('ma_phieu', 30)->unique()
                  ->comment('VD: PX20261003-001');

            // Chi nhánh xuất
            $table->foreignId('cua_hang_id')
                  ->constrained('cua_hang')
                  ->restrictOnDelete()
                  ->comment('Xuất từ chi nhánh nào');

            // Loại xuất: 1-Bán hàng, 2-Hủy, 3-Chuyển CN, 4-Trả NCC, 5-Nội bộ
            $table->tinyInteger('loai_xuat')
                  ->comment('1: Bán hàng, 2: Hủy, 3: Chuyển CN, 4: Trả NCC, 5: Nội bộ');

            // Liên kết tùy loại xuất (nullable)
            $table->foreignId('don_hang_id')
                  ->nullable()
                  ->constrained('don_hang')
                  ->nullOnDelete()
                  ->comment('Có khi loai_xuat = 1');

            $table->foreignId('cua_hang_nhan_id')
                  ->nullable()
                  ->constrained('cua_hang')
                  ->nullOnDelete()
                  ->comment('Có khi loai_xuat = 3 (chuyển chi nhánh)');

            $table->foreignId('nha_cung_cap_id')
                  ->nullable()
                  ->constrained('nha_cung_cap')
                  ->nullOnDelete()
                  ->comment('Có khi loai_xuat = 4 (trả NCC)');

            // Người tạo / duyệt
            $table->foreignId('nguoi_tao_id')
                  ->constrained('nguoi_dung')
                  ->restrictOnDelete()
                  ->comment('Ai lập phiếu');

            $table->foreignId('nguoi_duyet_id')
                  ->nullable()
                  ->constrained('nguoi_dung')
                  ->nullOnDelete()
                  ->comment('Ai duyệt');

            // Trạng thái: 0-Nháp, 1-Đã xuất, 2-Đã hủy
            $table->tinyInteger('trang_thai')->default(0)
                  ->comment('0: Nháp, 1: Đã xuất kho, 2: Đã hủy');

            // Thông tin thêm
            $table->decimal('tong_so_luong', 12, 2)->default(0)
                  ->comment('Tổng SL các mặt hàng');
            $table->decimal('tong_gia_tri', 14, 2)->default(0)
                  ->comment('Tổng giá trị xuất');

            $table->text('ly_do')->nullable()
                  ->comment('Lý do khi xuất hủy / trả NCC / điều chỉnh');
            $table->text('ghi_chu')->nullable();

            $table->timestamp('xuat_luc')->nullable()
                  ->comment('Thời điểm thực xuất kho');

            $table->timestamps();
            $table->softDeletes();

            // Index
            $table->index('loai_xuat');
            $table->index('trang_thai');
            $table->index(['cua_hang_id', 'loai_xuat'], 'idx_ch_loai');
            $table->index('xuat_luc');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('phieu_xuat');
    }
};