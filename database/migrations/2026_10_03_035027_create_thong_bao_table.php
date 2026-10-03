<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('thong_bao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nguoi_dung_id')->constrained('nguoi_dung')->cascadeOnDelete();
            $table->string('tieu_de', 150);
            $table->text('noi_dung');
            $table->string('duong_dan', 255)->nullable()->comment('Link điều hướng khi click vào thông báo');
            $table->enum('loai_thong_bao', ['don_hang', 'khuyen_mai', 'he_thong']);
            $table->boolean('da_doc')->default(false);
            $table->timestamps();

            $table->index(['nguoi_dung_id', 'da_doc']);
            $table->index('loai_thong_bao');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('thong_bao');
    }
};