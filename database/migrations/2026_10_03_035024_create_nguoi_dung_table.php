<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nguoi_dung', function (Blueprint $table) {
            $table->id();
            $table->string('so_dien_thoai', 15)->unique()->comment('Định danh chính - dùng để đăng nhập');
            $table->string('ho_ten', 100);
            $table->string('email', 100)->nullable()->unique()->comment('Phụ - bắt buộc với nhân viên/quản lý/admin');
            $table->string('mat_khau');
            $table->enum('vai_tro', ['khach_hang', 'nhan_vien', 'quan_ly', 'admin'])->default('khach_hang');
            $table->foreignId('cua_hang_id')->nullable()->constrained('cua_hang')->nullOnDelete()->comment('Chi nhánh làm việc (cho NV/QL)');
            $table->integer('diem_tich_luy')->default(0);
            $table->tinyInteger('trang_thai')->default(1)->comment('1: Hoạt động, 0: Khóa');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            // Index hỗ trợ tìm kiếm / lọc
            $table->index('vai_tro');
            $table->index('trang_thai');
            $table->index('cua_hang_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nguoi_dung');
    }
};