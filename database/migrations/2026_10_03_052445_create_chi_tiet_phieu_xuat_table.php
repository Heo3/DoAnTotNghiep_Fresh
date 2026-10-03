<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chi_tiet_phieu_xuat', function (Blueprint $table) {
            $table->id();

            $table->foreignId('phieu_xuat_id')
                  ->constrained('phieu_xuat')
                  ->cascadeOnDelete()
                  ->comment('Thuộc phiếu xuất nào');

            $table->foreignId('san_pham_id')
                  ->constrained('san_pham')
                  ->restrictOnDelete()
                  ->comment('Sản phẩm xuất');

            $table->decimal('so_luong', 12, 2)
                  ->comment('Số lượng xuất (decimal vì có thể bán kg, lít)');

            $table->decimal('gia_xuat', 12, 2)->nullable()
                  ->comment('Giá xuất 1 đơn vị (giá vốn hoặc giá bán)');

            $table->decimal('thanh_tien', 14, 2)->nullable()
                  ->comment('so_luong * gia_xuat');

            $table->text('ghi_chu')->nullable();

            $table->timestamps();

            // Index
            $table->index('phieu_xuat_id');
            $table->index('san_pham_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_phieu_xuat');
    }
};