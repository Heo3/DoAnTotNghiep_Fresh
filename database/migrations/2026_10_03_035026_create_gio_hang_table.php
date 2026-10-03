<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gio_hang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nguoi_dung_id')->constrained('nguoi_dung')->cascadeOnDelete();
            $table->foreignId('san_pham_id')->constrained('san_pham')->cascadeOnDelete();
            $table->decimal('so_luong', 10, 2)->default(1.00)->comment('Cho phép số thập phân (kg, lít, lạng)');
            $table->timestamps();

            $table->unique(['nguoi_dung_id', 'san_pham_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gio_hang');
    }
};