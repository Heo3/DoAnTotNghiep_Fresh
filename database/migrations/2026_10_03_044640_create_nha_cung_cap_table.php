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
        Schema::create('nha_cung_cap', function (Blueprint $table) {
            $table->id();
            $table->string('ma_ncc', 30)->unique()->comment('Mã nhà cung cấp, VD: NCC-001');
            $table->string('ten_nha_cung_cap', 150);
            $table->string('nguoi_lien_he', 100)->nullable();
            $table->string('so_dien_thoai', 15);
            $table->string('email', 100)->nullable();
            $table->string('dia_chi', 255)->nullable();
            $table->string('ma_so_thue', 30)->nullable();
            $table->text('ghi_chu')->nullable();
            $table->tinyInteger('trang_thai')->default(1)->comment('1: Đang hợp tác, 0: Tạm ngừng');
            $table->timestamps();
            $table->softDeletes();

            $table->index('trang_thai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nha_cung_cap');
    }
};
