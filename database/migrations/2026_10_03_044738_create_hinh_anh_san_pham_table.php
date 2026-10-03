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
        Schema::create('hinh_anh_san_pham', function (Blueprint $table) {
            $table->id();
            $table->foreignId('san_pham_id')->constrained('san_pham')->cascadeOnDelete()->comment('Sản phẩm sở hữu');
            $table->string('duong_dan_anh', 255)->comment('Đường dẫn ảnh lưu trữ');
            $table->integer('thu_tu')->default(0)->comment('Thứ tự sắp xếp hiển thị');
            $table->boolean('la_anh_chinh')->default(false)->comment('Có phải ảnh đại diện phụ không');
            $table->timestamps();

            $table->index('san_pham_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hinh_anh_san_pham');
    }
};
